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
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div v-html="data.lead"></div>
        </div>
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div v-html="data.content"></div>
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-success" v-text="'Zamknij'" @click="closePopup"></button>
    </div>
  </div>
</template>

<script>

export default {
  props: ['title', 'data', 'options'],
  name: "PopupTextHomepage",
  methods: {
    closePopup() {
      this.$store.commit('setPopup', {title: '', options: null, template: null, data: {}});
    }
  }
}
</script>

<style scoped>

</style>

