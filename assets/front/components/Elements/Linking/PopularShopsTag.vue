<template>
  <div class="tags marT20">
    <h4 class="orange marB10 marL40 capital">Popularne sklepy</h4>
    <div class="links-tag">
      <span v-for="(link, index) in this.$store.getters.initFront.data.links.popularShops" :key="index"><nuxt-link :to="{path: link.slug}" v-text="link.anchor"></nuxt-link></span>
    </div>
  </div>
</template>

<script>
export default {
name: "PopularShopsTag"
}
</script>

<style scoped>

</style>
