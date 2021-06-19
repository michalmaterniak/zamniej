<template>
  <!-- section start -->
  <section v-if="$store.getters.typePage === 'Pages-Blog-Articles'" class="section-b-space blog-page ratio2_3">
    <div class="container">
      <div class="row">
        <div class="col-xl-9 col-lg-8 col-md-7">
          <div class="row blog-media" v-for="(article, index) in articles">
            <div class="col-xl-6">
              <div class="blog-left">
                <img @click="goToArticle(article.slug)" alt=""
                     class="img-fluid blur-up lazyload bg-img"
                     :src="article.header.modifyPath"
                     :alt="article.header.original.data.alt"
                     data-not-lazy
                >
              </div>
            </div>
            <div class="col-xl-6">
              <div class="blog-right">
                <div>
                  <h6>25 January 2018</h6>
                  <nuxt-link :to="{path: article.slug}">
                    <h4 v-text="article.name"></h4>
                  </nuxt-link>
                  <p v-html="getShortTextArticle(index)">Consequences that are extremely painful. Nor again is there anyone who loves or
                    pursues or desires to obtain pain of itself, because it is pain, but because
                    occasionally circumstances occur in which toil and pain can procure him some
                    great pleasure.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
<!--        <div class="col-xl-3 col-lg-4 col-md-5">-->
<!--          <div class="blog-sidebar">-->
<!--            <div class="theme-card">-->
<!--              <h4>Recent Blog</h4>-->
<!--              <ul class="recent-blog">-->
<!--                <li>-->
<!--                  <div class="media">-->
<!--                    <img alt="Generic placeholder image"-->
<!--                                          class="img-fluid blur-up lazyload"-->
<!--                                          src="/page2/images/blog/1.jpg">-->
<!--                    <div class="media-body align-self-center">-->
<!--                      <h6>25 Dec 2018</h6>-->
<!--                      <p>0 hits</p>-->
<!--                    </div>-->
<!--                  </div>-->
<!--                </li>-->
<!--                <li>-->
<!--                  <div class="media"><img alt="Generic placeholder image"-->
<!--                                          class="img-fluid blur-up lazyload"-->
<!--                                          src="/page2/images/blog/2.jpg">-->
<!--                    <div class="media-body align-self-center">-->
<!--                      <h6>25 Dec 2018</h6>-->
<!--                      <p>0 hits</p>-->
<!--                    </div>-->
<!--                  </div>-->
<!--                </li>-->
<!--                <li>-->
<!--                  <div class="media"><img alt="Generic placeholder image"-->
<!--                                          class="img-fluid blur-up lazyload"-->
<!--                                          src="/page2/images/blog/3.jpg">-->
<!--                    <div class="media-body align-self-center">-->
<!--                      <h6>25 Dec 2018</h6>-->
<!--                      <p>0 hits</p>-->
<!--                    </div>-->
<!--                  </div>-->
<!--                </li>-->
<!--                <li>-->
<!--                  <div class="media"><img alt="Generic placeholder image"-->
<!--                                          class="img-fluid blur-up lazyload"-->
<!--                                          src="/page2/images/blog/4.jpg">-->
<!--                    <div class="media-body align-self-center">-->
<!--                      <h6>25 Dec 2018</h6>-->
<!--                      <p>0 hits</p>-->
<!--                    </div>-->
<!--                  </div>-->
<!--                </li>-->
<!--                <li>-->
<!--                  <div class="media"><img alt="Generic placeholder image"-->
<!--                                          class="img-fluid blur-up lazyload"-->
<!--                                          src="/page2/images/blog/5.jpg">-->
<!--                    <div class="media-body align-self-center">-->
<!--                      <h6>25 Dec 2018</h6>-->
<!--                      <p>0 hits</p>-->
<!--                    </div>-->
<!--                  </div>-->
<!--                </li>-->
<!--              </ul>-->
<!--            </div>-->
<!--            <div class="theme-card">-->
<!--              <h4>Popular Blog</h4>-->
<!--              <ul class="popular-blog">-->
<!--                <li>-->
<!--                  <div class="media">-->
<!--                    <div class="blog-date"><span>03 </span><span>may</span></div>-->
<!--                    <div class="media-body align-self-center">-->
<!--                      <h6>Injected humour the like</h6>-->
<!--                      <p>0 hits</p>-->
<!--                    </div>-->
<!--                  </div>-->
<!--                  <p>it look like readable English. Many desktop publishing text.</p>-->
<!--                </li>-->
<!--                <li>-->
<!--                  <div class="media">-->
<!--                    <div class="blog-date"><span>03 </span><span>may</span></div>-->
<!--                    <div class="media-body align-self-center">-->
<!--                      <h6>Injected humour the like</h6>-->
<!--                      <p>0 hits</p>-->
<!--                    </div>-->
<!--                  </div>-->
<!--                  <p>it look like readable English. Many desktop publishing text.</p>-->
<!--                </li>-->
<!--                <li>-->
<!--                  <div class="media">-->
<!--                    <div class="blog-date"><span>03 </span><span>may</span></div>-->
<!--                    <div class="media-body align-self-center">-->
<!--                      <h6>Injected humour the like</h6>-->
<!--                      <p>0 hits</p>-->
<!--                    </div>-->
<!--                  </div>-->
<!--                  <p>it look like readable English. Many desktop publishing text.</p>-->
<!--                </li>-->
<!--                <li>-->
<!--                  <div class="media">-->
<!--                    <div class="blog-date"><span>03 </span><span>may</span></div>-->
<!--                    <div class="media-body align-self-center">-->
<!--                      <h6>Injected humour the like</h6>-->
<!--                      <p>0 hits</p>-->
<!--                    </div>-->
<!--                  </div>-->
<!--                  <p>it look like readable English. Many desktop publishing text.</p>-->
<!--                </li>-->
<!--              </ul>-->
<!--            </div>-->
<!--          </div>-->
<!--        </div>-->
      </div>
    </div>
  </section>
  <!-- Section ends -->
</template>


<script>
export default {
  name: 'Articles',
  data()
  {
    return {
      page: 1,
      articles: [],
      pagesArticles: {}
    }
  },
  methods:{
    paginationLink(page)
    {
      if(page === 1)
        return {params: {scrollSlowly: true}};
      else
        return {query: {'page': page}, params: {scrollSlowly: true}}
    },
    goToArticle(slug)
    {
      this.$router.push({path: slug});
    },
    setArticles()
    {
      if(this.pagesArticles[this.page] !== undefined)
      {
        this.articles = this.pagesArticles[this.page];
      }
      else
      {
        this.getPage('index', {page: this.page})
          .then(res => {

            this.articles = res.data.model.subpage.articles.articles;
            this.setArticlesToPage();

          }).catch(e => {
          this.articles = [];
        })
      }
    },
    setArticlesToPage()
    {
      this.pagesArticles[this.page] = this.articles;
    },
    setPage(i)
    {
      if(i > 0 && i <= this.pages)
      {
        this.page = i;
        this.setArticles();
      }
    },
    getShortTextArticle(index)
    {
      return this.$cutText(this.articles[index].content.content, 200, '...')
    }
  },
  computed:{
    countMax()
    {
      return this.model.subpage.articles.count;
    },
    countPerPage()
    {
      return this.model.subpage.articles.perPage;
    },
    pages()
    {
      return Math.ceil(this.countMax / this.countPerPage);
    },

    model()
    {
      return this.$store.getters.model;
    }
  },
  created() {
    if(Number(this.$router.currentRoute.query.page) === 1)
      this.$router.push({path: this.$router.currentRoute.path});
    this.page = this.$router.currentRoute.query.page ? Number(this.$router.currentRoute.query.page) : 1 ;

    this.articles = this.model.subpage.articles.articles;
    this.setArticlesToPage();
  }
}
</script>


<style scoped>
.media {
  display: flex;
  align-items: flex-start;
}

.media-body {
  flex: 1;
}
.active-page{
  font-weight: bold;
}
.read-more{
  text-decoration: none;
  cursor: pointer;
  color: inherit;
  text-transform: capitalize;
}
.read-more:hover{
  color: #f57f25;
}
</style>
