<template>
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="mainModalLabel" v-text="title"></h5>
      <button type="button" class="close" aria-label="Close" @click="closePopup">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">

      <div class="row">
        <label class="col-md-1">Afiliacja</label>
        <div class="col-md-11">
          <div class="custom-control custom-radio" v-for="(shopAffiliation, index) in data.shops" :key="index">
            <input type="radio" class="custom-control-input" :id="shopAffiliation.affiliation.name" name="radio-stacked" :value="shopAffiliation.idShop" v-model="shopAffiliationOffer">
            <label class="custom-control-label"  :for="shopAffiliation.affiliation.name" v-text="shopAffiliation.affiliation.name + ' - ' + shopAffiliation.name"></label>
          </div>
        </div>
      </div>

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
          <ckeditor v-model="contentOffer" :config="configCkeditor"/>
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
          <datetime placeholder="Bez końca" class="border-black" v-model="datetimeToOffer" id="datetimeTo"></datetime><button class="btn btn-success" @click="datetimeToOffer = null">
          <i class="mdi mdi-delete-empty"></i></button>
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <button class="btn btn-success" :disabled="!isValidate" @click="addOffer"><i class="mdi mdi-plus"></i> Dodaj</button>
    </div>
  </div>
</template>

<script>
import WysiwygComponent from "../../FormFieldsComponents/TextComponent/WysiwygComponent";
export default {
  components: {WysiwygComponent},
  props: ['title', 'data'],
  name: "PopupOffersNewWebepartners",
  data() {
    return {
      url: '',
      trackingUrlOffer: null,
      titleOffer: '',
      shopAffiliationOffer: null,
      datetimeFromOffer: '',
      datetimeToOffer: '',
      datetimeToOfferNull: '',

      codeOffer: '',
      contentOffer: '',

      configCkeditor:{
        width: '100%',
        toolbar: [
          ['Bold','Italic','Underline','StrikeThrough','-','Undo','Redo','-','Cut','Copy','Paste','Find','Replace','-','Outdent','Indent','-','Print'],
          ['NumberedList','BulletedList','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
          ['Image','Table','-','Link','Flash','Smiley','TextColor','BGColor','Source']
        ],
        language: 'pl',
        filebrowserBrowseUrl: '/admin/elfinder',
        uiColor : '#b7c6ee'
      }
    }
  },
  computed:{
    affiliationOffer() {
      return this.data.affiliation.idAffiliation
    },
    subpage() {
      return this.data.subpage;
    },
    isValidate() {
      return (!!this.trackingUrlOffer
        && !!this.titleOffer
        && !!this.datetimeFromOffer
        && !!this.contentOffer);
    }
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
    },
    addOffer() {
      if(this.isValidate) {
        this.ajax({
          url: '/admin/api/affiliations/webepartners/vouchers/createCustomOffer',
          data: {
            offer: {
              datetimeTo: this.datetimeToOffer,
              datetimeFrom: this.datetimeFromOffer,
              content: this.contentOffer,
              code: this.codeOffer,
              title: this.titleOffer,
              subpage: this.data.subpage,
              shopAffiliation: this.shopAffiliationOffer,
              url: this.trackingUrlOffer
            }
          },
          responseCallbackSuccess: res => {
            if(res.data.success === true) {
              this.closePopup();
            }
          }
        })
      }
    }
  },
  created() {
    if (this.data.shops[0] !== undefined) {
      this.shopAffiliationOffer = this.data.shops[0].idShop;
    }
  }
}
</script>

<style scoped>
.border-black{
  border-color: #424242;
}
</style>
