<template>
  <div v-if="$store.getters.typePage === 'Shops-Shops'">
    <div class="deals bg padTB60">
      <div class="container">
        <div class="row" >
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <pagination-shops :letter-active="letterActive" :letters="Object.keys(letters)"/>
          </div>
        </div>
        <div class="row marT50">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <shops-listing v-if="letterActive" :shops="shops" :letter="letterActive"/>
            <loader-active v-else/>
          </div>
        </div>
      </div>
    </div>
    <!-- //***Deals-List End***// -->
    <div class="clear"></div>
  </div>
</template>

<script>
import ShopsListing from "@/views/Shops/Shops/ShopsListing";
import PaginationShops from "@/views/Shops/Shops/PaginationShops";
import LoaderActive from "@/components/Loader/LoaderActive";
import seo from "@/mixins/seo";
export default {
  name: 'Shops',
  components: {
    LoaderActive,
    PaginationShops,
    ShopsListing
  },
  mixins:[seo],
  data()
  {
    return {
      pagiationHiddenXs: false,
      fixedPagination: false,
      shopsByLetter: [],
      letters: {},
      letterActive: '0',
    }
  },
  watch:{
    $route(to, from)
    {
      this.letterActive = to.query.letter;

      if(!this.shopsByLetter[this.letters[this.letterActive]])
      {
        this.getShops({letter: this.letterActive});
      }

    }
  },
  computed:{
    shops()
    {
      if(this.letterActive)
        return this.shopsByLetter[this.letters[this.letterActive]] ?
          this.shopsByLetter[this.letters[this.letterActive]] :
          [];
      else
        return [];

    },
    model()
    {
      return this.$store.getters.model;
    },
  },
  methods:{
    setLetter(letter)
    {
      this.letterActive = letter;
    },
    getShops(obj = {})
    {
      this.letterActive = null;
      let dataRequest = {};
      if(obj.letter)
        dataRequest.letter = obj.letter;

      this.getPage('shops', dataRequest, false)
        .then(res => {
          this.shopsByLetter[this.letters[obj.letter]] = res.data.page.subpage.shops;
          this.seo = res.data.page.subpage.seo;
          this.letterActive = obj.letter;

        }).catch(e => {
        this.shopsByLetter[this.letters[obj.letter]] = [];
      })
    }
  },
  created()
  {
    this.letters[0] = 0;
    for(let i = 97; i < 123; ++i)
    {
      this.letters[String.fromCharCode(i)] = i-96;
    }
    if(this.$router.currentRoute.query.letter)
    {
      this.letterActive = this.$router.currentRoute.query.letter;
      this.shopsByLetter[this.letters[this.letterActive]] = this.model.subpage.shops;
    }
  },
  mounted()
  {
    if(!this.$router.currentRoute.query.letter)
      this.$router.push({query: {letter: '0'}})
  },
}
</script>

<style scoped>

</style>
