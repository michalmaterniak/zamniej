<template>
  <div class="popular-stores bg padTB60">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12 marB30">
          <div class="section-box">
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="boxbg">
                <h3><i class="flaticon-commerce"></i> najpopularniejsze sklepy</h3>
              </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="symbol">
                <h5>zobacz wszystkie<nuxt-link :to="{path: 'sklepy'}"><i class="flaticon-external-link-symbol"></i></nuxt-link></h5>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-3 col-xs-6 marB30"  v-for="(shop, index) in shops" :key="index">
          <div class="brand-img">
            <figure>
              <img :src="shop.logo.modifyPath" :alt="shop.logo.original.data.alt">
              <figcaption>
                <h4><nuxt-link :to="{path: shop.slug}" v-text="shop.name"></nuxt-link></h4>
              </figcaption>
            </figure>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "PopularStores",
  props: ['shops']
}
</script>

<style scoped>

</style>
