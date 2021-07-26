<template>
  <rating :rating="rating"/>
</template>

<script>
import Rating from "@/components/Rating/Rating";

export default {
  name: 'RatingShop',
  components: {Rating},
  computed:{
    rating() {
      return this.$store.getters.model.rating;
    }
  }
}
</script>

<style scoped>

</style>
