<template>
  <div class="media" style="cursor: pointer" @click.stop="$router.push(offer.slug)">
    <img
      alt=""
      class="img-fluid blur-up lazyload offer-img"
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
img.offer-img {
  width: 292px;
  height: 292px;
}
@media (max-width: 768px) {
  img.offer-img {
    width: 150px;
    height: 150px;
  }
}
</style>
