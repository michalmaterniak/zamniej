<template>
  <div>
    <table class="table table-striped">
      <thead>
      <tr>
        <th scope="col" style="width: 5%">Lp.</th>
        <th scope="col" style="width: 30%">Nazwa</th>
        <th scope="col" style="width: 10%">Data od<br>Data do</th>
        <th scope="col" style="width: 10%">Kod rabatowy</th>
        <th scope="col" style="width: 10%">Zdjęcie</th>
        <th scope="col" style="width: 5%">Szerokość</th>
        <th scope="col" style="width: 5%">Wysokość</th>
        <th scope="col" style="width: 5%">Oferta</th>
        <th scope="col" style="width: 10%">Działania</th>
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
        <td>
          <span v-text="offer.code"></span>
        </td>
        <td >
          <template v-if="offer.urlImage" >
            <img @click="openPopupImageUrl(offer.urlImage)" :src="loadImageUrl(offer.urlImage, offer).src" class="mini-thumb">
          </template>
        </td>
        <td><span v-if="offer.width" v-text="offer.width"></span></td>
        <td><span v-if="offer.height" v-text="offer.height"></span></td>
        <td><button @click="createOffer(offer)" class="btn" :class="{'btn-success' : offer.offer, 'btn-danger' : !offer.offer}">oferta</button></td>

        <td>
          <button v-if="offer.photo" class="btn btn-info" @click="addToSlider(offer)">
            <i class="mdi mdi-plus"></i>Dodaj do slidera
          </button>
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
  name: "VouchersWebepartners",
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
          url: '/admin/api/affiliations/webepartners/vouchers/createOffer',
          data:{
            vouchers: [offer.idOffer]
          },
          responseCallbackSuccess: res => {
            this.showAlert(res.data.message, 'success');
            offer.offer = true
          }
        })
      }
    },
    setOffers()
    {
      this.ajax({
        url: '/admin/api/affiliations/webepartners/vouchers/' + this.program.idShop + this.fragmentUrl,
        responseCallbackSuccess: res => {
          this.countAll = res.data.count;
          this.offers = res.data.vouchers;
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
