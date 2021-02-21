<template>
  <div class="modal-content" @keyup.esc="closePopup">
    <div class="modal-header">
      <h5 id="mainModalLabel" class="modal-title" v-text="title"></h5>
      <button aria-label="Close" class="close" type="button" @click="closePopup">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <div class="row">
        <form action="" method="post">
          <div class="col-md-12 col-sm-12 col-xs-12 box1 marB30">
            <input id="fname" v-model="shopName" autofocus class="form-control" placeholder="Wpisz nazwę sklepu..."
                   type="text">
          </div>
        </form>
      </div>
      <div class="popular-stores bg padTB60">
        <div class="row">
          <div v-for="(shop, index) in shops" :key="index" class="col-md-2 col-sm-3 col-xs-6 marB30">
            <tile-shop-search :shop="shop" @toPath="redirect"/>
          </div>
        </div>
      </div>
    </div>
    <div class="modal-footer">
    </div>
  </div>
</template>

<script>

export default {
  props: ['title', 'data', 'options'],
  name: "PopupSearch",
  data() {
    return {
      shopName: '',
      shops: []
    }
  },
  watch: {
    shopName(to, from) {
      if (to.length >= 3) {
        this.searchShops();
      } else {
        this.shops = [];
      }
    }
  },
  computed: {
    buttonClose() {
      return (this.options.buttonClose === undefined) ? 'Anuluj' : this.options.buttonClose;
    },
    buttonClass() {
      return (this.options.buttonClass === undefined) ? 'btn-secondary' : this.options.buttonClass;
    },
  },
  methods: {
    redirect(payload) {
      this.closePopup();
      this.$router.push({path: payload})
    },
    searchShops() {
      this.$axios({
        method: "POST",
        url: 'page/api/shops/search',
        responseType: 'json',
        data: {
          shop: this.shopName
        },
      }).then(res => {
        if (res.data.count > 0) {
          this.shops = res.data.shops;
        }
      })
    },
    closePopup() {
      this.$store.commit('setPopup', {title: '', options: null, template: null, data: {}});
    }
  },
  mounted() {
    document.getElementById('fname').autofocus;
  }
}
</script>

<style scoped>

</style>

