<template>
  <!-- category 2 -->
  <section class="p-0 ratio2_1" v-if="$store.getters.typePage === 'Categories-Categories'">
    <div class="container-fluid">
      <div class="row category-border">
        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12 text-center border-padding mt-3" v-for="(category, index) in categories">
          <div class="category-banner">
            <div>
              <img alt="" class="img-fluid blur-up lazyloaded" :src="category.logo.modifyPath">
            </div>
            <div class="category-box" style="opacity: 0.5; width: 100%">
              <nuxt-link :to="{path: category.slug}">
                <h2 v-text="category.name"></h2>
              </nuxt-link>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: 'Categories',
  computed:{
    model()
    {
      return this.$store.getters.model;
    },
    categories() {
      return this.model.subpage.categoriesTiles;
    }
  }
}
</script>

<style scoped>
.category-banner > .category-box > a > h2 {
  font-size: 14px;
}
</style>
