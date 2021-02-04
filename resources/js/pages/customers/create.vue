<template>
  <div class="page-content">
    <div class="page-info">
      <breadcrumbs />
    </div>


    <div class="main-wrapper">


      <div class="row">
        <div class="col-xl">
          <h5 class="mb-4 ml-2">Add Customer</h5>
          <div class="card">
            <div class="card-body">

              <form action="" @submit.prevent="addCustomer" method="post" class="row" enctype="multipart/form-data">
                <div class="col-12">
                  <div class="form-group">
                    <label for="customer-name">Company name:</label>
                    <input type="text" required v-model="customer.name" class="form-control"
                           id="customer-name" name="name">
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <label for="location-name">Location:</label>
                    <input type="text" required v-model="customer.location" class="form-control"
                           id="location-name" name="location">
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <label for="contact-name">Contact Name:</label>
                    <input type="text" v-model="customer.contact_name" class="form-control"
                           id="contact-name" name="contact-name">
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <label for="contact-phone">Contact Number:</label>
                    <input type="number" v-model="customer.contact_number" class="form-control"
                           id="contact-phone" name="contact-phone">
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <label for="contact-email">Contact Email:</label>
                    <input type="email" v-model="customer.contact_email" class="form-control"
                           id="contact-email" name="contact-email">
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <label for="notes">Notes:</label>
                    <input type="text" v-model="customer.notes" class="form-control"
                           id="notes" name="notes">
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <label for="customer-description">Description:</label>
                    <textarea name="description" id="customer-description" cols="30" rows="10"
                              required v-model="customer.description" class="form-control" style="resize: vertical" ></textarea>
                  </div>
                </div>
                <div class="col-xl">
                  <div class="text-right">
                    <b-button type="submit" variant="primary">
                      Add Customer
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
  import Form from "vform";

  export default {
    name: "create",
    middleware: 'auth',
    data:function(){
      return {
        customer: new Form({
          name:"",
          location:"",
          contact_name: "",
          contact_number: "",
          contact_email: "",
          notes:"",
          description:"",
          logo:"",
        }),
      }
    },
    components:{

      Breadcrumbs,
    },


    methods:{
      async addCustomer(){
        await this.customer.post('/api/customer/add');
        this.$router.push({ name: 'customers' })
      }
    }

  }
</script>

<style lang="scss" scoped>



</style>
