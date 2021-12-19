<template>
  <div>
    <div class="row">
      <div class="col-md-12">
        <table class="table table-striped">
          <thead>
          <tr>
            <th scope="col">lp.</th>
            <th scope="col">Tytuł</th>
            <th scope="col">Program</th>
            <th scope="col">Data od<br>Data od</th>
            <th scope="col">Działania</th>
          </tr>
          </thead>
          <tbody>
          <tr v-for="(offer, index) in offers">
            <th scope="row">{{ index+1 }}</th>
            <td v-text="offer.title"></td>
            <td v-text="offer.shopAffiliation.name"></td>
            <td v-html="showDateText(offer.datetimeFrom, '---')+'<br>'+showDateText(offer.datetimeTo, '---')"></td>
            <td>
              <span>
                <button class="btn btn-dark" @click="priority(offer.idOffer, -1)"><i class="mdi mdi-minus"></i></button>
                <span class="btn btn-link " v-text="offer.priority"></span>
                <button class="btn btn-dark" @click="priority(offer.idOffer, 1)"><i class="mdi mdi-plus"></i></button>
              </span>
              <router-link class="btn btn-primary" :to="{name: 'panel-offers-offer', params: {id: offer.idOffer, after: $router.currentRoute.name}}"><i class="mdi mdi-arrow-right"></i> </router-link>
            </td>
          </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
import ButtonDropdown from "../../../components/Buttons/ButtonDropdown";
import ButtonNewOffer from "../../../components/Page/Subpage/ShopSubpage/ButtonNewOffer";

export default {
  name: "Listing",
  components: {ButtonNewOffer, ButtonDropdown},
  data(){
    return {
      offers: []
    }
  },
  computed:{
  },
  methods:{
    priority(idOffer, value = 1) {
      this.ajax({
        url: '/admin/api/offers/priority/'+idOffer+'/'+value,
        responseCallbackSuccess: res => {
          let index = _.findIndex(this.offers, offer => {
            return offer.idOffer === idOffer
          })
          this.offers[index].priority = res.data.offer.priority;
        }
      })
    }
  },
  created(){
    this.ajax({
      url: '/admin/api/offers/not-accepted',
      responseCallbackSuccess: res => {
        this.offers = res.data.offers;
      }
    })
  }
}
</script>

<style scoped>

</style>
