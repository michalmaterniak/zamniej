<template>
  <div v-if="$store.getters.typePage === 'Shops-Shop'">
    <!-- section start -->
    <section>
      <div class="collection-wrapper">
        <div class="container">
          <div class="row data-sticky_parent">
            <div class="col-lg-12 col-sm-12 col-xs-12">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-lg-8">
                    <div v-if="offersActual.length > 0" class="row">
                      <div class="col-12 product_img_scroll image-scroll" data-sticky_column>
                        <div>
                          <div class="row blog-media" @click="redirectPromo(offer.idOffer)" v-for="({offer}, index) in offersActual"  style="cursor:pointer;" >
                            <div class="col-4 col-sm-3 col-md-3 col-lg-3 pt-5">
                              <div class="blog-left" >
                                <img :alt="offer.title"
                                     class=""
                                     :src="model.subpage.logo.modifyPath"
                                >

                              </div>
                            </div>
                            <div class="col-8 col-sm-9 col-md-9 col-lg-9">
                              <div class="box-content">

                                <div class="row">
                                  <div class="col-12">
                                    <h4 v-text="offer.title" class="h2-link"></h4>
                                    <liking :offer="offer" />
                                    <div class="mt-4" v-html="$stripTags(offer.content.content)" style="bottom: 0"></div>
                                  </div>
                                  <div class="col-6 offset-6">
                                    <button class="btn btn-red " v-if="offer.data && offer.data.code">
                                      Pokaż kod rabatowy
                                    </button>
                                    <button class="btn btn-red " v-else>
                                      Przejdź do promocji
                                    </button>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div v-else class="row"></div>
                    <div class="row mt-5">
                      <!-- product-tab starts -->
                      <div class="tab-product col-sm-12 col-lg-12">
                        <ul id="top-tab" class="nav nav-tabs nav-material" role="tablist">
                          <li v-if="availableTabs(1)" class="nav-item">
                            <button @click="showTab = 1" class="nav-link" :class="{'active show': showTab === 1}" id="top-1-tab" data-bs-toggle="tab" data-bs-target="#top-1" type="button" role="tab" aria-controls="top-1" aria-selected="true">
                              <i class="icofont icofont-ui-home"></i><strong>{{ shop.subpage.subpage.name }}</strong>
                            </button>
                            <div class="material-border"></div>
                          </li>
                          <li v-if="availableTabs(2)" class="nav-item">
                            <button @click="showTab = 2" :class="{'active show': showTab === 2}" class="nav-link" id="top-2-tab" data-bs-toggle="tab" data-bs-target="#top-2" type="button" role="tab" aria-controls="top-2" aria-selected="true">
                              <i class="icofont icofont-contacts"></i> <strong>Opinie</strong>
                            </button>
                            <div class="material-border"></div>
                          </li>
                          <li v-if="availableTabs(3)" class="nav-item">
                            <button @click="showTab = 3" :class="{'active show': showTab === 3}" class="nav-link" id="top-3-tab" data-bs-toggle="tab" data-bs-target="#top-3" type="button" role="tab" aria-controls="top-3" aria-selected="true">
                              <i class="icofont icofont-contacts"></i> <strong>Nieaktualne promocje</strong>
                            </button>
                            <div class="material-border"></div>
                          </li>
                        </ul>
                        <div id="top-tabContent" class="tab-content nav-material">
                          <div v-if="availableTabs(1)" id="top-1" aria-labelledby="top-1-tab" class="tab-pane fade" :class="{'active show': showTab === 1}" role="tabpanel">
                            <div class="row mt-5">
                              <div class="col-md-12 col-lg-12">
                                <div class="main-content" v-html="shop.subpage.content.content"></div>
                              </div>
                            </div>
                          </div>
                          <div v-if="availableTabs(2)" id="top-2" aria-labelledby="top-2-tab" class="tab-pane fade" :class="{'active show': showTab === 2}" role="tabpanel">
                            <div class="row section-b-space blog-detail-page">
                              <div class="col-sm-12 col-lg-8  col-xl-6">
                                <ul class="comment-section">
                                  <li v-for="(opinion, index) in shop.subpage.opinions" v-if="opinion.comment">
                                    <div class="media">
                                      <div class="media-body row">
                                        <div class="col-12 col-sm-12 col-md-8">
                                          <h6> {{ opinion.name }} <span>( {{ $showDatetimeText(opinion.datetimeCreate) }} )</span></h6>
                                        </div>
                                        <div class="col-6">
                                          <rating :rating="{rating: opinion.rating}"/>
                                        </div>
                                        <div class="col-12">
                                          <p v-text="opinion.comment"></p>
                                        </div>
                                      </div>
                                    </div>
                                  </li>
                                </ul>
                              </div>
                            </div>
                            <comment-adding/>
                          </div>
                          <div v-if="availableTabs(3)" id="top-3" aria-labelledby="top-3-tab" class="tab-pane fade" :class="{'active show': showTab === 3}" role="tabpanel">
                            <div v-if="offersNotActual.length > 0" class="col-lg-12">
                              <div class="row">
                                <div class="col-12 product_img_scroll image-scroll" data-sticky_column>
                                  <div>
                                    <div class="row blog-media" v-for="({offer}, index) in offersNotActual"  style="cursor:pointer;" >
                                      <div class="col-4 col-sm-3 col-md-3 col-lg-3 pt-5">
                                        <div class="blog-left" >
                                          <img :alt="offer.title"
                                               class=""
                                               :src="model.subpage.logo.modifyPath"
                                          >
                                        </div>
                                      </div>
                                      <div class="col-8 col-sm-9 col-md-9 col-lg-9">
                                        <div class="box-content">
                                          <div class="row">
                                            <div class="col-12">
                                              <h4 v-text="offer.title" class="h2-link"></h4>
                                              <ul class="post-social reset">
                                                <li><i class="fa fa-thumbs-up" style="color: green"></i> {{offer.liking.countPositive}}</li>
                                                <li><i class="fa fa-thumbs-down" style="color: red"></i> {{offer.liking.countNegative}}</li>
                                              </ul>
                                              <div class="mt-4" v-html="$stripTags(offer.content.content)" style="bottom: 0"></div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- product-tab ends -->
                    </div>
                  </div>
                  <div class="rtl-text col-lg-4" >
                    <div class="product-right pro_sticky_info" data-sticky_column>
                      <div class="row align-items-center">
                        <div class="col-8">
                          <h2 class="h3" v-text="shop.subpage.subpage.name"></h2>
                        </div>
                        <div class="col-4">
                          <img :alt="shop.subpage.seo.header"
                               :src="shop.subpage.logo.modifyPath"
                          >
                        </div>
                      </div>
                      <div class="media">
                        <label>Ocena {{ shop.subpage.subpage.name }} <strong>{{ shop.rating.rating }}</strong>/{{ shop.rating.count }}</label>
                        <rating-shop />
                      </div>
                      <div class="product-description border-product">

                      </div>
                      <div class="product-buttons">
                        <main-button @click.prevent.stop.native="redirectShop"/>
                      </div>
                      <div class="border-product" v-if="shop.subpage.subpage.content.extra.details">
                        <p v-text="model.subpage.subpage.content.data.description"></p>

                        <div class="mt-3">
                          <h4><strong>Adres</strong></h4>
                          <p v-text="shop.subpage.subpage.content.data.details.address.street"></p>
                          <p v-text="shop.subpage.subpage.content.data.details.address.location"></p>
                        </div>
                        <contact-details :contact="shop.subpage.subpage.content.data.details.contact"/>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Section ends -->

  </div>
</template>

<script>
import sticky from "@/mixins/Shops/Shop/sticky";
import ContactDetails from "@/views/Shops/Shop/ContactDetails";
import CommentAdding from "@/views/Shops/Shop/CommentAdding";
import RatingShop from "@/views/Shops/Shop/RatingShop";
import Liking from "@/components/Liking/Liking";
import MainButton from "@/views/Shops/Shop/MainButton";
import Rating from "@/views/Shops/Shop/RatingShop";

export default {
  name: 'Shop',
  components: {Rating, MainButton, Liking, RatingShop, CommentAdding, ContactDetails},
  mixins:[sticky],
  data() {
    return {
      shopDetailsHeight: null,
      contactShow: false,
      isPopupDetailShop: false,

      showTab: 1,
      isHoverStyle: false
    }
  },
  computed:{
    isContent() {
      return  Boolean(this.model.subpage.content.content);
    },

    offersActual()
    {
      let dateNow = new Date();
      return _.filter(this.offers, offer => {
        if (!offer.offer.datetimeTo)
          return true;
        if (offer.offer.datetimeTo) {
          let dateTo = new Date(offer.offer.datetimeTo);
          let dateFrom = new Date(offer.offer.datetimeFrom);
          return dateNow > dateFrom && dateNow < dateTo;
        } else {
          return true;
        }
      });
    },
    offersNotActual() {
      let dateNow = new Date();
      return _.filter(this.offers, offer => {
        if (offer.offer.datetimeTo) {
          let dateTo = new Date(offer.offer.datetimeTo);
          let dateFrom = new Date(offer.offer.datetimeFrom);
          return (dateNow < dateFrom) || (dateNow > dateTo);
        } else {
          return false;
        }

      });
    },
    offers() {
      return this.model.subpage.offersPromo;
    },
    model() {
      return this.$store.getters.model;
    },
    shop() {
      return this.model;
    }
  },
  methods:{
    redirectShop() {
      this.$gtagEv({
        action: 'redirect',
        category: 'shop',
        label: 'offer-' + String(this.model.subpage.idShopAffil),
      });
      this.redirectInside(this.$store.getters.redirectLinkShop(this.model.subpage.idShopAffil));
    },
    redirectPromo(idOffer) {
      this.openPopupPromo(idOffer, true, {
        action: 'redirect',
        category: 'shop',
        label: 'offer-' + String(idOffer)
      })
    },

    availableTabs(tab) {
      if (tab === 1) {
        return Boolean(this.shop.subpage.content.content);
      }

      return true;
    },
    showDate(date)
    {
      if(date)
        return this.$moment(date).format('LL');
      else
        return 'odwolania';
    }
  },
  created() {
    if (!this.availableTabs(1)) {
      this.showTab++;
    }
  }
}
</script>

<style scoped>
.box-content {
  color: #777777;
}
.box-content > h2 {
  color: #777777;
}
.box-content > p {
  text-align: justify;
  text-justify: inter-word;
}
.blog-media:hover {
  border: 1px solid rgba(0,0,0, 0.3);
}


.blog-detail-page .comment-section {
  border-bottom: 1px solid #dddddd;
}
ul.comment-section li {
  display: block;
}
.blog-detail-page .comment-section li {
  padding-top: 10px;
  padding-bottom: 10px;
  border-top: 1px solid #dddddd;
}
.media-rating {
  padding-bottom: 20px;
}
.btn-red {
  color: var(--theme-deafult);
}

.hover-btn {
  background-position: 100%;
  color: #000000;
  background-color: #ffffff;
}
.post-social:not(.reset) {
  font-size: 20px;
}
.post-social:not(.reset) > li {
  margin-right: 15px;
}

</style>
