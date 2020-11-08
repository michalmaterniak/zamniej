<template>
<div>
  <table class="table table-striped">
    <thead>
    <tr>
      <th scope="col" style="width: 5%">Lp.</th>
      <th scope="col" style="width: 30%">Nazwa</th>
      <th scope="col" style="width: 10%">Data od<br>Data do</th>
      <th scope="col" style="width: 10%">Zdjęcie</th>
      <th scope="col" style="width: 10%"><span>cena stara</span> /<br> <span><strong>cena nowa</strong></span> /<br> <span>zniżka</span></th>
      <th scope="col" style="width: 5%">%</th>
      <th scope="col" style="width: 10%">Oferta</th>
    </tr>
    </thead>
    <tbody>
    <tr v-for="(offer, index) in offers" :key="index">
      <th scope="row" v-text="index+1"></th>
      <td v-text="offer.title"></td>
      <td>
        <div v-text="showDateText(offer.datetimeFrom)"></div>
        <div v-text="showDateText(offer.datetimeTo, '---')"></div>
      </td>
      <td >
        <template v-if="offer.urlImage" >
          <img @click="openPopupImageUrl(offer.urlImage)" :src="loadImageUrl(offer.urlImage, offer).src" class="mini-thumb">
        </template>
      </td>
      <td><span v-text="roundPrecision(offer.currentPrice+offer.cutPrice, 2)"></span> / <strong v-text="offer.currentPrice"></strong> / <span v-text="offer.cutPrice"></span></td>
      <td><span v-text="offer.percentDeal"></span></td>
      <td>
        <button @click="createOffer(offer)" class="btn" :class="{'btn-success' : offer.offer, 'btn-danger' : !offer.offer}">oferta</button>

      </td>

    </tr>
    </tbody>
  </table>
  <pagination :pagination="pagination" @changePage="changePage"/>
</div>
</template>

<script>
import Pagination from "../../../../../../components/Pagination/Pagination";
import offers from "../../../../../../mixins/Programs/offers";
export default {
  name: "ProductsWebepartners",
  components: {Pagination},
  props:{
    program:{
      type:Object,
    }
  },
  mixins:[offers],
  methods:{
    createOffer(offer)
    {
      if(!offer.offer)
      {
        this.ajax({
          url: '/admin/api/affiliations/webepartners/products/createOffer',
          data:{
            products: [offer.idOffer]
          },
          responseCallbackSuccess: res => {
            this.showAlert(res.data.message, 'success');
            offer.offer = res.data.products[offer.idOffer];
          }
        })
      }
    },
    roundPrecision(number, precision)
    {
      let power = Math.pow(10, precision);

      return Math.round(number * power) / power;
    },
    percentDeal(offer)
    {
      //offer.currentPrice+offer.cutPrice   - 100
      //offer.cutPrice                  - x
      return this.roundPrecision((100 * offer.cutPrice) / (offer.currentPrice+offer.cutPrice), 2);
    },
    setOffers()
    {
      this.ajax({
        url: '/admin/api/affiliations/webepartners/products/' + this.program.idShop + this.fragmentUrl,
        // data:{
        //   orderBy: 'priceCut'
        // },
        responseCallbackSuccess: res => {
          this.pagination.countAll = res.data.count;
          this.offers = res.data.products;
        }
      })
    }
  },
  created() {
    this.setOffers();
  }
}
</script>

<style scoped>
.mini-thumb
{
  width: 20%;
  height: auto;
}
</style>
