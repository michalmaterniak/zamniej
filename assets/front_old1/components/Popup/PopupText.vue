<template>
  <div @keyup.esc="closePopup" class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="mainModalLabel" v-text="title"></h5>
      <button type="button" class="close" aria-label="Close" @click="closePopup">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12 box1 marB30">
          <div class="section-box">
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="boxbg"><h3><a href="#"><i class="flaticon-label"></i></a> Promocje</h3></div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="symbol"><h5>zobacz więcej<a href="deals-grid-sidebar.html"><i
                class="flaticon-external-link-symbol"></i></a></h5></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn" :class="buttonClass" @click="action" v-text="buttonClose"></button>
    </div>
  </div>
</template>

<script>

export default {
  props: ['title', 'data', 'options'],
  name: "PopupText",
  methods: {
    closePopup() {
      this.$store.commit('setPopup', {title: '', options: null, template: null, data: {}});
    }
  },
  computed: {
    buttonClose() {
      return (this.options.buttonClose === undefined) ? 'Anuluj' : this.options.buttonClose;
    },
    buttonClass() {
      return (this.options.buttonClass === undefined) ? 'btn-secondary' : this.options.buttonClass;
    },
  }
}
</script>

<style scoped>

</style>

