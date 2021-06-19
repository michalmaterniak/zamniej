<template>
  <div v-if="$store.getters.typePage === 'Categories-Categories'">
<!--    <bread-crumbs/>-->
    <div class="categories-section bg padTB60">
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-sm-4 col-xs-12 marB30 categories-list" v-for="(category, index) in categories" v-if="category.count > 0" :key="index">
            <div class="categorie-box pointer" @click.stop="$router.push({path: category.slug})">
              <figure>
                <img :src="category.logo.modifyPath" :alt="category.logo.original.data.alt" class="thumb-category">
                <figcaption>
                  <a href="#"><i :class="category.icon"></i></a>
                  <h3>
                    <nuxt-link :to="{path: category.slug}" class="nav-item nav-link" exact-active-class="active" v-text="category.name"></nuxt-link>
                  </h3>
                </figcaption>
              </figure>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import CategoriesMenu from "@/components/Menu/Categories/Categories";
import BreadCrumbs from "@/components/BreadCrumbs/BreadCrumbs";

export default {
  name: "Categories",
  components: {BreadCrumbs, CategoriesMenu},
  computed:{
    model()
    {
      return this.$store.getters.model;
    },
    categories()
    {
      return this.$store.getters.model.subpage.categoriesTiles;
    }
  },
}
</script>

<style scoped>

.thumb-category
{
  width: 100%;
  height: 245px;

}

/*@media (max-width: 600px) {*/
/*  .thumb-category*/
/*  {*/
/*    width: 75%;*/
/*    height: 100%;*/

/*  }*/
/*}*/

</style>
