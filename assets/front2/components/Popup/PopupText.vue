<template>
  <div @keyup.esc="closePopup" class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="mainModalLabel" v-text="title"></h5>
      <button type="button" class="close" aria-label="Close" @click="closePopup">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">

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

