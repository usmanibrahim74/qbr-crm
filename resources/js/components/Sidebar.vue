<template>
  <div class="page-sidebar">
    <div class="logo-box">
      <a href="#" class="logo-text" style="width: 140px">
      <img :src="getAssetPath('images/cn-logo.png')" class="w-100" alt="">
    </a><a href="#" id="sidebar-close"><i class="material-icons">close</i></a> <a href="#" id="sidebar-state"><i class="material-icons">adjust</i><i class="material-icons compact-sidebar-icon">panorama_fish_eye</i></a></div>
    <div class="page-sidebar-inner slimscroll" v-slimscroll="scrollOptions">
      <ul class="accordion-menu">
        <li>
          <router-link :to="{ name: 'dashboard'}"><i class="material-icons">dashboard</i>Dashboard</router-link>
        </li>

        <li>
          <a href=""><i class="material-icons">group</i>Customers<i class="material-icons has-sub-menu">add</i></a>
          <ul class="sub-menu">
            <li>
              <router-link :to="{ name: 'customer.create'}">Add Customer</router-link>
            </li>
            <li>
              <router-link :to="{ name: 'customers'}">View All</router-link>
            </li>
          </ul>
        </li>
        <li>
          <a href="#"><i class="material-icons">apps</i> Reports<i class="material-icons has-sub-menu">add</i></a>
          <ul class="sub-menu">
            <li>
              <router-link :to="{ name: 'report.create'}">Create</router-link>
            </li>
            <li>
              <router-link :to="{ name: 'reports'}">View All</router-link>
            </li>
            <li>
              <router-link :to="{ name: 'settings.report'}">Report Settings</router-link>
            </li>
          </ul>
        </li>

        <li>
          <router-link :to="{ name: 'groups'}"><i class="material-icons">category</i>Groups</router-link>
        </li>
        <li>
          <router-link :to="{ name: 'deskpro'}"><font-awesome-icon class="fontawesome-sidebar-icon" :icon="['fab', 'deskpro']" />Deskpro</router-link>
        </li>
        <li>
          <a href="#"><i class="material-icons">settings</i> Settings<i class="material-icons has-sub-menu">add</i></a>
          <ul class="sub-menu">
            <li>
              <router-link :to="{ name: 'settings.profile'}">Profile</router-link>
            </li>
            <li>
              <router-link :to="{ name: 'settings.password'}">Password</router-link>
            </li>
          </ul>
        </li>


      </ul>
    </div>
  </div>

</template>

<script>
    export default {
        name: "Sidebar",
        data(){
          return{
            scrollOptions:{
              wheelStep: 5,
              touchScrollStep: 30,
              opacity: 0
            }
          }
        }
    }
</script>

<style scoped>

</style>
