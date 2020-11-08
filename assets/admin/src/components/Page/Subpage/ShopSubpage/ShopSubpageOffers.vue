<template>
<div>
  <div class="row">
    <div class="col-md-12">
      <button class="btn btn-primary" @click="hideOutOfDate = !hideOutOfDate">
        <span v-if="hideOutOfDate"><i class="mdi mdi-arrow-down"></i>Pokaż ukryte</span>
        <span v-else><<i class="mdi mdi-arrow-up"></i>Schowaj ukryte</span>
      </button>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <table class="table table-striped">
        <thead>
        <tr>
          <th scope="col">lp.</th>
          <th scope="col">Tytuł</th>
          <th scope="col">Data od<br>Data od</th>
          <th scope="col">Działania</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="(offer, index) in offers" v-if="checkActualOffer(offer)">
          <th scope="row">{{ index+1 }}</th>
          <td v-text="offer.title"></td>
          <td v-html="showDateText(offer.datetimeFrom, '---')+'<br>'+showDateText(offer.datetimeTo, '---')"></td>
          <td>
            <router-link class="btn btn-primary" :to="{name: 'panel-offers-offer', params: {id: offer.idOffer }}"><i class="mdi mdi-arrow-right"></i> </router-link>
          </td>
        </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
</template>

<script>
export default {
  name: "ShopSubpageOffers",
  data(){
    return {
      offers: [],
      hideOutOfDate: true
    }
  },
  computed:{
    subpage()
    {
      return this.$store.getters.resource.modelEntity.subpages[this.$store.getters.currentLocale];
    },
  },
  methods:{
    checkActualOffer(offer)
    {
      if(this.hideOutOfDate === false)
        return true;
      let dateNow = new Date();
      if (!offer.datetimeTo)
        return true;
      let dateTo = new Date(offer.datetimeTo);
      let dateFrom = new Date(offer.datetimeFrom);
      return dateNow > dateFrom && dateNow < dateTo;
    }
  },
  created(){
    this.ajax({
      url: '/admin/api/offers/subpage/' + this.subpage.idSubpage,
      responseCallbackSuccess: res => {
        this.offers = res.data.offers;
      }
    })
  }
}
</script>

<style scoped>

</style>
