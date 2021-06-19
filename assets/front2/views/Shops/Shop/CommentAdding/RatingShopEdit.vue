<template>
  <div class="col-md-12 mb-1">
    <div class="media-body ml-3">
      <div class="rating-shop three-star">
        <i
          class="fa"
          style="cursor: pointer"
          v-for="i in 5" :class="stars(i)"
          @mouseenter="setRatingMouse(i)"
          @mouseleave="setRatingMouse(0)"
          @click="saveRating(i)"
        />
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'RatingShopEdit',
  data() {
    return {
      rating: 0,
      clickRating: null
    }
  },
  computed: {
    roundRating() {
      return Math.round(this.rating * 2) / 2;
    }
  },
  methods: {
    saveRating(i) {
      this.clickRating = i;
      this.rating = i;
      this.$emit('setRatingComment', this.clickRating);
    },
    setRatingMouse(i) {
      if (this.clickRating === null) {
        this.rating = i;
      }
    },
    stars(i) {
      return {
        'fa-star' : this.roundRating - i >= 0,
        'fa-star-half-o' : this.roundRating - i > -1 && this.roundRating - i < 0,
        'fa-star-o' : this.roundRating - i <= -1
      }
    }
  }
}
</script>

<style scoped>
div.rating-shop > i {
  font-size: 25px;
  margin-right: 10px;
}
</style>
