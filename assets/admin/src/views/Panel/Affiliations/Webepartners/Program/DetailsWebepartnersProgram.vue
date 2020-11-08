<template>
  <div>
    <div class="row">
      <div class="col-md-12">
        <ul class="nav nav-tabs" role="tablist">
          <li class="nav-item"> <a class="nav-link " href="#" :class="{active : subtab === 'basic'}" data-toggle="tab" role="tab" @click="changeTab('basic')"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Podstawowe</span></a> </li>
          <template v-if="program.enable">
          <li class="nav-item"> <a class="nav-link" href="#" :class="{active : subtab === 'banners'}" data-toggle="tab" role="tab" @click="changeTab('banners')"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Bannery</span></a> </li>
          <li class="nav-item"> <a class="nav-link" href="#" :class="{active : subtab === 'products'}" data-toggle="tab" role="tab" @click="changeTab('products')"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Produkty</span></a> </li>
          <li class="nav-item"> <a class="nav-link" href="#" :class="{active : subtab === 'vouchers'}" data-toggle="tab" role="tab" @click="changeTab('vouchers')"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Kody rabatowe</span></a> </li>
          <li class="nav-item"> <a class="nav-link" href="#" :class="{active : subtab === 'promotions'}" data-toggle="tab" role="tab" @click="changeTab('promotions')"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Promocje</span></a> </li>
          </template>
        </ul>
      </div>
    </div>
    <div class="row mt-5">
      <div class="col-md-12">
        <keep-alive>
          <component :is="tab" :program="program"/>
        </keep-alive>
      </div>
    </div>
  </div>
</template>
<script>



import BasicWebepartners from "./Tabs/BasicWebepartners";
import BannersWebepartners from "./Tabs/BannersWebepartners";
import ProductsWebepartners from "./Tabs/ProductsWebepartners";
import VouchersWebepartners from "./Tabs/VouchersWebepartners";
import PromotionsWebepartners from "./Tabs/PromotionsWebepartners";

export default {
  components: {ProductsWebepartners, VouchersWebepartners, BannersWebepartners, BasicWebepartners},
  props:{
    program:{
      type: Object
    }
  },
  name: "DetailsWebepartnersProgram",
  data(){
    return {
      subtab: 'basic'
    }
  },
  computed:{
    tab()
    {
      switch (this.subtab)
      {
        case 'basic' : return BasicWebepartners;
        case 'banners' : return BannersWebepartners;
        case 'products' : return ProductsWebepartners;
        case 'vouchers' : return VouchersWebepartners;
        case 'promotions' : return PromotionsWebepartners;

        default : return BasicWebepartners;
      }
    }
  },
  methods:{

    changeTab(subtab)
    {
      this.subtab = subtab;
    }
  }
}
</script>

<style scoped>

</style>
