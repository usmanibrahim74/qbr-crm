<template>
  <div class="page-content">

  </div>
</template>

<script>
export default {
  middleware: 'auth',
  layout:'app',

  metaInfo () {
    return { title: this.$t('home') }
  }
}
</script>
