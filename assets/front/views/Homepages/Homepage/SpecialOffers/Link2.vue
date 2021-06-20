<template>
  <div class="media" >
    <nuxt-link :to="{path: offer.slug}" class="link-discount">
      <img
        :alt="offer.logo.original.data.alt"
        class="img-fluid blur-up lazyload offer-img"
        :src="offer.logo.modifyPath"
      >
      <h6 v-text="offer.title" class="h6"></h6>
    </nuxt-link>
  </div>
</template>

<script>
export default {
  name: 'Link2',
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
.link-discount {
  text-decoration: none;
}

.link-discount:hover {
  text-decoration: slategrey;
}
</style>
