<template>
  <div class="page-content">
    <div class="page-info">
      <breadcrumbs />
      <div class="page-options">
        <b-button variant="primary" @click="add_group.show_modal = true">Add Group</b-button>
      </div>
    </div>

    <div class="main-wrapper">

      <div class="row">
        <div class="col-xl" v-if="report_data">
          <ul class="nav nav-tabs mb-0" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="report-tab" data-toggle="tab" href="#report" role="tab" aria-controls="report" aria-selected="true">Report</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="details-tab" data-toggle="tab" href="#details" role="tab" aria-controls="details" aria-selected="false">Details</a>
            </li>
          </ul>
          <div class="tab-content" id="report-tabs">
            <div class="tab-pane fade show active" id="report" role="tabpanel" aria-labelledby="report-tab">
              <div class="card" >
                <div class="card-body table-responsive">
                  <div class="report-group" v-for="(group,i) in report_data.groups" :key="i">
                    <div class="d-flex justify-content-between">
                      <h5 class="card-title">{{ group.name }}</h5>
                      <div>
                        <a href="#" @click.prevent="deleteGroup(group)"
                           class="btn btn-xs btn-danger">
                          <font-awesome-icon :icon="['fas', 'trash']" :class="'mr-1'" />Delete
                        </a>
                        <a href="#" class="btn btn-xs btn-primary" @click.prevent="addGroupItem(group.id)">
                          <font-awesome-icon :icon="['fas', 'plus']" :class="'mr-1'" />Add
                        </a>
                      </div>
                    </div>

                    <b-table :items="group.report_items" :fields="fields">
                      <template #cell(id)="row">
                        <a href="#" @click.prevent="row.toggleDetails" class="edit-item text-center text-muted">
                          <font-awesome-icon v-if="row.detailsShowing" :icon="['fas', 'minus']" />
                          <font-awesome-icon v-else :icon="['fas', 'plus']" />
                        </a>
                      </template>
                      <template #cell(actions)="data" class="text-center">
                        <a href="#" @click.prevent="deleteItem(data.item)" class="text-muted">
                          <font-awesome-icon :icon="['fas', 'trash']" />
                        </a>
                      </template>
                      <template #cell(status)="data" :class="'text-center'">
                        <span class="badge" :class="getStatusBadgeClass(data.item.status)">{{ data.item.status }}</span>
                      </template>

                      <template #row-details="row">
                        <div class="row expended-table">
                          <div class="col-md-6">
                            <div class="d-flex">
                              <label> Item: </label>
                              <div class="table-field-wrapper">
                                <select @change="updateReportItem(i,row.index)" name="" class="table-field" v-model="row.item.group_item">
                                  <template v-for="item in getGroupItems(row.item.group_id)">
                                    <option :value="item">{{ item.name }}</option>
                                  </template>
                                </select>
                              </div>
                            </div>
                            <div class="d-flex">
                              <label> Status: </label>
                              <div class="table-field-wrapper">
                                <select name="" class="table-field" v-model="row.item.status">
                                  <template v-for="status in statusList">
                                    <option :value="status">{{ status }}</option>
                                  </template>
                                </select>
                              </div>
                            </div>
                            <div class="d-flex">
                              <label> Notes: </label>
                              <div class="table-field-wrapper">
                                <input type="text" v-model="row.item.notes" class="table-field">
                              </div>
                            </div>
                            <div class="d-flex">
                              <label> QTR: </label>
                              <div class="table-field-wrapper">
                                <input type="text" v-model="row.item.qtr" class="table-field">
                              </div>
                            </div>
                            <div class="d-flex">
                              <label> Target Year: </label>
                              <div class="table-field-wrapper">
                                <input type="text" v-model="row.item.target_year" class="table-field">
                              </div>
                            </div>
                            <div class="d-flex">
                              <label> Budget: </label>
                              <div class="table-field-wrapper">
                                <input type="text" v-model="row.item.budget" class="table-field">
                              </div>
                            </div>

                          </div>
                          <div class="col-md-6">
                            <div class="d-flex">
                              <label>Solution:</label>
                              <div class="table-field-wrapper">
                          <textarea placeholder="Type solution here" class="table-field"
                                    name="" id="" cols="30" rows="7" v-model="row.item.solution">

                          </textarea>
                              </div>
                            </div>
                          </div>
                        </div>
                      </template>
                    </b-table>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="details" role="tabpanel" aria-labelledby="details-tab">
              <div class="card">
                <div class="card-body">
                  <div class="row expended-table">
                    <div class="col-md-6">
                      <div class="d-flex">
                        <label> Report Name: </label>
                        <div class="table-field-wrapper">
                          <input type="text" name="name" class="table-field" v-model="report_data.name" @input="updateReport">
                        </div>
                      </div>
                      <div class="d-flex">
                        <label> Customer: </label>
                        <div class="table-field-wrapper">
                          <select name="customer_id" required class="table-field" v-model="report_data.customer_id" @change="updateReport">
                            <option :value="customer.id" v-for="(customer,i) in customers" :key="i">{{ customer.name }}</option>
                          </select>
                        </div>
                      </div>
                      <div class="d-flex">
                        <label> Report Date: </label>
                        <div class="table-field-wrapper">
                          <input required type="date" v-model="report_data.date" class="table-field" id="report-date" name="date" @input="updateReport">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <label> Report Summary: </label>
                      <div class="table-field-wrapper">
                        <textarea name="summary" class="table-field" id="report-summary" @input="updateReport" v-model="report_data.summary"
                                  placeholder="write summary here"
                                  style="resize: vertical" cols="30" rows="10"></textarea>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <b-modal centered v-model="delete_modal.show">
      <template #modal-header="{close}">
        <h5>Are you sure?</h5>
        <button type="button" class="close" @click="close">
          <i class="material-icons">close</i>
        </button>
      </template>

      <p>{{ delete_modal.message }}</p>

      <template #modal-footer="{ close, remove }">

        <b-button variant="secondary" @click="close()">
          Cancel
        </b-button>
        <b-button variant="danger" @click="removeTarget">
          Delete
        </b-button>
      </template>
    </b-modal>
    <b-modal centered v-model="add_group.show_modal">

      <template #modal-header="{close}">
        <h5>Add Group</h5>
        <button type="button" class="close" @click="close">
          <i class="material-icons">close</i>
        </button>
      </template>

      <form action="" method="post">
        <div class="form-group">
          <label for="select-group">Select Group</label>
          <select name="" required class="form-control" v-model="add_group.group_id" id="select-group">
            <option :value="group.id" v-for="(group,i) in availableGroups" :key="i">{{ group.name }}</option>
          </select>
        </div>
        <div class="form-group">
          <label for="select-item">Select item to add</label>
          <select name="" required class="form-control" v-model="add_group.item_id" id="select-item">
            <option :value="item.id" v-for="(item,i) in groupItems" :key="i">{{ item.name }}</option>
          </select>
        </div>
      </form>


      <template #modal-footer="{ close, remove }">

        <b-button variant="secondary" @click="close()">
          Cancel
        </b-button>
        <b-button variant="primary" type="submit" @click="addGroup">
          Add
        </b-button>
      </template>
    </b-modal>
  </div>
</template>

<script>
  import Breadcrumbs from "../../components/Breadcrumbs";
  import axios from "axios";
  import {mapGetters} from "vuex";
  import Form from "vform";

  export default {
    name: "reports",
    data:function(){
      return {
        report_data:null,
        add_group: {
          group_id:0,
          item_id:0,
          group_has_error:false,
          item_has_error:false,
          show_modal:false,
        },
        delete_modal:{
          show:false,
          message:"",
        },
        deleteTarget: {
          id:0,
          type:"",
        },
        statusList: [ "At Risk", "Need Attention", "Acceptable Risk", "Satisfactory" ],
        fields: [
          {
            key: 'id',
            label: "#",
            sortable: false
          },
          {
            key: 'group_item.name',
            label: "Item Name",
            sortable: true
          },
          {
            key: 'status',
            label: "Status",
            sortable: false
          },
          {
            key: 'notes',
            label: 'Notes',
            sortable: true,
          },
          {
            key: 'qtr',
            label: 'QTR',
            sortable: true,
          },
          {
            key: 'target_year',
            label: 'Target Year',
            sortable: true,
          },
          {
            key: 'budget',
            label: 'Budget',
            sortable: true,
          },
          'actions'
        ],

      }
    },
    components:{

      Breadcrumbs,
    },
    beforeCreate() {
      let id = this.$route.params.id;
      this.$store.dispatch('app/fetchReport',{id:id});
      this.$store.dispatch('app/fetchGroupsWithItems');
      this.$store.dispatch('app/fetchCustomers');
    },
    computed:{
      ...mapGetters({
        report: 'app/report',
        groups: 'app/groups',
        customers: 'app/customers',
      }),
      availableGroups(){
        let groups = this.groups.filter((g) =>{
          let find = false;
          if(this.report && this.report.groups){
            find = this.report.groups.find((gr)=>{
              return gr.id == g.id;
            })
          }
          if(find && find.id){
            return false;
          }
          return true;
        })
        return groups;
      },
      groupItems(){
        let group = this.groups.find((g)=>{
          return g.id == this.add_group.group_id;
        })

        return group?group.items:[];
      }

    },
    methods:{
      save(action,data){
        data.action = action;
        this.$store.dispatch('app/save', data)
      },

      async updateReportItem(groupIndex,itemIndex){
        let reportItem = this.report_data.groups[groupIndex].report_items[itemIndex];
        reportItem.group_item_id = reportItem.group_item.id;
        let form = new Form({
            ...reportItem
          })

        const { data } = await form.put(`/api/report/item/${reportItem.id}`);

        data.groupIndex = groupIndex;
        data.itemIndex = itemIndex;

        this.save("UPDATE_REPORT_ITEM", data);
      },
      async updateReport(){
        let report = new Form({
          name: this.report_data.name,
          customer_id: this.report_data.customer_id,
          date: this.report_data.date,
          summary: this.report_data.summary,
        });
        const { data } = await form.put(`/api/report/${this.report_data.id}`);
        this.save("UPDATE_REPORT", data);
      },

      async addGroup(){
        this.add_group.group_has_error = false;
        this.add_group.item_has_error = false;
        let hold = false;
        if(!this.add_group.group_id){
          this.add_group.group_has_error = true;
          hold = true;
        }
        if(!this.add_group.group_id){
          this.add_group.group_has_error = true;
          hold = true;
        }
        if(!hold){
          let form =  new Form({
            group_id: this.add_group.group_id,
            item_id: this.add_group.item_id
          })
          const { data } = await form.post(`/api/report/${this.report.id}/group`);
          this.save("UPDATE_REPORT", data);
          this.close();
        }

      },

      getStatusBadgeClass(status){
        if(status == "Satisfactory"){
          return "badge-success";
        }else if(status == "Need Attention"){
          return "badge-warning";
        }else if(status == "Acceptable Risk"){
          return "badge-info";
        }else if(status == "At Risk"){
          return "badge-danger";
        }
      },

      getGroupItems(group_id){
        let group = this.groups.find(g=>{
          return g.id == group_id
        });
        return group.items;
      },
      deleteItem(item){
        this.delete_modal.message = "Are you sure you want to remove this group item from report?";
        this.delete_modal.show = true;

        this.deleteTarget.target = item;
        this.deleteTarget.type = "item";
      },

      deleteGroup(group){
        this.delete_modal.message = "Are you sure you want to remove this group from report?";
        this.delete_modal.show = true;

        this.deleteTarget.target = group;
        this.deleteTarget.type = "group";
      },

      async addGroupItem(group_id){
        let form = new Form({
          group_id: group_id,
        });
        const { data } = await form.post(`/api/report/${this.report.id}/item/add`);
        this.save("UPDATE_REPORT",data);
      },

      close(){
        this.delete_modal.show = false;
        this.add_group.show_modal = false;
      },
      async removeTarget(){
        let target = this.deleteTarget.target;
        let type = this.deleteTarget.type;
        if(type == "group"){
          const { data } = await axios.delete(`/api/report/${this.report_data.id}/group/${target.id}`);
          this.save("UPDATE_REPORT",data);
        }else if(type == "item"){
          const { data } = await axios.delete(`/api/report/${this.report_data.id}/item/${target.id}`);
          this.save("UPDATE_REPORT",data);
        }

        this.close();
      }
    },
    watch:{
      'report':{
        deep:true,
        handler(){
          this.report_data = this.report;
        }
      }
    }

  }
</script>

<style lang="scss" scoped>

  .b-table{
    th:focus{
      outline-style: dashed;
    }
  }
  .expended-table{
    border: none;
    label{
      flex-basis: 25%;
      min-width: 90px;
      padding: 4px 10px;
      margin: 0;
    }
    textarea{
      resize: none;
    }

  }
  .card{
    border-top-left-radius: 0;
  }
  .report-group:not(:last-child){
    margin-bottom: 40px;
  }
  #myTab{
    border-bottom: none;
  }
</style>
