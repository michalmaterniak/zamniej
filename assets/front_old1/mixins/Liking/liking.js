export default {
  methods:{
    offerShopLiking(payload)
    {
      let index = _.findIndex(this.$store.getters.model.subpage.offersPromo, offer => {
        return this.offer.offer.idOffer === offer.offer.idOffer;
      })

      this.$store.commit('changeValueModel', {
        path: 'subpage.offersPromo['+index+'].offer.liking',
        value: payload.liking
      });
    },
    offerLiking(payload)
    {
      this.offer.offer.liking = payload.liking;
    }
  }
}
