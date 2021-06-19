<template>
  <div class="media" style="cursor: pointer" @click.stop="$router.push(offer.slug)">
    <img
      alt=""
      class="img-fluid blur-up lazyload"
      :src="offer.logo.modifyPath">
    <h6 v-text="offer.title" class="h6"></h6>
  </div>
</template>

<script>
export default {
  name: 'NoLink',
  props: ['offer']
}
</script>

<style scoped>

</style>
