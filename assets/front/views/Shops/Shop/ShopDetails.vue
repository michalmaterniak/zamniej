<template>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
      <div class="blog-a">
        <img :src="shop.subpage.logo.modifyPath" :alt="shop.subpage.logo.original.data.alt">
        <p>Ocena <span v-text="shop.subpage.subpage.name"></span> <span
          v-text="shop.rating.rating"></span></p>
        <rating-shop :shop="shop"/>
      </div>
    </div>

    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="latest-tweet marT20" v-if="shop.subpage.subpage.content.extra.details">
        <div class="row">
          <div class="col-md-12">
            <h4 class="orange capital marT10" v-text="'Sklep ' + shop.subpage.subpage.name"></h4>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <p v-text="shop.subpage.subpage.content.data.details.address.street"></p>
            <p v-text="shop.subpage.subpage.content.data.details.address.location"></p>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <contact-details :contact="shop.subpage.subpage.content.data.details.contact"/>
          </div>
        </div>
        <div class="row marT30">
          <div class="col-md-12">
              <span class="orange">
                <button class="btn btn-orange"
                        v-text="shop.subpage.subpage.content.data.details.contact.www" @click.prevent="redirectInsideShop"></button>
              </span>
          </div>
        </div>
      </div>
    </div>
<!--    <div class="col-md-12 col-sm-12 col-xs-12">-->
<!--      <div class="trending-offers marT20">-->
<!--        <h4 class="orange capital marB10">Produkty <span v-text="shop.subpage.subpage.name"></span></h4>-->

<!--        <div class="col-md-12 col-sm-12  col-xs-12">-->
<!--          <div class="search-bar">-->
<!--            <div class="col-md-12 col-sm-12 col-xs-12">-->
<!--              <div class="search_bar">-->
<!--                <input type="text" name="search" placeholder="Search..">-->
<!--                <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>-->
<!--              </div>-->
<!--            </div>-->
<!--          </div>-->
<!--        </div>-->
<!--        <div class="trending">-->
<!--          <div class="col-md-4 col-sm-4 col-xs-12">-->
<!--            <div class="row">-->
<!--              <figure>-->
<!--                <img src="@/assets/img/blog/blog2.jpg" alt="">-->
<!--              </figure>-->
<!--            </div>-->
<!--          </div>-->
<!--          <div class="col-md-8 col-sm-8 col-xs-12">-->
<!--            <div class="row">-->
<!--              <h5>Produkt</h5>-->
<!--              <h5 class="orange"><span><a href="">Przejdź do promocji</a></span></h5>-->
<!--            </div>-->
<!--          </div>-->
<!--        </div>-->
<!--        <div class="trending">-->
<!--          <div class="col-md-4 col-sm-4 col-xs-12">-->
<!--            <div class="row">-->
<!--              <figure>-->
<!--                <img src="@/assets/img/blog/blog3.jpg" alt="">-->
<!--              </figure>-->
<!--            </div>-->
<!--          </div>-->
<!--          <div class="col-md-8 col-sm-8 col-xs-12">-->
<!--            <div class="row">-->
<!--              <h5>Produkt</h5>-->
<!--              <h5 class="orange"><span><a href="">Przejdź do promocji</a></span></h5>-->
<!--            </div>-->
<!--          </div>-->
<!--        </div>-->
<!--        <div class="trending">-->
<!--          <div class="col-md-4 col-sm-4 col-xs-12">-->
<!--            <div class="row">-->
<!--              <figure>-->
<!--                <img src="@/assets/img/blog/blog4.jpg" alt="">-->
<!--              </figure>-->
<!--            </div>-->
<!--          </div>-->
<!--          <div class="col-md-8 col-sm-8 col-xs-12">-->
<!--            <div class="row">-->
<!--              <h5>Produkt</h5>-->
<!--              <h5 class="orange"><span><a href="">Przejdź do promocji</a></span></h5>-->
<!--            </div>-->
<!--          </div>-->
<!--        </div>-->
<!--        <div class="trending">-->
<!--          <div class="col-md-4 col-sm-4 col-xs-12">-->
<!--            <div class="row">-->
<!--              <figure>-->
<!--                <img src="@/assets/img/blog/blog5.jpg" alt="">-->
<!--              </figure>-->
<!--            </div>-->
<!--          </div>-->
<!--          <div class="col-md-8 col-sm-8 col-xs-12">-->
<!--            <div class="row">-->
<!--              <h5>Produkt</h5>-->
<!--              <h5 class="orange"><span><a href="">Przejdź do promocji</a></span></h5>-->
<!--            </div>-->
<!--          </div>-->
<!--        </div>-->
<!--      </div>-->
<!--    </div>-->


<!--    <div class="col-md-12 col-sm-12 col-xs-12">-->
<!--      <div class="trending-offers marT20">-->
<!--        <h4 class="orange capital marB10">Inne promocje</h4>-->
<!--        <div class="trending">-->
<!--          <div class="col-md-4 col-sm-4 col-xs-12">-->
<!--            <div class="row">-->
<!--              <figure>-->
<!--                <img src="@/assets/img/blog/blog2.jpg" alt="">-->
<!--              </figure>-->
<!--            </div>-->
<!--          </div>-->
<!--          <div class="col-md-8 col-sm-8 col-xs-12">-->
<!--            <div class="row">-->
<!--              <h5>Zniżka 25% </h5>-->
<!--              <h5 class="orange"><span><a href="">Przejdź do sklepu</a></span></h5>-->
<!--            </div>-->
<!--          </div>-->
<!--        </div>-->
<!--        <div class="trending">-->
<!--          <div class="col-md-4 col-sm-4 col-xs-12">-->
<!--            <div class="row">-->
<!--              <figure>-->
<!--                <img src="@/assets/img/blog/blog3.jpg" alt="">-->
<!--              </figure>-->
<!--            </div>-->
<!--          </div>-->
<!--          <div class="col-md-8 col-sm-8 col-xs-12">-->
<!--            <div class="row">-->
<!--              <h5>Zniżka 25% </h5>-->
<!--              <h5 class="orange"><span><a href="">Przejdź do sklepu</a></span></h5>-->
<!--            </div>-->
<!--          </div>-->
<!--        </div>-->
<!--        <div class="trending">-->
<!--          <div class="col-md-4 col-sm-4 col-xs-12">-->
<!--            <div class="row">-->
<!--              <figure>-->
<!--                <img src="@/assets/img/blog/blog4.jpg" alt="">-->
<!--              </figure>-->
<!--            </div>-->
<!--          </div>-->
<!--          <div class="col-md-8 col-sm-8 col-xs-12">-->
<!--            <div class="row">-->
<!--              <h5>Zniżka 25% </h5>-->
<!--              <h5 class="orange"><span><a href="">Przejdź do sklepu</a></span></h5>-->
<!--            </div>-->
<!--          </div>-->
<!--        </div>-->
<!--        <div class="trending">-->
<!--          <div class="col-md-4 col-sm-4 col-xs-12">-->
<!--            <div class="row">-->
<!--              <figure>-->
<!--                <img src="@/assets/img/blog/blog5.jpg" alt="">-->
<!--              </figure>-->
<!--            </div>-->
<!--          </div>-->
<!--          <div class="col-md-8 col-sm-8 col-xs-12">-->
<!--            <div class="row">-->
<!--              <h5>Zniżka 25% </h5>-->
<!--              <h5 class="orange"><span><a href="">Przejdź do sklepu</a></span></h5>-->
<!--            </div>-->
<!--          </div>-->
<!--        </div>-->
<!--      </div>-->
<!--    </div>-->

    <div class="col-md-12 col-sm-12 col-xs-12">
      <blog-articles-latest/>
    </div>

    <div class="col-md-12 col-sm-12 col-xs-12">
      <popular-shops-tag/>
    </div>
  </div>
</template>

<script>
import ContactDetails from "@/views/Shops/Shop/ContactDetails";
import RatingShop from "@/components/Elements/Rating/RatingShop";
import BlogArticlesLatest from "@/components/Elements/Linking/BlogArticlesLatest";
import PopularShopsTag from "~/components/Elements/Linking/PopularShopsTag";

export default {
  name: "ShopDetails",
  components: {PopularShopsTag, BlogArticlesLatest, RatingShop, ContactDetails},
  props:['shop'],
  methods:{
    redirectInsideShop() {
      this.$gtagEv({
        action: 'redirect',
        category: 'shop',
        label: 'shop-link-details',
        value: this.shop.subpage.subpage.idSubpage
      });
      this.redirectInside(this.$store.getters.redirectLinkShop(this.shop.subpage.idShopAffil));
    },
  }
}
</script>

<style scoped>

.btn-orange:hover {
  color: #fff;
  background-color: #f57f25;
  border-color: #eee
}

.btn-orange {
  color: #000;
  background-color: #fff;
  border-color: #f57f25
}

</style>
