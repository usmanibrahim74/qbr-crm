<template>
  <div class="page-content">
    <div class="page-info">
      <breadcrumbs />
    </div>


    <div class="main-wrapper">


      <div class="row">
        <div class="col-xl">
          <h5 class="mb-4 ml-2">Report Settings</h5>
          <div class="card">
            <div class="card-body">

              <form action="" @submit.prevent="saveSummary" method="post" class="row">
                <div class="col-12">
                  <div class="form-group">
                    <label for="summary">Executive Summary:</label>
                    <textarea v-model="summary" class="form-control" name="" id="summary" style="resize: vertical" rows="10"></textarea>
                  </div>
                </div>
                <div class="col-12">
                  <div class="text-right">
                    <b-button type="submit" variant="primary">
                      Save
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
  import Breadcrumbs from "../components/Breadcrumbs";
  import {mapGetters} from "vuex";
  import Form from "vform";
    export default {
        name: "settings",
      middleware: 'auth',
        data(){
          return {
            summary: "",
          }
        },
        beforeCreate() {
          this.$store.dispatch('app/fetchSummary');
        },
      components:{
          Breadcrumbs
      },
      computed:{
          ...mapGetters({
            executiveSummary : "app/summary",
          })
        },
      methods:{
        async saveSummary(){
          let form = new Form({
            summary: this.summary
          });
          console.log(form);
          const { data } = await form.post(`api/settings/summary`);
          data.action = "FETCH_SUMMARY_SUCCESS";
          this.$store.dispatch('app/save', data);
        }
      },
        watch:{
          'executiveSummary':{
            deep:true,
            handler(){
              this.summary = this.executiveSummary;
            }
          }
        }
    }
</script>

<style scoped>

</style>
