<template>
  <div class="box-detail text-left">
    <div>Jak oceniasz tę promocję?</div>
    <div class="liking marT10">
      <span title="Oferta podobała się" class="green pointer marR10" @click="offerLiking(true)"><font-awesome-icon :icon="'thumbs-up'"/> <span v-text="offer.offer.liking.countPositive"></span></span>
      <span title="Oferta nie podobała się" class="red pointer marL10"  @click="offerLiking(false)"><font-awesome-icon :icon="'thumbs-down'"/> <span v-text="offer.offer.liking.countNegative"></span></span>
      <transition name="fade">
        <div class="green" v-if="isLiked && showResponseInfo" v-text="responseLiking"></div>
      </transition>
      <div>Skorzystało: <span v-text="offer.offer.redirectCount"></span></div>
    </div>
  </div>
</template>

<script>
import liking from "@/mixins/Liking/liking";

export default {
  name: "LikingOffer",
  props: {
    offer: {
      type: Object,
    },
    showing: {
      type: Boolean,
      default: false
    },
  },
  mixins:[liking],
  data()
  {
    return {
      isLiked: false,
      responseLiking: '',
      showResponseInfo: false
    }
  },
  methods:{
    offerLiking(like = true)
    {
      if(this.isLiked)
      {
        this.responseLiking = 'Opinia została już przesłana';
        this.showResponseInfo = true;
        return ;
      }
      if( this.showing === true )
        return ;

      this.$axios({
        method: "POST",
        url: 'page/api/shops/offers/liking/' + this.offer.offer.idOffer,
        responseType: 'json',
        data: {
          liking: like
        },
      }).then(res => {
        this.responseLiking = res.data.message;
        this.isLiked = true;
        this.showResponseInfo = true;
        setTimeout(() => {
          this.showResponseInfo = false
        }, 3000);
        this.$emit('setNewLiking', {
          liking: res.data.liking
        });
      })
    },
  }
}
</script>

<style scoped>
div.liking > span{
  font-size: 20px;
}
.green{
  color: green;
}
.red{
  color: red;
}
.fade-enter-active, .fade-leave-active {
  transition: opacity 2s;
}
.fade-enter, .fade-leave-to
{
  opacity: 0;
}
</style>
