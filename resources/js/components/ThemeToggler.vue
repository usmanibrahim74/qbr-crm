<template>
  <a href="#" class="nav-link" @click="toggleTheme" id="dark-theme-toggle">
    <i class="material-icons-outlined">brightness_2</i>
    <i class="material-icons">brightness_2</i></a>

</template>

<script>

  export default {
    name: "ThemeToggler",
    methods:{
      toggleTheme(){
        this.$store.commit('ui/toggleTheme');
      }
    },
  }

</script>

<style scoped>

</style>
