<template>
  <div class="page-content">
    <div class="page-info">
      <breadcrumbs />
    </div>


    <div class="main-wrapper">


      <div class="row">
        <div class="col-xl">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Add Customer</h5>
              <form action="" @submit.prevent="addCustomer" method="post" class="row" enctype="multipart/form-data">
                <div class="col-12">
                  <div class="form-group">
                    <label for="customer-name">Customer name:</label>
                    <input type="text" required v-model="customer.name" class="form-control"
                           id="customer-name" name="name">
                  </div>
                </div>
<!--                <div class="col-12">-->
<!--                  <div class="form-group">-->
<!--                    <label for="customer-logo">Logo:</label>-->
<!--                    <input type="file" required class="form-control"-->
<!--                           id="customer-logo" name="logo">-->
<!--                  </div>-->
<!--                </div>-->
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
    data:function(){
      return {
        customer: new Form({
          name:"",
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
