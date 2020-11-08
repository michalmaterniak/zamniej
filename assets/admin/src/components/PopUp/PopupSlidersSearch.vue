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
        <div class="col-md-12">
          <table class="table">
            <thead>
            <tr>
              <th scope="col" style="width: 5%">Lp.</th>
              <th scope="col" style="width: 50%">Nazwa</th>
              <th scope="col" style="width: 30%">Działania</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(slider, index) in sliders" @click="selectSlider(slider.idSlider)" class="pointerCursor" :class="{'table-primary' : slider.idSlider === selectedSlider}">
              <th scope="row" v-text="index+1"></th>
              <td v-text="slider.name"></td>
              <td>
                <router-link  class="btn btn-info" :to="{name: 'panel-sliders-slider', params:{id: slider.idSlider}}" @click.native="closePopup"><i class="mdi mdi-arrow-right"></i>Zobacz więcej</router-link>
              </td>
            </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">

          <div class="form-group row">
            <label for="header" class="col-sm-3 text-right control-label col-form-label">Nagłowek</label>
            <div class="col-sm-9">
              <input type="text" id="header" name="header" class="form-control" v-model="offerCustom.header">
              <label>Ustaw puste</label>
              <input type="checkbox" :checked="offerCustom.header === null" @click="setNull('header')">

            </div>
          </div>
          <div class="form-group row">
            <label for="content" class="col-sm-3 text-right control-label col-form-label">Treść</label>
            <div class="col-sm-9">
              <textarea id="content" name="content" class="form-control" v-model="offerCustom.content"></textarea>
              <label>Ustaw puste</label>
              <input type="checkbox" :checked="offerCustom.content === null" @click="setNull('content')">

            </div>
          </div>
          <div class="form-group row">
            <label for="datetimeFrom" class="col-sm-3 text-right control-label col-form-label">Data od</label>
            <div class="col-sm-9">
              <datetime v-model="offerCustom.datetimeFrom" id="datetimeFrom"></datetime>
            </div>
          </div>
          <div class="form-group row">
            <label for="datetimeTo" class="col-sm-3 text-right control-label col-form-label">Data do</label>
            <div class="col-sm-9">
              <datetime v-model="offerCustom.datetimeTo" id="datetimeTo"></datetime>
              <label>Ustaw puste</label>
              <input type="checkbox" :checked="offerCustom.datetimeTo === null" @click="setNull('datetimeTo')">

            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="modal-footer">
<!--      <button type="button" class="btn btn-danger" @click="editOffer">Edytuj oferte</button>-->
      <button type="button" class="btn btn-success" @click="action" :disabled="!selectedSlider">Zapisz</button>
      <button type="button" class="btn btn-dark" :class="buttonClass" @click="closePopup">Zakończ</button>
    </div>
  </div>
</template>

<script>
import sliders from "../../mixins/Sliders/sliders";

export default {
  props: ['title', 'data'],
  name: "PopupSlidersSearch",
  mixins:[sliders],
  data(){
    return {
      selectedSlider: null,
      offerCustom: {
        content: null,
        header: null,
        datetimeFrom: null,
        datetimeTo: null
      },
    }
  },
  computed: {
    buttonClose() {
      return (this.data.buttonClose === undefined) ? 'Anuluj' : this.data.buttonClose;
    },
    buttonClass() {
      return (this.data.buttonClass === undefined) ? 'btn-secondary' : this.data.buttonClass;
    },
  },
  methods: {
    setNull(field)
    {
      this.offerCustom[field] = null;
    },
    selectSlider(idSlider)
    {
      this.selectedSlider = idSlider;
    },
    action() {
      if (this.selectedSlider)
      {

        this.ajax({
          url: '/admin/api/sliders/sliders/add-offer-to-slider/' + this.data.offer.idOffer + '/' + this.selectedSlider,
          data: {
            offer: this.offerCustom
          },
          responseCallbackSuccess: res => {
            this.showAlert('Poprawnie dodano oferto do wybranego slidera', 'success');
          }
        })

        this.closePopup();
      }
    }
  },

  mounted() {
    this.offerCustom.datetimeTo = this.data.offer.datetimeTo;
    this.offerCustom.datetimeFrom = this.data.offer.datetimeFrom;
    this.offerCustom.content = this.data.offer.content.content;
    this.offerCustom.header = this.data.offer.title;
  }
}
</script>

<style scoped>

</style>

