export default {
  methods: {
    redirectInside(url) {
      window.open(url);
      // location.href = url;
    },
    redirectOutside(url) {
      window.open(location.href);
      location.href = url;
    },
    redirectShop(idShop) {
      window.open(this.$store.getters.redirectLinkShop(idShop));
    },
    redirectOffer(idOffer) {
      window.open(this.$store.getters.redirectLinkOffer(idOffer));
    },
    getPage(method, dataRequest = {}, withLoader = true) {
      if(withLoader)
        this.$store.commit('setLoader', true);
      dataRequest.locale = this.$store.getters.currentLocale;
      dataRequest.slug = this.$router.currentRoute.path.replace(/^\//g, '');
      dataRequest.method = method;
      return this.$axios.post('page/api/main', dataRequest, {}).finally(() => {
        if(withLoader)
            this.$store.commit('setLoader', false);
      })
    },
    checkPopupPromo()
    {
      let hashDecoded = this.$parseHash();
      if(hashDecoded && hashDecoded.offer !== undefined)
      {
        this.openPopupPromo(hashDecoded.offer, false);
      }
    },
    changeHash(newHash) {
      this.$router.push({hash: newHash, params: {scroll: false}});
    },
    getShopPageWithShopOfferHash(slug, idOffer) {
      return slug + this.$generateHash({shopOffer: idOffer});
    },
    openPopupPromo(idOffer, withRedirect = false, gtag = {}) {
      this.changeHash(this.$generateHash({offer: idOffer}));
      if (withRedirect) {
        gtag.value = idOffer;
        this.$gtagEv(gtag);
        setTimeout(() => {
          this.redirectOutside(this.$store.getters.redirectLinkOffer(idOffer));
        }, 200);
      }

      this.$store.commit('setPopup', {
        template: () => import("@/components/Popup/PopupPromotionOffer"),
        title: 'Przejdź do promocji',
        options: {
          blockedExit: true,
          actionAfterClose: (obj = {}) => {
            this.$router.push({hash: '', params: {scroll: false}});
          },
        },
        data: {
          idOffer
        }
      })
    },
  },
  mounted() {
    // this.$lazyHide();
  },
}
