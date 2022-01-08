<template>
<div>
  <button-dropdown :actions="affiliations" :shops-affiliations="shopsAffiliations">
    <i class="mdi mdi-arrow-right"></i>Dodaj nową ofertę
  </button-dropdown>
</div>
</template>

<script>
import ButtonDropdown from "../../../Buttons/ButtonDropdown";
import PopupOffersNewWebepartners from "../../../PopUp/Offers/PopupOffersNewWebepartners";
import PopupOffersNewConvertiser from "../../../PopUp/Offers/PopupOffersNewConvertiser";
import PopupOffersNewTradetracker from "../../../PopUp/Offers/PopupOffersNewTradetracker";
export default {
  name: "ButtonNewOffer",
  props:['idSubpage'],
  components: {ButtonDropdown},
  data() {
    return {
      systemAffiliations: [],
      shopsAffiliations: [],
      affiliations: [
        {
          name: 'webepartners',
          action: this.newWebepartnersOffer
        },
        {
          name: 'convertiser',
          action: this.newConvertiserOffer
        },
        {
          name: 'tradetracker',
          action: this.newTradetrackerOffer
        }
      ]
    }
  },
  methods:{
    newWebepartnersOffer() {
      this.openPopup('Tworzenie nowej oferty Webepartners', {
        template: PopupOffersNewWebepartners,
        classDialog: 'maxWidth75',
        data: {
          subpage: this.idSubpage,
          shops: this.getShopAffiliation('webepartners')
        }
      });
    },
    newConvertiserOffer() {
      this.openPopup('Tworzenie nowej oferty Convertiser', {
        template: PopupOffersNewConvertiser,
        classDialog: 'maxWidth75',
        data: {
          subpage: this.idSubpage,
          shops: this.getShopAffiliation('convertiser')
        }
      });
    },
    newTradetrackerOffer() {
      this.openPopup('Tworzenie nowej oferty Tradetracker', {
        template: PopupOffersNewTradetracker,
        classDialog: 'maxWidth75',
        data: {
          subpage: this.idSubpage,
          shops: this.getShopAffiliation('tradetracker')
        }
      });
    },
    getShopAffiliation(name) {
      return _.filter(this.shopsAffiliations, item => {
        return item.affiliation.name === name;
      })
    }
  },
  created() {
    this.ajax({
      url: '/admin/api/affiliations/shopaffiliations-subpage/' + this.idSubpage,
      responseCallbackSuccess: res => {
        this.shopsAffiliations = res.data.affiliations;
      }
    })
  }
}
</script>

<style scoped>

</style>
