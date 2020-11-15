<template>
  <div>
    <div class="box-a marB30 pointer" :class="{'promo-no-loger-current' : !offer.offer.actual}" @click.prevent="$emit('shopPopupOffer', {idOffer: offer.offer.idOffer, redirect: true})">
      <div class="box-detail box-height">
        <h4 class="hover marB5 pointer header-promo-grid" v-text="offer.offer.title"></h4>
        <div class="wrapper-box-detail">
          <div v-html="$cutTextHidden(offer.offer.content.content, 100, '...')"></div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "PromotionGrid",
  props:['offer'],
  methods:{
    showDate(date)
    {
      if(date)
        return this.$moment(date).format('LL');
      else
        return 'odwolania';
    },
  },
}
</script>

<style scoped>

.box-height
{
  height: 200px;
  font-family: 'Raleway', sans-serif;
  font-size: 14px;
  line-height: 1.6em;
  color: inherit;
}
@media screen and (min-width: 768px) and (max-width: 991px)
{
  .box-height
  {
    height: 150px;
  }
}
.box-detail
{
  overflow: hidden;
}
@media screen and (min-width: 641px) and (max-width: 767px)
{
  .box-height
  {
    height: 100px;
  }
}

</style>
