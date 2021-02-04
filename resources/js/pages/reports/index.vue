<template>
  <div class="page-content">
    <div class="page-info">
      <breadcrumbs />
      <!--      <div class="page-options">-->
      <!--        <router-link :to="{ name: 'reports'}" class="btn btn-secondary">Reports</router-link>-->
      <!--        <b-button variant="primary" @click="addGroup">Add Group</b-button>-->
      <!--      </div>-->
    </div>

    <div class="main-wrapper">
      <div class="row">
        <div class="col-xl">
          <h5 class="mb-4 ml-2">Reports</h5>
          <div class="card">
            <div class="card-body table-responsive" v-if="reports.length">

              <b-table :items="reports" :fields="fields">
                <template #head(actions)="data">
                  <div class="text-center">
                    <span>{{ data.label }}</span>
                  </div>
                </template>
                <template #cell(actions)="data">
                  <div class="text-center">

                    <router-link :to="{ name: 'report.view', params:{id:data.item.id}}" class="text-muted">
                      <font-awesome-icon :icon="['fas', 'eye']" />
                    </router-link>
                    <a href="#" class="text-muted" @click="deleteReport(data.item.id)">
                      <font-awesome-icon :icon="['fas', 'trash']" />
                    </a>
                  </div>
                </template>
              </b-table>

            </div>
            <div class="card-body text-center" v-else>
              <h5 class="card-title">No Reports</h5>
              <p class="card-text">There are no reports to show.</p>
              <router-link :to="{ name: 'report.create' }" class="btn btn-primary">
                Create Report
              </router-link>
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

      <p>Are you sure you want to delete this report?</p>

      <template #modal-footer>

        <b-button variant="secondary" @click="close()">
          Cancel
        </b-button>
        <b-button variant="danger" @click="removeReport">
          Delete
        </b-button>
      </template>
    </b-modal>
  </div>
</template>

<script>
  import Breadcrumbs from "~/components/Breadcrumbs";
  import {mapGetters} from "vuex";
  import axios from "axios";

    export default {
      name: "index",
      data(){
        return {
          delete_modal:{
            show:false,
            report_id:0,
          },
          fields: [
            {
              key: 'id',
              label: "#",
              sortable: false
            },
            {
              key: 'name',
              label: "Report Name",
              sortable: true
            },
            {
              key: 'customer.name',
              label: "Customer",
              sortable: true
            },
            {
              key: 'date',
              label: "Date",
              sortable: true
            },
            'actions'
          ],
        }
      },
      components:{
        Breadcrumbs
      },
      beforeCreate() {
        this.$store.dispatch('app/fetchReports');
      },
      computed:{
        ...mapGetters({
          reports: 'app/reports',
        }),
      },
      methods:{
        deleteReport(report_id){
          this.delete_modal.report_id = report_id;
          this.delete_modal.show = true;
        },
        close(){
          this.delete_modal.show = false;
        },
        async removeReport(){

          await axios.delete(`/api/report/${this.delete_modal.report_id}`)
          this.$store.dispatch('app/fetchReports');
          this.close();
        }
      }
    }
</script>

<style scoped>

</style>
