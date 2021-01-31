  <template>
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="mainModalLabel" v-text="title"></h5>
      <button type="button" class="close" aria-label="Close" @click="closePopup">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body popup-shop-details">
      <div class="col-md-12 col-sm-12 col-xs-12" >
        <shop-details :shop="shop"/>
      </div>
    </div>
    <div class="modal-footer">
      <button class="itg-btn cart-btn" @click="closePopup">Zamknij</button>
    </div>
  </div>
</template>

<script>

import RatingShop from "@/components/Elements/Rating/RatingShop";
import ShopDetails from "@/views/Shops/Shop/ShopDetails";

export default {
  components: {ShopDetails, RatingShop},
  props: ['title', 'data', 'options'],
  name: "PopupShopDetails",
  methods: {
    force(ev)
    {
      if(ev.type === 'click')
        this.openWindow(this.shop.subpage.urlTracking);
    },
    closePopup() {
      this.data.afterClose();
      this.$store.commit('setPopup', {title: '', options: null, template: null, data: {}});
    }
  },
  computed:{
    shop()
    {
      return this.data.shop;
    }
  }
}
</script>

<style scoped>
.cart-btn:hover
{
  background-color: #fff;
  color: #000;
  border: #f57f25 solid;
}
</style>

