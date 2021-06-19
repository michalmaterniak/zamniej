<template>
<div>
  <!-- section start -->
  <section class="p-0">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="error-section">
            <h1 v-text="error.statusCode"></h1>
            <h2>{{ error.message }} {{ heheszek }}</h2>
            <nuxt-link class="btn btn-solid" :to="{path: '/'}">Przejdź do strony głównej</nuxt-link>
            <nuxt-link class="btn btn-solid" :to="{path: $router.back()}">Przejdź do poprzedniej strony</nuxt-link>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Section ends -->
</div>

</template>
<style>

</style>
<script>

  import ErrorPage from "@/views/Errors/ErrorPage";

  export default {
    components: {ErrorPage},
    props:['error'],
    computed: {
      heheszek() {
        if (this.error.statusCode >= 400 && this.error.statusCode < 500) {
          return '¯\\_(ツ)_/¯';
        } else if (this.error.statusCode >= 500) {
          return '¯\\(°_o)/¯';
        }
      }
    },
    head () {
      return {
        title: this.error.statusCode + ' - ' + this.error.message,
        meta: [
          { hid: 'description', name: 'description', content: this.error.statusCode + ' - ' + this.error.message }
        ]
      }
    },
  }
</script>
