<template>
  <div class="page-content">
    <div class="page-info">
      <breadcrumbs />
    </div>


    <div class="main-wrapper">
      <div class="row stats-row">
        <div class="col-lg-4 col-md-12">
          <div class="card card-transparent stats-card">
            <div class="card-body">
              <div class="stats-info">
                <h5 class="card-title">{{ customers }}</h5>
                <p class="stats-text">Cutomers</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-12">
          <div class="card card-transparent stats-card">
            <div class="card-body">
              <div class="stats-info">
                <h5 class="card-title">{{ reports }}</h5>
                <p class="stats-text">Reports</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-12">
          <div class="card card-transparent stats-card">
            <div class="card-body">
              <div class="stats-info">
                <h5 class="card-title">{{ groups }}</h5>
                <p class="stats-text">Groups</p>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>

  </div>
</template>

<script>
    import Breadcrumbs from "../components/Breadcrumbs";
    import axios from "axios";
    export default {
        name: "dashboard",
      middleware: 'auth',
      data(){
          return {
            customers: 0,
            groups:0,
            reports:0,
          }
      },
      components:{
          Breadcrumbs
      },
      created() {
          this.getStats()
      },
      methods:{
          async getStats(){
            const { data } = await axios.get('/api/dashboard')
            this.customers = data.customers;
            this.groups = data.groups;
            this.reports = data.reports;
          }
      }
    }
</script>

<style scoped>

</style>
