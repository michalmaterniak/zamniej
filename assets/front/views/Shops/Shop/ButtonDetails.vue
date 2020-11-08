<template>
  <div id="open-button-shop-details"></div>
</template>

<script>
export default {
  name: "ButtonDetails",
  mounted() {
    let buttonShopDetails = document.getElementById('open-button-shop-details')
    if (buttonShopDetails)
      this.shopDetailsHeight = buttonShopDetails.getBoundingClientRect().y;
  }
}
</script>

<style scoped>

</style>
