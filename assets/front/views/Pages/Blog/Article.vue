<template>
  <!--section start-->
  <section v-if="$store.getters.typePage === 'Pages-Blog-Article'" class="blog-detail-page section-b-space ratio2_3">
    <div class="container">
      <div class="row">
        <div class="col-sm-12 blog-detail"><img class="img-fluid blur-up lazyload"
                                                :src="model.subpage.header.modifyPath"
                                                :alt="model.subpage.header.original.data.alt"
                                                >
          <h3 v-text="model.subpage.subpage.name"></h3>
          <ul class="post-social">
            <li>25 January 2018</li>
          </ul>
        </div>
        <div class="col-md-12 col-lg-9">
          <div class="main-content main-content-blog" v-html="model.subpage.subpage.content.content"></div>
        </div>
      </div>

    </div>
  </section>
  <!--Section ends-->
</template>

<script>
export default {
  name: 'Article',
  computed:{
    model()
    {
      return this.$store.getters.model;
    }
  },
}
</script>

<style scoped>

</style>
