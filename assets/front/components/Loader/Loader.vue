<template>
  <div>
    <div class='preloader' :class="{'loaderout' : !loader}">
      <div class='loader-center'>
        <div class='loader'>
          <div class='circle circle-1'></div>
          <div class='circle circle-2'></div>
          <div class='circle circle-3'></div>
          <div class='circle circle-4'></div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import anime from "animejs";

export default {
  name: "Loader",
  data(){
    return {
      DOMLoading: true,
    }
  },
  computed:{
    loader()
    {
      return this.$store.getters.loader || this.DOMLoading;
    }
  },
  methods:{
    finishLoader()
    {
      this.DOMLoading = false;
      let loaders = document.getElementsByClassName('preloader');
      for (let item in loaders) {
        loaders[item].style.display = 'block';
      }
    },
    anime()
    {
      "use strict";
      var circle1 = anime({
        targets: ['.circle-1'],
        translateY: -24,
        translateX: 52,
        direction: 'alternate',
        loop: true,
        elasticity: 400,
        easing: 'easeInOutElastic',
        duration: 800,
        delay: 100
      });

      var circle2 = anime({
        targets: ['.circle-2'],
        translateY: 24,
        direction: 'alternate',
        loop: true,
        elasticity: 400,
        easing: 'easeInOutElastic',
        duration: 800,
        delay: 100
      });

      var circle3 = anime({
        targets: ['.circle-3'],
        translateY: -24,
        direction: 'alternate',
        loop: true,
        elasticity: 400,
        easing: 'easeInOutElastic',
        duration: 800,
        delay: 100
      });

      var circle4 = anime({
        targets: ['.circle-4'],
        translateY: 24,
        translateX: -52,
        direction: 'alternate',
        loop: true,
        elasticity: 400,
        easing: 'easeInOutElastic',
        duration: 800,
        delay: 100
      });
    }
  },
  mounted() {
    this.anime();

    window.onload = this.finishLoader;
   }
}
</script>

<style scoped>

</style>
