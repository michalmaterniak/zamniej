<template>
  <div class="row partition-collection">
    <div class="col-lg-3 col-md-6" v-for="(article, index) in articles">
      <nuxt-link :to="article.slug">
      <div class="row text-center">
        <div class="col-md-12">
            <img alt="" class="img-fluid" :src="article.logo.modifyPath"><br>
            <span v-text="article.name" class="btn"></span>
        </div>
      </div>
  </nuxt-link>
    </div>
  </div>
</template>

<script>
import VueSlickCarousel from 'vue-slick-carousel'

export default {
  name: 'BlogPosts',
  props: ['articles'],
  components: {VueSlickCarousel},
  data() {
    return {
      config:
        {
          infinite: true,
          speed: 300,
          slidesToShow: 3,
          slidesToScroll: 1,
          autoplay: true,
          autoplaySpeed: 5000,
          responsive: [{
              breakpoint: 1200,
              settings: {
                  slidesToShow: 2,
                  slidesToScroll: 2
              }
          },
              {
                  breakpoint: 767,
                  settings: {
                      slidesToShow: 1,
                      slidesToScroll: 1
                  }
              }
          ]
      }
    }
  },
  methods:{
    getShortTextArticle(index)
    {
      return this.$cutText(this.articles[index].content.content, 200, '...')
    }
  }
}
</script>

<style scoped>
.col-md-12 {
  width: 100%;
}
</style>
