<template>
  <div>
    <ul class="post-social">
      <li @click.stop="offerLiking(true)"><i class="fa fa-thumbs-up" style="color: green"></i> {{offer.liking.countPositive}}</li>
      <li @click.stop="offerLiking(false)"><i class="fa fa-thumbs-down" style="color: red"></i> {{offer.liking.countNegative}}</li>
    </ul>
    <transition name="fade">
      <div class="green" v-if="isLiked && showResponseInfo" v-text="responseLiking"></div>
    </transition>
    <div>Skorzystało: <span v-text="offer.redirectCount"></span></div>
  </div>
</template>

<script>
import liking from "@/mixins/Liking/liking";

export default {
  name: 'Liking',
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
        url: 'page/api/shops/offers/liking/' + this.offer.idOffer,
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
        this.offerShopLiking(
          {
            liking: res.data.liking
          }
        );
      })
    },
  }
}
</script>

<style scoped>
  /*ul.post-social > li > i {*/
  /*  font-size: 20px;*/
  /*}*/
  ul.post-social > li {
    font-size: 20px;
    margin-right: 10px;
  }
  .fade-enter-active, .fade-leave-active {
    transition: opacity 2s;
  }
  .fade-enter, .fade-leave-to
  {
    opacity: 0;
  }
</style>
