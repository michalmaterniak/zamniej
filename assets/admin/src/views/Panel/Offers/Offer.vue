<template>
  <div v-if="offer">
    <div class="row">
      <div class="col-md-12 text-right">
        <button class="btn btn-danger" @click="removeOffer">Usuń</button>
<!--        <button class="btn " :class="{'btn-success': offer.accepted, 'btn-danger': !offer.accepted}" @click="accept">Akceptuj</button>-->
        <button class="btn btn-success" @click="saveOffer">Zapisz</button>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 form-group">
        <div class="row">
          <div class="col-md-12">
            <label>Tytuł</label>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <input type="text" style="width: 700px" v-model="offer.title" />
          </div>
        </div>
      </div>
      <div class="col-md-12 form-group">
        <div class="row">
          <div class="col-md-12">
            <label>Treść</label>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <wysiwyg v-model="offer.content.content"/>
          </div>
        </div>
      </div>
      <div class="col-md-12 form-group">
        <div class="row">
          <div class="col-md-12">
            <label>Zdjęcie</label>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <template v-if="offer.photo" >
              <img @click="openPopupImage(offer.photo)" :src="loadImage(offer.photo, offer.photo).src" class="mini-thumb">
              <button class="btn btn-link" @click="removePhotoOffer(offer)"><i class="mdi mdi-delete"></i></button>
            </template>
            <button v-else class="btn btn-info" @click="loadPhoto(offer)">Dodaj zdjęcie</button>
          </div>
        </div>
      </div>
      <div class="col-md-12 form-group">
        <div class="row">
          <div class="col-md-12">
            <label>Data od</label>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <datetime v-model="offer.datetimeFrom" />
          </div>
        </div>
      </div>
      <div class="col-md-12 form-group">
        <div class="row">
          <div class="col-md-12">
            <label>Data do</label>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <datetime v-model="offer.datetimeTo" />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import offer from "../../../mixins/Programs/offer";
import Wysiwyg from "../../../components/Wysiwyg/Wysiwyg";

export default {
  name: "Offer",
  components: {Wysiwyg},
  props: {
    id: {
      default: 0
    },
    after: {
      default: false
    }
  },
  mixins:[offer],
  data()
  {
    return {
      offer: null
    }
  },
  watch:{
    $route(to, from)
    {
      this.setOffer();
    }
  },
  methods:{
    accept() {
      this.offer.accepted = !this.offer.accepted;
    },
    removeOffer() {
      this.ajax({
        url: '/admin/api/offers/remove/' + this.id,
        responseCallbackSuccess: res => {
          this.showAlert(res.data.message, 'success');
          this.$router.back();
        },
        responseCallbackError: res => {
          this.showAlert('Błąd podczas usuwania!', 'danger');
        }
      })
    },
    saveOffer() {
      this.ajax({
        url: '/admin/api/offers/store/' + this.id,
        data:{
          offer: this.offer
        },
        responseCallbackSuccess: res => {
          // this.offer = res.data.offer;
          this.showAlert('Zapisano!', 'success');
          // console.log(this.$router.history);
          if (this.after !== false) {
            this.$router.push({name: this.after});
          }
        },
        responseCallbackError: res => {
          this.showAlert('Błąd zapisu!', 'danger');
        }
      })
    },
    setOffer()
    {
      this.ajax({
        url: '/admin/api/offers/offer/' + this.id,
        responseCallbackSuccess: res => {
          this.offer = res.data.offer;
          this.offer.accepted = true;
        },
        responseCallbackError: res => {
          this.$router.push({name: 'panel-offers-listing-not-accepted'});
        }
      })
    }
  },
  created() {
    this.setOffer();
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
