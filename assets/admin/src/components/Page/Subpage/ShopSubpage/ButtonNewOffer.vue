<template>
<div>
  <button-dropdown :actions="affiliations">
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
      affiliations: [
        {
          name: 'Webepartners',
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
          affiliation: this.getAffiliation('webepartners')
        }
      });
    },
    getAffiliation(name) {
      return this.systemAffiliations[_.findIndex(this.systemAffiliations, affiliation => {
        return affiliation.name === name;
      })]
    }
  },
  created() {
    this.ajax({
      url: '/admin/api/affiliations/affiliations-listing',
      responseCallbackSuccess: res => {
        this.systemAffiliations = res.data.affiliations;
      }
    })
  }
}
</script>

<style scoped>

</style>
