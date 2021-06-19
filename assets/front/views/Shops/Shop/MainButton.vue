<template>
  <a @click.prevent="" id="main-button" class="btn btn-solid" :class="{'hover-btn' : isHoverStyle}" data-target="#addtocart" data-toggle="modal" href="#">
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
