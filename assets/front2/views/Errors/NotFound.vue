<template>
  <div>
    <h1 v-text="message">Nie znaleziono strony</h1>
    <div class="mt-40">
      <nuxt-link :to="{path:'/'}" class="button scrollTo">Przejdź do strony głównej</nuxt-link>
    </div>
  </div>
</template>

<script>
export default {
  name: "NotFound",
  props:['message'],
  head () {
    return {
      title: 'Strony nie znaleziono',
    }
  }
}
</script>

<style scoped>

</style>
