<template>
  <a @click.prevent="redirectShop()" id="main-button" class="btn btn-solid" :class="{'hover-btn' : isHoverStyle}" data-target="#addtocart" data-toggle="modal" href="#">
    Przejdź do sklepu
  </a>
</template>

<script>
export default {
  name: 'MainButton',
  data() {
    return {
      isHoverStyle: false,
      interval: null
    }
  },
  methods:{
    redirectShop() {
      this.$gtagEv({
        action: 'redirect',
        category: 'shop-mobile',
        label: 'shop-' + String(this.$store.getters.model.subpage.idShopAffil),
      });

      this.redirectInside(this.$store.getters.redirectLinkShop(this.$store.getters.model.subpage.idShopAffil));
    },
    startInterval() {
      this.interval = setInterval(() => {
        this.isHoverStyle = true;
        setTimeout(() => {
          this.stopInterval();
        }, 200)
      },this.$getRandomInt(1000, 8000))
    },
    stopInterval() {
      this.isHoverStyle = false;
      clearInterval(this.interval);
      this.startInterval();
    }
  },
  mounted() {
    this.startInterval();
  }
}
</script>

<style scoped>

</style>
