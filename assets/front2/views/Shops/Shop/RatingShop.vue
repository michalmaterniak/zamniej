<template>
  <rating-shop :rating="rating"/>
</template>

<script>
import RatingShop from "@/components/Rating/Rating";

export default {
  name: 'Rating',
  components: {RatingShop},
  computed:{
    rating() {
      return this.$store.getters.model.rating;
    }
  }
}
</script>

<style scoped>

</style>
