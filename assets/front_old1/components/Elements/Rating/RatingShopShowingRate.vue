<template>
  <ul class="stars">
    <template v-for="i in 5">
      <li v-if="i <= rating">
        <font-awesome-icon icon="star"/>
      </li>
      <li v-else-if="i > rating && i < rating+1">
        <font-awesome-icon icon="star-half-alt"/>
      </li>
      <li class="grey-a" v-else>
        <font-awesome-icon icon="star"/>
      </li>
    </template>
  </ul>
</template>

<script>
export default {
  name: "RatingShopShowingRate",
  props:['rating'],
  computed:{
    roundRating()
    {
      return Math.round(this.rating * 2)/2
    }
  }
}
</script>

<style scoped>

</style>
