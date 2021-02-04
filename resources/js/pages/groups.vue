<template>
  <div class="page-content">
    <div class="page-info">
      <breadcrumbs />
      <div class="page-options">
        <router-link :to="{ name: 'report.create'}" class="btn btn-secondary">Create Report</router-link>
        <b-button variant="primary" @click="addGroup">Add Group</b-button>
      </div>
    </div>

    <div class="main-wrapper">
<!--      <h5 class="mb-4 ml-2">Groups</h5>-->
      <div class="row">

        <div class="col-xl" v-for="(oneColumnGroups,i) in columnGroups" :key="i">

          <div class="card" v-for="(group,i) in oneColumnGroups" :key="i">
            <div class="card-header style-0">
              <div class="d-flex justify-content-between">
                <div class="item-title table-field-wrapper">
                  <input type="text" class="table-field style-0 table-field-title" placeholder="Enter Group Name" @input="updateGroup(group)" v-model="group.name">
                </div>
                <div class="item-actions">
                  <a href="#" @click.prevent="addItem(group.id)" class="text-muted py-0 px-1">
                    <font-awesome-icon :icon="['fas', 'plus']" />
                  </a>
                  <a href="#" @click.prevent="deleteGroup(group)" class="text-muted py-0 px-1">
                    <font-awesome-icon :icon="['fas', 'trash']" />
                  </a>
                </div>
              </div>
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item" v-for="(item,i) in group.items" :key="i">
                <div class="d-flex justify-content-between">
                  <div class="item-title table-field-wrapper">
                    <input type="text" class="table-field style-0" placeholder="Enter Item Name" @input="updateGroupItem(item)" v-model="item.name">
                  </div>
                  <div class="item-actions">
                    <a href="#" @click.prevent="deleteGroupItem(item)" class="text-muted py-0 px-1">
                      <font-awesome-icon :icon="['fas', 'trash']" />
                    </a>
                  </div>
                </div>
              </li>
            </ul>
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
  </div>
</template>

<script>
  import Breadcrumbs from "../components/Breadcrumbs";
  import {mapGetters, mapActions} from "vuex";
  import _ from "lodash"
  import axios from "axios";
  import Form from "vform";

    export default {
        name: "groups",
      data:function(){
          return {
            add_report_modal: new Form({
              name:"",
              company:0,
              groups:[],
              date:"",
            }),
            delete_modal: {
              show: false,
              message: "",
            },
            deleteTarget: {
              target:null,
              type:'',
            }
          }
      },
      components:{

        Breadcrumbs,
      },
      computed:{
        ...mapGetters({
          groups: 'app/groups',
          group_items_count: 'app/group_items_count'
        }),
        columnGroups(){
          let limit = Math.ceil(this.group_items_count);
          limit += this.groups.length;
          limit = Math.ceil(limit / 3);
          let count = 0;
          let columnGroups = [[],[],[]];
          this.groups.forEach(function (group) {
            let length = group.items?group.items.length:0;
            count += length+1;
            if(count <= limit){
              columnGroups[0] = columnGroups[0].concat([group]);
            }else if(count <= 2*limit){
              columnGroups[1] = columnGroups[1].concat([group]);
            }else if(count <= 3*limit){
              columnGroups[2] = columnGroups[2].concat([group]);
            }
          })
          return columnGroups;

        },

      },
      beforeCreate() {
        this.$store.dispatch('app/fetchGroupsWithItems')
      },
      methods:{
        save(action,data){
          data.action = action;
          this.$store.dispatch('app/save', data)
        },

        updateGroupItem : _.debounce( async function(item){
          let form = new Form({
            item_name: item.name
          });

          const { data } = await form.put(`api/items/${item.id}`)
          this.save('UPDATE_GROUP_ITEM',data);


        },2000),

        updateGroup : _.debounce( async function(group){
          let form = new Form({
            group_name: group.name,
          });
          const { data } = await form.put(`api/groups/${group.id}`)
          this.save('UPDATE_GROUP',data)
        },2000),

        async addItem(group_id){

          let form = new Form({
            group_id:group_id
          })
          const { data } = await form.post(`/api/items/add`);
          this.save('ADD_GROUP_ITEM',data);

        },
        async addGroup(){

          const { data } = await axios.post(`/api/groups/add`);
          this.save('ADD_GROUP',data);
        },
        deleteGroup(group){
          this.delete_modal.message = "Are you sure you want to delete this group?";
          this.delete_modal.show = true;
          this.deleteTarget.target = group;
          this.deleteTarget.type = "group";
        },

        deleteGroupItem(item){
          this.delete_modal.message = "Are you sure you want to delete this group item?";
          this.delete_modal.show = true;

          this.deleteTarget.target = item;
          this.deleteTarget.type = "group_item";
        },
        close(){
          this.delete_modal.show = false;
          this.add_report_modal.show = false;
        },
        async removeTarget(){
          let target = this.deleteTarget.target;
          let type = this.deleteTarget.type;
          if(type == "group"){
            const { data } = await axios.delete(`api/groups/${target.id}`);
            let options = {group: target}
            this.save("DELETE_GROUP",options);
          }else if(type == "group_item"){
            const { data } = await axios.delete(`api/items/${target.id}`);
            let options = {item: target}
            this.save("DELETE_GROUP_ITEM",options);
          }

          this.close();
        }
      }

    }
</script>

<style scoped>

</style>
