<template>
  <div class="page-content">
    <div class="page-info">
      <breadcrumbs />
    </div>


    <div class="main-wrapper">


      <div class="row">
        <div class="col-xl">
          <h5 class="mb-4 ml-2">Create Report</h5>
          <div class="card">
            <div class="card-body">

              <form action="" @submit.prevent="addReport" method="post" class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="report-name">Report name:</label>
                    <input type="text" required v-model="report.name" class="form-control" id="report-name" name="name">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="report-date">Report date:</label>
                    <input required type="date" v-model="report.date" class="form-control" id="report-date" name="date">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="report-date">Quarter:</label>
                    <input required type="text" v-model="report.quarter" class="form-control" id="report-quarter" name="quarter">
                  </div>
                </div>
                <div class="col-md-6">

                  <div class="form-group">
                    <label for="customer">Select Customer:</label>
                    <select name="customer" required v-model="report.customer" id="customer" class="form-control">
                      <option v-for="(customer,i) in customers" :key="i" :value="customer.id">{{ customer.name }}</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="report-groups">Select Groups:</label>
                    <v-select v-model="report.groups" id="report-groups" :options="getGroupOptions"
                              class="form-control" :multiple="true" >
                      <template #option="{ label }">
                        <p class="v-select-options mb-0">{{ label }}</p>
                      </template>
                      <template #search="{attributes, events}">
                        <input
                          class="vs__search"
                          :required="!selected"
                          v-bind="attributes"
                          v-on="events"
                        />
                      </template>
                    </v-select>
                  </div>
                </div>
                <div class="col-md-12">

                  <div class="form-group">
                    <label for="report-summary">Summary:</label>
                    <textarea name="summary" id="report-summary" v-model="report.summary" cols="30" rows="10" class="form-control" style="resize: vertical"></textarea>
                  </div>
                </div>
                <div class="col-xl">
                  <div class="text-right">
                    <b-button type="submit" variant="primary">
                      Create Report
                    </b-button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

    </div>

  </div>
</template>

<script>
  import Breadcrumbs from "~/components/Breadcrumbs";

  // import DeleteGroupItem from "../components/modals/DeleteGroupItem";
  // import {mapGetters, mapActions} from "vuex";
  // import _ from "lodash"
  // import axios from "axios";
  import Form from "vform";
  import {mapGetters} from "vuex";

  export default {
    name: "create",
    middleware: 'auth',
    data:function(){
      return {
        report: new Form({
          name:"",
          customer:0,
          groups:[],
          date:"",
          quarter:"",
          summary:"",
        }),
      }
    },
    computed:{
      ...mapGetters({
        groups: 'app/groups',
        customers: 'app/customers',
      }),
      selected(){
        return this.report.groups.length>0?true:false;
      },
      getGroupOptions(){
        let groups = [];
        this.groups.forEach((item)=>{
          let group = {
            label: item.name,
            value: item.id,
          }
          groups.push(group);
        })
        return groups;
      }
    },
    components:{

      Breadcrumbs,
    },

    beforeCreate() {
      this.$store.dispatch('app/fetchGroups');
      this.$store.dispatch('app/fetchCustomers');
    },

    methods:{
      async addReport(){
        await this.report.post('/api/report/add');
        this.$router.push({ name: 'reports' })
      }
    }

  }
</script>

<style lang="scss" scoped>



</style>
