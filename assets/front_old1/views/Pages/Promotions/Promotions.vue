<template>
  <div v-if="$store.getters.typePage === 'Pages-Promotions-Promotions'">
    <div id="container-deals" class="deals bg padTB60">
      <div class="masonry masonry-columns-5">
        <div class="masonry-item" :key="index" v-for="(offer, index) in offers">
          <grid-promotions :offer="offer"/>
        </div>
      </div>
      <infinity-scroll-observer @intersect="changePage"/>
    </div>
    <div class="clear"></div>
  </div>
</template>

<script>
import RatingShopShowing from "@/components/Elements/Rating/RatingShopShowing";
import GridPromotions from "@/views/Pages/Promotions/Grid/GridPromotions";
import InfinityScrollObserver from "@/components/Observers/InfinityScrollObserver";

export default {
  name: "Promotions",
  components: {
    InfinityScrollObserver, GridPromotions, RatingShopShowing,
  },
  data() {
    return {
      offers: [],
      page: 1,
    }
  },

  methods: {
    changePage() {
      this.getPage('promotions', {page: this.page+1}, false).then(res => {
        this.page++;
        this.offers = this.offers.concat(res.data.promotions);
        this.$router.push({query: {page: this.page}, params: {scroll: false}});
      })
    },
  },
  created() {
    this.offers = [...this.$store.getters.model.subpage.offers];
  }
}
</script>

<style scoped>

</style>
