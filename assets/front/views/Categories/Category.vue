<template>
  <div v-if="$store.getters.typePage === 'Categories-Category'">
    <!-- section start -->
    <section class="section-b-space blog-page ratio2_3">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="row blog-media" v-for="(shop, index) in shops" style="cursor:pointer;" @click="$router.push({path: shop.slug})" >
              <div class="col-4 col-sm-3">
                <div class="blog-left" >
                  <nuxt-link :to="{path: shop.slug}">
                    <img style="width: 100%; height: 100%" :alt="shop.name"
                         class=""
                         :src="shop.logo.modifyPath">
                  </nuxt-link>
                </div>
              </div>
              <div class="col-8 col-sm-9 col-md-8 col-lg-6">
                <div class="box-content">
                  <h3 v-text="shop.name" class="h2-link"></h3>
                  <ul class="post-social">
                    <li><i class="fa fa-heart"></i> {{shop.rating.rating}} / {{shop.rating.count}}</li>
                  </ul>
                  <div class="mt-4" v-text="shop.description" style="bottom: 0"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Section ends -->
  </div>
</template>

<script>
export default {
  name: 'Category',
  computed: {
    model()
    {
      return this.$store.getters.model;
    },
    shops() {
      return this.model.subpage.shopsListing;
    },
  }
}
</script>

<style scoped>
.box-content {
  color: #777777;
}
.box-content > h2 {
  color: #777777;
}
.box-content > p {
  text-align: justify;
  text-justify: inter-word;
}
.blog-media:hover {
  border: 1px solid rgba(0,0,0, 0.3);
}
</style>
