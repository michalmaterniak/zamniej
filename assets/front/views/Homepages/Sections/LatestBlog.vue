<template>
  <div class="latest-blog bg blognav padTB60">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12 marB30">
          <div class="section-box text-left">
            <div class="boxbgg">
              <h3><i class="flaticon-blogger-logotype"></i> latest blog</h3>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12 marB30" v-for="(article, index) in articles" @click="$router.push({path: article.slug})">
          <div class="box-a">
            <figure>
              <img :src="article.logo.modifyPath" :alt="article.logo.original.data.alt">
            </figure>
            <div class="box-detail box-d">
              <h4 class="hover marB10"><nuxt-link :to="{path: article.slug}" v-text="article.name"></nuxt-link></h4>
              <ul class="marB10 fonts">
                <li><font-awesome-icon icon="calendar" aria-hidden="true"/> <span v-text="$showDateText(article.date)"></span></li>
              </ul>
              <div class="content-p" v-text="getShortTextArticle(index)"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "LatestBlog",
  props: ['articles'],
  methods:{
    getShortTextArticle(index)
    {
      return this.$cutText(this.articles[index].content.content, 200, '...')
    }
  },
  mounted() {
      if(this.articles.length > 0) {
        $('#sliderfourth').owlCarousel({
          loop: true,
          margin: 0,
          nav: false,
          responsive: {
            0: {
              items: 1
            },
            600: {
              items: 2
            },
            1000: {
              items: 3
            }
          }
        })
      }
    }
}
</script>

<style scoped>
ul.fonts > li {
  list-style: none;
}
</style>
