<template>
  <div id="pagination-box" class="product-pagination text-center" :class="{'sticky-top': this.paginationOffsetTop && this.scrollY >= this.paginationOffsetTop}">
    <div class="theme-paggination-block">
      <div class="row">
        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
          <nav aria-label="Page navigation">
            <ul class="pagination d-block">
              <nuxt-link
                tag="li"
                :to="{query: {letter: letter}, params: {scroll: true}}"
                class="page-item"
                :class="{active: letterActive === letter }"
                v-for="(letter, index) in letters"
                :key="index"
                exact-active-class="active"
                exact
              >
                <a class="page-link" href="#" v-text="letter === '0' ? '0-9' : letter"></a>
              </nuxt-link>
            </ul>
          </nav>
        </div>
      </div>
    </div>
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
