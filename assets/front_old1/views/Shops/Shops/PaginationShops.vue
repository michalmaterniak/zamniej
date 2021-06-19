<template>

    <div id="pagination-box" class="pagination-box text-center" :class="{'sticky-top': this.paginationOffsetTop && this.scrollY >= this.paginationOffsetTop}">

    <!--    <div class="row text-right">-->
<!--      <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-lg-offset-8">-->
<!--        <input class="form-control" type="text">-->
<!--      </div>-->
<!--    </div>-->
    <nuxt-link :to="{query: {letter: letter}, params: {scroll: true}}" class="uppercase" :class="{active: letterActive == letter }" v-for="(letter, index) in letters" :key="index">
      <span v-if="letter == 0" v-text="'0-9'"></span>
      <span v-else v-text="letter"></span>
    </nuxt-link>

  </div>
</template>

<script>
import mouse from "@/mixins/mouse";

export default {
  name: "PaginationShops",
  props:['letterActive', 'letters'],
  mixins:[mouse],
  data()
  {
    return {
      paginationOffsetTop: null,

      scrollY: 0,
    }
  },
  methods:{
    preventDefaultScroll(e) {
      if((e.deltaY && e.deltaY < 0) || (e.key === 'ArrowRight' || e.keyCode === 39))
        this.$router.push({query: {letter: this.nextLetter()}, params: {scroll: false, animate:true}});
      else if((e.deltaY && e.deltaY > 0) || (e.key === 'ArrowLeft' || e.keyCode === 37))
        this.$router.push({query: {letter: this.prevLetter()}, params: {scroll: false, animate:true}});

      e = e || window.event;
      if (e.preventDefault)
        e.preventDefault();
      e.returnValue = false;
    },
    nextLetter()
    {
      let index =  _.findIndex(this.letters, obj => {
        return obj == this.letterActive;
      });
      if(index + 1 >= this.letters.length)
        return this.letters[0];
      else
        return this.letters[index + 1];
    },
    prevLetter()
    {
      let index = _.findIndex(this.letters, obj => {
        return obj == this.letterActive;
      });
      if(index - 1 >= 0)
        return this.letters[index - 1];
      else
        return this.letters[this.letters.length-1];
    },
  },
  created() {
    this.activeLetter = this.letterActive;
  },
  mounted() {
    window.addEventListener('scroll', ev => {
      this.scrollY = window.scrollY;
    })
    this.paginationOffsetTop = $('#pagination-box').offset().top;
  },
  beforeDestroy() {
    this.exitMousePagination();
  }
}
</script>

<style scoped>

</style>
