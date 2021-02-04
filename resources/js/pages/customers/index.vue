<template>
  <div class="page-content">
    <div class="page-info">
      <breadcrumbs />

      <div class="page-options">
        <router-link :to="{ name: 'customer.create'}" class="btn btn-primary">Add Customer</router-link>

      </div>
    </div>

    <div class="main-wrapper">
      <div class="row">
        <div class="col-xl">
          <h5 class="mb-4 ml-2">Customers</h5>
          <div class="card">
            <div class="card-body table-responsive" v-if="customers.length">

              <b-table :items="customers" :fields="fields">
                <template #head(actions)="data">
                  <div class="text-center">
                    <span>{{ data.label }}</span>
                  </div>
                </template>
                <template #cell(actions)="data">
                  <div class="text-center" style="font-size: 20px">

                    <router-link :to="{ name: 'customer.view', params:{id:data.item.id}}" class="text-muted">
                      <font-awesome-icon :icon="['fas', 'edit']" class="table-action-icon mr-1" />
                    </router-link>
                    <a href="#" class="text-muted" @click="deleteCustomer(data.item.id)">
                      <font-awesome-icon :icon="['fas', 'trash']" class="table-action-icon" />
                    </a>
                  </div>
                </template>
              </b-table>

            </div>
            <div class="card-body text-center" v-else>
              <h5 class="card-title">No Customer</h5>
              <p class="card-text">There are no customers to show.</p>
              <router-link :to="{ name: 'customer.create' }" class="btn btn-primary">
                Add Customer
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

      <p>Deleting a customer will delete all the reports associated with that customer. Are you sure you want to delete this customer?</p>

      <template #modal-footer>

        <b-button variant="secondary" @click="close()">
          Cancel
        </b-button>
        <b-button variant="danger" @click="removeCustomer">
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
    name: "customers",
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
            label: "Company Name",
            sortable: true
          },
          {
            key: 'location',
            label: "Location",
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
      this.$store.dispatch('app/fetchCustomers');
    },
    computed:{
      ...mapGetters({
        customers: 'app/customers',
      }),
    },
    methods:{
      deleteCustomer(customer_id){
        this.delete_modal.customer_id = customer_id;
        this.delete_modal.show = true;
      },
      close(){
        this.delete_modal.show = false;
      },
      async removeCustomer(){

        await axios.delete(`/api/customer/${this.delete_modal.report_id}`)
        this.$store.dispatch('app/fetchCustomers');
        this.close();
      }
    }
  }
</script>

<style scoped>

</style>
