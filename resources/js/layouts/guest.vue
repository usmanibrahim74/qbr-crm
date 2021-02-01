<template>
  <div class="main-layout auth-page sign-in" :class="{'no-loader':loaded}">

    <loader />
    <div class="connect-container align-content-stretch d-flex flex-wrap" style="display: none">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-5">
            <child />
          </div>
          <div class="col-lg-6 d-none d-lg-block d-xl-block">
            <div class="auth-image"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import Loader from '~/components/Loader'
    import {mapGetters} from "vuex";

    export default {
      name: "guest",
      mounted () {

        document.body.classList.add(localStorage.getItem('theme')+"-theme");
      },
      components:{
        Loader,
      },
      computed: {
        ...mapGetters({
          loaded: 'ui/loaded',
        }),

      },
    }
</script>

<style scoped>

</style>
