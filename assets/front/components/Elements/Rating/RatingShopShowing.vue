<template>
  <div class="stars text-center rating-box">
    <rating-shop-showing-rate :rating="rating.rating"/>
    <h5 class="capital">(<span v-text="rating.count"></span>)</h5>
  </div>
</template>

<script>
import RatingShopShowingRate from "@/components/Elements/Rating/RatingShopShowingRate";
export default {
  name: "RatingShopShowing",
  components: {RatingShopShowingRate},
  props:{
    rating: {
      type: Object,
      default: {
        rating: 4,
        count: 1
      }
    },
  },
}
</script>

<style scoped>
ul.stars.stars-big li {
  cursor:pointer;
  font-size: 30px;
}
</style>
