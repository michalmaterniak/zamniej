<template>
  <div v-if="$store.getters.typePage === 'Pages-Blog-Articles'">
    <bread-crumbs/>
    <div class="latest-blog bg padTB60">
      <div class="container">
        <div class="row">
          <div class="col-md-9 col-sm-8 col-xs-12">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12 marB30" v-if="articles.length > 0"  v-for="(article, index) in articles">
                <div class="box-z" @click="goToArticle(article.slug)">
                  <div class="col-md-4 col-sm-5 col-xs-8">
                    <div class="row">
                      <figure>
                        <img class="pointer" :src="article.header.modifyPath" :alt="article.header.original.data.alt">
                      </figure>
                    </div>
                  </div>
                  <div class="col-md-8 col-sm-7 col-xs-12">
                    <div class="row">
                      <div class="box-detail blog">
                        <div class="col-md-12">
                          <div class="row">
                            <h4 class="hover marB5"><nuxt-link :to="{path: article.slug}" v-text="article.name"></nuxt-link></h4>
                            <ul class="marB5 fonts list-unstyled">
                              <li><a href="#">
                                <font-awesome-icon icon="calendar-alt" />
                                <span v-text="$moment(article.create).format('ll')"></span></a></li>
                            </ul>
                            <p class="pointer underline-hover" v-text="getShortTextArticle(index)"></p>
                            <span><nuxt-link tag="button" :to="{path: article.slug}" class="read-more btn btn-link hover">czytaj więcej</nuxt-link></span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="pagination-box text-center">

                  <!--                -->
                  <!--                <a v-if="page-1 > 0" href="#" @click.prevent="setPage(page-1)"><span><i class="fa fa-arrow-left" aria-hidden="true"></i></span></a>-->
                  <!--                <a href="#" @click.prevent="setPage(i)" v-for="i in pages" :key="i" :class="{'active-page' : page===i}"><span v-text="i"></span></a>-->
                  <!--                <a v-if="page+1 <= pages" href="#" @click.prevent="setPage(page+1)"><span><i class="fa fa-arrow-right" aria-hidden="true"></i></span></a>-->
                  <!--              -->

                  <nuxt-link v-if="page-1 > 0" :to="paginationLink(page-1)" @click.native="setPage(page-1)">
                  <span>
                    <font-awesome-icon icon="arrow-left" />
                  </span>
                  </nuxt-link>
                  <nuxt-link :to="paginationLink(i)" @click.native="setPage(i)" v-for="i in pages" :key="i" :class="{'active' : page===i}">
                  <span v-text="i">
                  </span>
                  </nuxt-link>
                  <nuxt-link v-if="page+1 <= pages" :to="paginationLink(page+1)" @click.native="setPage(page+1)">
                  <span>
                    <font-awesome-icon icon="arrow-right" />
                  </span>
                  </nuxt-link>



                </div>
              </div>


            </div>
          </div>
<!--          <div class="col-md-3 col-sm-4 col-xs-12">-->
<!--            <div class="row">-->
<!--              <div class="col-md-12 col-sm-12 col-xs-12">-->
<!--                <div class="search-bar">-->
<!--                  <div class="col-md-12 col-sm-12 col-xs-12">-->
<!--                    <div class="search_bar">-->
<!--                      <input type="text" name="search" placeholder="Wyszukaj...">-->
<!--                      <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>-->
<!--                    </div>-->
<!--                  </div>-->
<!--                </div>-->
<!--              </div>-->
<!--              <div class="col-md-12 col-sm-12 col-xs-12">-->
<!--                <div class="blog">-->
<!--                  <div id="blog" class="owl-carousel owlCarousel marT30">-->
<!--                    <div class="item">-->
<!--                      <div class="col-md-12 col-sm-12 col-xs-12">-->
<!--                        <div class="row">-->
<!--                          <figure>-->
<!--                            <img src="@/assets/img/blog/blog1.jpg" alt="">-->
<!--                          </figure>-->
<!--                        </div>-->
<!--                      </div>-->
<!--                    </div>-->
<!--                    <div class="item">-->
<!--                      <div class="col-md-12 col-sm-12 col-xs-12">-->
<!--                        <div class="row">-->
<!--                          <figure>-->
<!--                            <img src="@/assets/img/blog/blog-a.jpg" alt="">-->
<!--                          </figure>-->
<!--                        </div>-->
<!--                      </div>-->
<!--                    </div>-->
<!--                    <div class="item">-->
<!--                      <div class="col-md-12 col-sm-12 col-xs-12">-->
<!--                        <div class="row">-->
<!--                          <figure>-->
<!--                            <img src="@/assets/img/blog/blog-b.jpg" alt="">-->
<!--                          </figure>-->
<!--                        </div>-->
<!--                      </div>-->
<!--                    </div>-->
<!--                  </div>-->
<!--                </div>-->
<!--              </div>-->
<!--              &lt;!&ndash;            <div class="col-md-12 col-sm-12 col-xs-12">&ndash;&gt;-->
<!--              &lt;!&ndash;              <div class="latest-tweet marT20">&ndash;&gt;-->
<!--              &lt;!&ndash;                <h4 class="orange capital marB10">Latest tweets</h4>&ndash;&gt;-->
<!--              &lt;!&ndash;                <h5 class="marB5"><a href=""><i class="fa fa-twitter orange" aria-hidden="true"></i> @BestBuy.com</a></h5>&ndash;&gt;-->
<!--              &lt;!&ndash;                <p>Lorem ipsum dolor sit acons tuadip iscing elit Fusce</p>&ndash;&gt;-->
<!--              &lt;!&ndash;                <span class="orange"><a href="">www.itg.Com</a></span>&ndash;&gt;-->
<!--              &lt;!&ndash;                <p>4 hour ago</p>&ndash;&gt;-->
<!--              &lt;!&ndash;                <h4 class="orange capital marB10 marT30">Latest tweets</h4>&ndash;&gt;-->
<!--              &lt;!&ndash;                <h5 class="marB5"><a href=""><i class="fa fa-twitter orange" aria-hidden="true"></i> @BestBuy.com</a></h5>&ndash;&gt;-->
<!--              &lt;!&ndash;                <p>Lorem ipsum dolor sit acons tuadip iscing elit Fusce</p>&ndash;&gt;-->
<!--              &lt;!&ndash;                <span class="orange"><a href="">www.itg.Com</a></span>&ndash;&gt;-->
<!--              &lt;!&ndash;                <p>4 hour ago</p>&ndash;&gt;-->
<!--              &lt;!&ndash;              </div>&ndash;&gt;-->
<!--              &lt;!&ndash;            </div>&ndash;&gt;-->
<!--              <div class="col-md-12 col-sm-12 col-xs-12">-->
<!--                <div class="trending-offers marT20">-->
<!--                  <h4 class="orange capital marB10">Najlepsze promocje</h4>-->
<!--                  <div class="trending">-->
<!--                    <div class="col-md-4 col-sm-4 col-xs-12">-->
<!--                      <div class="row">-->
<!--                        <figure>-->
<!--                          <img src="@/assets/img/blog/blog2.jpg" alt="">-->
<!--                        </figure>-->
<!--                      </div>-->
<!--                    </div>-->
<!--                    <div class="col-md-8 col-sm-8 col-xs-12">-->
<!--                      <div class="row">-->
<!--                        <h5>Zniżka 25% </h5>-->
<!--                        <h5 class="orange"><span><a href="">Przejdź do sklepu</a></span></h5>-->
<!--                      </div>-->
<!--                    </div>-->
<!--                  </div>-->
<!--                  <div class="trending">-->
<!--                    <div class="col-md-4 col-sm-4 col-xs-12">-->
<!--                      <div class="row">-->
<!--                        <figure>-->
<!--                          <img src="@/assets/img/blog/blog3.jpg" alt="">-->
<!--                        </figure>-->
<!--                      </div>-->
<!--                    </div>-->
<!--                    <div class="col-md-8 col-sm-8 col-xs-12">-->
<!--                      <div class="row">-->
<!--                        <h5>Zniżka 25% </h5>-->
<!--                        <h5 class="orange"><span><a href="">Przejdź do sklepu</a></span></h5>-->
<!--                      </div>-->
<!--                    </div>-->
<!--                  </div>-->
<!--                  <div class="trending">-->
<!--                    <div class="col-md-4 col-sm-4 col-xs-12">-->
<!--                      <div class="row">-->
<!--                        <figure>-->
<!--                          <img src="@/assets/img/blog/blog4.jpg" alt="">-->
<!--                        </figure>-->
<!--                      </div>-->
<!--                    </div>-->
<!--                    <div class="col-md-8 col-sm-8 col-xs-12">-->
<!--                      <div class="row">-->
<!--                        <h5>Zniżka 25% </h5>-->
<!--                        <h5 class="orange"><span><a href="">Przejdź do sklepu</a></span></h5>-->
<!--                      </div>-->
<!--                    </div>-->
<!--                  </div>-->
<!--                  <div class="trending">-->
<!--                    <div class="col-md-4 col-sm-4 col-xs-12">-->
<!--                      <div class="row">-->
<!--                        <figure>-->
<!--                          <img src="@/assets/img/blog/blog5.jpg" alt="">-->
<!--                        </figure>-->
<!--                      </div>-->
<!--                    </div>-->
<!--                    <div class="col-md-8 col-sm-8 col-xs-12">-->
<!--                      <div class="row">-->
<!--                        <h5>Zniżka 25% </h5>-->
<!--                        <h5 class="orange"><span><a href="">Przejdź do sklepu</a></span></h5>-->
<!--                      </div>-->
<!--                    </div>-->
<!--                  </div>-->
<!--                </div>-->
<!--              </div>-->
<!--              <div class="col-md-12 col-sm-12 col-xs-12">-->
<!--                <div class="tags marT20">-->
<!--                  <h4 class="orange marB10 capital">Popularne tagi</h4>-->
<!--                  <ul>-->
<!--                    <li><a href="#">promocje</a></li>-->
<!--                    <li><a href="#">kupoy rabatowe</a></li>-->
<!--                    <li><a href="#">black friday</a></li>-->
<!--                    <li><a href="#">zniżka</a></li>-->
<!--                  </ul>-->
<!--                </div>-->
<!--              </div>-->
<!--            </div>-->
<!--          </div>-->

        </div>
      </div>
    </div>
  </div>
</template>

<script>

import BreadCrumbs from "@/components/BreadCrumbs/BreadCrumbs";
export default {
  name: "Articles",
  components: {BreadCrumbs},
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

<style>
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
