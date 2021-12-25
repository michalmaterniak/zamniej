<template>
  <div class="breadcrumb-section" v-if="isBreadCrumbs">
    <div class="container">
      <div class="row">
        <div class="col-12 col-sm-6"></div>
        <div class="col-sm-6 d-none d-sm-none d-md-block">
          <nav aria-label="breadcrumb" class="theme-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item" v-for="(breadcrumb, index) in breadcrumbs" v-if="index < breadcrumbs.length-1">
                <nuxt-link :to="{path: breadcrumb.slug}" v-text="breadcrumb.name">Strona główna</nuxt-link>
              </li>
              <li aria-current="page" class="breadcrumb-item active"><strong>{{name}}</strong></li>
            </ol>
          </nav>
        </div>
        <div class="col-sm-12">
          <div class="page-title">
            <h1 class="h6" v-text="$store.getters.model.subpage.seo.header"></h1>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'BreadCrumb',
  data() {
    return {
      breadcrumbsOnTypePage: [
        'Shops-Shop',
        'Categories-Category',
        'Categories-Category',
        'Pages-Blog-Article',
        'Pages-Blog-Articles'
      ]
    }
  },
  computed:{
    isBreadCrumbs()
    {
      return this.breadcrumbsOnTypePage.includes(this.$store.getters.typePage);
    },
    name()
    {
      return this.$store.getters.model.subpage.subpage.name;
    },
    breadcrumbs()
    {
      return this.$store.getters.model.breadcrumbs;
    }
  }
}
</script>

<style scoped>

</style>
