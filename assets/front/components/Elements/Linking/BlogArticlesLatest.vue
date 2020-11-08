<template>
  <div class="blog-articles-latest marT20">
    <h4 class="orange capital marB10 marT30 capital">ostatnio na blogu</h4>
    <div class="article marB30" v-for="(article, index) in latestArticles">
      <p v-text="$moment(article.datetimeCreate).format('ll')"></p>
      <h5 class="marB5"><font-awesome-icon icon="newspaper" class="orange"/> @Promocje i Zniżki</h5>
      <p ></p>
      <span class="orange"><nuxt-link :to="{path: article.slug}" v-text="article.name">Czytaj...</nuxt-link></span>
    </div>
  </div>
</template>

<script>
export default {
  name: "BlogArticlesLatest",
  computed:{
    latestArticles()
    {
      return this.$store.getters.initFront.data.latestArticles;
    }
  },
}
</script>

<style scoped>

</style>
