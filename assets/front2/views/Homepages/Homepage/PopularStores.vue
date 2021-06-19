<template>
  <div class="theme-card">
    <stores :stores="stores1"/>
    <stores :stores="stores2"/>
  </div>
</template>
<script>

import Stores from "@/views/Homepages/Homepage/PopularStores/Stores";
export default {
  name: 'PopularStores',
  props: ['stores'],
  components: {Stores},
  computed:{
    stores1() {
      return this.stores.filter((el, index) => {
        return index % 2;
      })
    },
    stores2() {
      return this.stores.filter((el, index) => {
        return !(index % 2);
      })
    }
  },
  methods:{
    redirect() {
      this.openPopupPromo(this.offer.idOffer, true, {
        action: 'redirect',
        category: 'offer',
        label: 'vouchers'
      })
    }
  },
  mounted() {
  }
}
</script>

<style scoped>
img.popular-store-img {
  width: 224px;
  height: 122px;
}
/*a.title1 h6 {*/
/*  color: var(--theme-deafult);*/
/*}*/
</style>
