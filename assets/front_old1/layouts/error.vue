<template>
<div>
  <error-page :error="error"/>
</div>

</template>
<style>

</style>
<script>

  import ErrorPage from "@/views/Errors/ErrorPage";

  export default {
    components: {ErrorPage},
    props:['error'],
    created() {
      this.$nuxt.setLayout('default');

    }
  }
</script>
