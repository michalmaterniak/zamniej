<template>
  <div class="theme-tab mt-5">
    <ul class="tabs tab-title">
      <li :class="{'current' : index === activeLink}" v-for="(link, index) in offers" :key="index">
        <a :href="link.name" v-text="link.label" @click.prevent="changeTab(index)"></a>
      </li>
    </ul>
    <div class="tab-content-cls row">
      <div v-for="(item, index) in offers" :id="item.name" :style="{'display' : activeLink === index ? 'block' : 'none'}" :key="index" class="tab-content" :class="{'active default' : index === 0}" >
          <div class="row product-tab">
            <div class="col-6 col-xs-4 col-sm-4 col-md-4 col-lg-3 col-xl-2 " v-for="(offer, index2) in item.offers" :key="index2" >
              <div class="tab-box product-box2">
                <link2 :offer="offer" v-if="inLinks(offer)"/>
                <no-link :offer="offer" v-else/>
              </div>
            </div>
          </div>
      </div>
    </div>
  </div>
</template>

<script>
import Link2 from "@/views/Homepages/Homepage/SpecialOffers/Link2";
import NoLink from "@/views/Homepages/Homepage/SpecialOffers/NoLink";
export default {
  name: 'SpecialOffers',
  components: {NoLink, Link2},
  props: ['promotions'],
  data() {
    return {
      activeLink: 0,
      usedLinks: [],
      availableOffersLinks: [],

      offers: [
        {
          label: 'Popularne promocje',
          name: 'popular',
          links: []
        },
        {
          label: 'Kupony rabatowe',
          name: 'discount',
          links: []
        }
      ]
    }
  },
  methods:{
    inLinks(offer) {
      if (this.availableOffersLinks.includes(offer.idOffer)) {
        return true;
      }

      if (this.usedLinks.includes(offer.slug)) {
        return false;
      } else {
        this.usedLinks.push(offer.slug);
        this.availableOffersLinks.push(offer.idOffer);
        return true;
      }
    },
    changeTab(index) {
      this.activeLink = index;
    }
  },
  created() {
    for(let offer in this.offers) {
      this.$set(this.offers[offer], 'offers', this.promotions[offer]);
    }
  }
}
</script>

<style scoped>
  .tab-content-cls > .tab-content {
    display: none;
  }

</style>
