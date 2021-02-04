<template>
  <div class="page-content">
    <div class="page-info">
      <breadcrumbs />
    </div>


    <div class="main-wrapper">


      <div class="row">
        <div class="col-xl">
          <h5 class="mb-4 ml-2">Edit Customer</h5>
          <div class="card">
            <div class="card-body">

              <form action="" @submit.prevent="updateCustomer" method="post" class="row" enctype="multipart/form-data">
                <div class="col-12">
                  <div class="form-group">
                    <label for="customer-name">Company name:</label>
                    <input type="text" required v-model="customer_data.name" class="form-control"
                           id="customer-name" name="name">
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <label for="location-name">Location:</label>
                    <input type="text" required v-model="customer_data.location" class="form-control"
                           id="location-name" name="location">
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <label for="contact-name">Contact Name:</label>
                    <input type="text" v-model="customer_data.contact_name" class="form-control"
                           id="contact-name" name="contact-name">
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <label for="contact-phone">Contact Number:</label>
                    <input type="number" v-model="customer_data.contact_number" class="form-control"
                           id="contact-phone" name="contact-phone">
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <label for="contact-email">Contact Email:</label>
                    <input type="email" v-model="customer_data.contact_email" class="form-control"
                           id="contact-email" name="contact-email">
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <label for="notes">Notes:</label>
                    <input type="text" v-model="customer_data.notes" class="form-control"
                           id="notes" name="notes">
                  </div>
                </div>

                <div class="col-12">
                  <div class="form-group">
                    <label for="customer-description">Description:</label>
                    <textarea name="description" id="customer-description" cols="30" rows="10"
                              required v-model="customer_data.description" class="form-control" style="resize: vertical" ></textarea>
                  </div>
                </div>
                <div class="col-xl">
                  <div class="text-right">
                    <b-button type="submit" variant="primary">
                      Update Customer
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
  import {mapGetters} from "vuex";
  import Form from "vform";

  export default {
    name: "create",
    data:function(){
      return {
        customer_data: {
          name:"",
          location:"",
          contact_name: "",
          contact_number: "",
          contact_email: "",
          notes:"",
          description:"",
          logo:"",
        },
      }
    },
    beforeCreate() {
      let id = this.$route.params.id;
      this.$store.dispatch('app/fetchCustomer',{id:id});
    },
    computed:{
      ...mapGetters({
        customer: "app/customer"
      })
    },
    components:{

      Breadcrumbs,
    },


    methods:{
      async updateCustomer(){
        let form = new Form({
          name: this.customer_data.name,
          description: this.customer_data.description,
        })
        await form.put(`/api/customer/${this.customer.id}`);
        this.$router.push({ name: 'customers' })
      }
    },
    watch:{
      "customer":{
        deep:true,
        handler(){
          this.customer_data = this.customer;
        }
      }
    }

  }
</script>

<style lang="scss" scoped>



</style>
