<template>
  <div>
    <h1 v-text="error.message"></h1>
    <div class="mt-40">
      <nuxt-link :to="{path:'/'}" class="button scrollTo">Przejdź do strony głównej</nuxt-link>
    </div>
    <div class="mt-40 " v-if="error.tokenDebug">
      <h3 class="h3 bold"><a :href="error.tokenDebug.link" target="_blank">{{ error.tokenDebug.token }}</a></h3>
    </div>
  </div>
</template>

<script>
export default {
  props:['error'],
  name: 'ErrorPage',
}
</script>

<style scoped>

</style>
