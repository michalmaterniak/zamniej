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
