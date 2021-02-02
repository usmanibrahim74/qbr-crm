<template>
  <div class="page-header">
    <nav class="navbar navbar-expand">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <ul class="navbar-nav">
        <li class="nav-item small-screens-sidebar-link">
          <a href="#" class="nav-link"><i class="material-icons-outlined">menu</i></a>
        </li>
        <li class="nav-item nav-profile dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img class="d-inline" :src="getAssetPath('images/profile-image-1.png')" alt="profile image">
            <span>{{ user.name }}</span><i class="material-icons dropdown-icon">keyboard_arrow_down</i>
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="border: none !important">
<!--            <a class="dropdown-item" href="#">Calendar<span class="badge badge-pill badge-info float-right">2</span></a>-->
<!--            <a class="dropdown-item" href="#">Settings &amp Privacy</a>-->
<!--            <a class="dropdown-item" href="#">Switch Account</a>-->
<!--            <div class="dropdown-divider"></div>-->
            <a href="#" @click.prevent="logout" class="dropdown-item">
              Log out
            </a>
          </div>
        </li>
<!--        <li class="nav-item">-->
<!--          <a href="#" class="nav-link"><i class="material-icons-outlined">mail</i></a>-->
<!--        </li>-->
<!--        <li class="nav-item">-->
<!--          <a href="#" class="nav-link"><i class="material-icons-outlined">notifications</i></a>-->
<!--        </li>-->
        <li class="nav-item">
          <theme-toggler />
        </li>
      </ul>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-0">
<!--          <li class="nav-item">-->
<!--            <a href="#" class="nav-link">Projects</a>-->
<!--          </li>-->
          <li class="nav-item">
            <router-link :to="{ name: 'groups' }" class="dropdown-item">
              Groups
            </router-link>
          </li>
          <li class="nav-item mr-0">
            <router-link :to="{ name: 'reports' }" class="dropdown-item">
              Reports
            </router-link>
          </li>
        </ul>
      </div>
      <div class="navbar-search" v-if="false">
        <form>
          <div class="form-group">
            <input type="text" name="search" id="nav-search" placeholder="Search...">
          </div>
        </form>
      </div>
    </nav>
  </div>

</template>

<script>
  import { mapGetters } from 'vuex'
  import ThemeToggler from "./ThemeToggler";
    export default {
        name: "Header",
      components:{
        ThemeToggler,
      },
      computed:{
          ...mapGetters({
            user: 'auth/user'
          })
      },
      methods:{
        async logout () {
          // Log out the user.
          await this.$store.dispatch('auth/logout')

          // Redirect to login.
          this.$router.push({ name: 'login' })
        }
      }
    }
</script>

<style scoped>

</style>
