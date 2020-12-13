<template>
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="mainModalLabel" v-text="title"></h5>
      <button type="button" class="close" aria-label="Close" @click="closePopup">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">

      <div class="row mt-5">
        <div class="col-md-1">
          Url
        </div>
        <div class="col-md-11">
          <input type="text" class="form-control border-black" placeholder="Url" v-model="url" @input="convertUrlWebepartners">
          Url afiliacyjny: <span v-if="trackingUrlOffer" v-text="trackingUrlOffer.substr(0, 50) + '...'"></span>
        </div>
      </div>

      <div class="row mt-5">
        <div class="col-md-1">
          Tytuł
        </div>
        <div class="col-md-11">
          <input type="text" class="form-control border-black" v-model="titleOffer">
        </div>
      </div>

      <div class="row mt-5">
        <div class="col-md-1">
          Treść
        </div>
        <div class="col-md-11">
          <input type="text" class="form-control border-black" v-model="contentOffer">
        </div>
      </div>

      <div class="row mt-5">
        <div class="col-md-1">Kod rabatowy</div>
        <div class="col-md-11">
          <input type="text" class="form-control border-black" v-model="codeOffer">
        </div>
      </div>

      <div class="row mt-5">
        <label for="datetimeFrom" class="col-md-1">Data od</label>
        <div class="col-md-11">
          <datetime class="border-black" v-model="datetimeFromOffer" id="datetimeFrom"></datetime>
        </div>
      </div>
      <div class="row mt-5">
        <label for="datetimeTo" class="col-md-1">Data do</label>
        <div class="col-md-11">
          <datetime class="border-black" v-model="datetimeToOffer" id="datetimeTo"></datetime>
        </div>
      </div>

    </div>
    <div class="modal-footer">

    </div>
  </div>
</template>

<script>
export default {
  props: ['title', 'data'],
  name: "PopupOffersNewWebepartners",
  data() {
    return {
      url: '',
      trackingUrlOffer: null,
      titleOffer: '',
      datetimeFromOffer: '',
      datetimeToOffer: '',
      codeOffer: '',
      contentOffer: ''
    }
  },
  computed:{
    affiliationOffer() {
      return this.data.affiliation.idAffiliation
    },
    subpage() {
      return this.data.subpage;
    },
  },
  methods: {
    convertUrlWebepartners() {
      this.ajax({
        url: '/admin/api/affiliations/webepartners/programs-convertUrl',
        data: {
          url: this.url
        },
        responseCallbackSuccess: res => {
          if(res.data.success === true) {
            this.trackingUrlOffer = res.data['tracking-url-webeparnets'];
          }
        }
      })
    }
  },
}
</script>

<style scoped>
.border-black{
  border-color: #424242;
}
</style>
