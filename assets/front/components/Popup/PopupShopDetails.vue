<template>
  <div @keyup.esc="closePopup" class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="mainModalLabel" v-text="title"></h5>
      <button type="button" class="btn btn-secondary" aria-label="Close" @click="closePopup">
        <i class="fa fa-close"></i>
      </button>
    </div>
    <div class="modal-body">
      <shop-detail/>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn" :class="buttonClass" @click="action" v-text="buttonClose"></button>
    </div>
  </div>
</template>

<script>

import ShopDetail from "@/views/Shops/Shop/ShopDetail";
export default {
  components: {ShopDetail},
  props: ['title', 'data', 'options'],
  name: "PopupShopDetails",
  methods: {
    closePopup() {
      this.$store.commit('setPopup', {title: '', options: null, template: null, data: {}});
    },
    action() {
      this.options.actionAfterClose();
      this.closePopup();
    }
  },
  computed: {
    buttonClose() {
      return 'Wyjdź';
    },
    buttonClass() {
      return 'btn-secondary';
    },
  }
}
</script>

<style scoped>

</style>

