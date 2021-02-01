<template>
  <div class="main-layout" :class="{'no-loader':loaded}">

    <loader />
    <div class="connect-container align-content-stretch d-flex flex-wrap" style="display: none">
      <sidebar />
      <div class="page-container">
        <page-header />
        <child />
      </div>
    </div>
  </div>
</template>

<script>
import Loader from '~/components/Loader'
import Sidebar from '~/components/Sidebar'
import Header from '~/components/Header'
import {mapGetters} from "vuex";
export default {
  name: 'App',
  components: {
    Loader,
    Sidebar,
    "page-header":Header,
  },
  mounted () {

    document.body.classList.add(localStorage.getItem('theme')+"-theme");
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
