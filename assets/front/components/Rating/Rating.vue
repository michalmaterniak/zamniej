<template>
  <div class="media-body ml-3">
    <div class="rating-shop three-star">
      <i class="fa" v-for="i in 5" :class="stars(i)"></i>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Rating',
  props: ['rating'],
  computed: {
    roundRating() {
      return Math.round(this.rating.rating * 2) / 2;
    }
  },
  methods: {
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

</style>
