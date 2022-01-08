<template>
  <div>
    <div class="row mb-5">
      <div class="col-md-12">
        <ul class="nav nav-tabs" role="tablist">
          <li v-for="(affiliation, index) in affiliations" :key="index" class="nav-item">
            <a :class="{active : selectAffiliation === index}" class="nav-link " data-toggle="tab" href="#" role="tab"
               @click="selectAffiliation = index">
              <span class="hidden-sm-up"></span>
              <span class="hidden-xs-down" v-text="affiliation.affiliation.name"></span>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div v-for="(affiliation, index) in affiliations" v-if="selectAffiliation === index">
      <div class="row mb-2">
        <div class="col-md-2">
          CPS / CPC:
        </div>
        <div class="col-md-2">
          {{ affiliation.cps }}% / {{ affiliation.cpc }}%
        </div>
      </div>
      <div class="row mb-2">
        <div class="col-md-2">
          Ilość przejść:
        </div>
        <div class="col-md-2">
          {{ affiliation.redirectCount }}
        </div>
      </div>
      <div class="row mb-2">
        <div class="col-md-2">
          Link (wymuszenie):
        </div>
        <div class="col-md-4">
          <input v-model="affiliation.linkForce" class="form-control" type="text">
        </div>
      </div>
      <div class="row mb-5">
        <div class="col-md-2">
          Dostępność:
        </div>
        <div class="col-md-4">
          <button :class="{'btn-success' : affiliation.enable, 'btn-danger' : !affiliation.enable}" class="btn"
                  @click="affiliation.enable = !affiliation.enable"><i class="fa fa-check"></i></button>
          <!--          <input class="form-check" type="checkbox" v-model="affiliation.enable">-->
        </div>
      </div>
      <div class="row mb-5">
        <div class="col-md-2">
          Domyślna afiliacja:
        </div>
        <div class="col-md-4">
          <input v-model="affiliation.forceActive" class="form-check" type="checkbox">
        </div>
      </div>
      <div class="row mb-5">
        <div class="col-md-2">
          <button class="btn btn-success" @click="saveAffiliation">Zapisz ustawienia afiliacji</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>

export default {
  name: "ShopSubpageAffiliations",
  components: {},
  data() {
    return {
      affiliations: [],
      selectAffiliation: 0
    }
  },
  computed: {
    subpage() {
      return this.$store.getters.resource.modelEntity.subpages[this.$store.getters.currentLocale];
    }
  },
  methods: {
    saveAffiliation() {
      this.ajax(
        {
          url: '/admin/api/affiliations/shopaffiliations-save/' + this.affiliations[this.selectAffiliation].idShop,
          data: {affiliation: this.affiliations[this.selectAffiliation]}
        }
      )
    }
  },
  created() {
    this.ajax(
      {
        url: '/admin/api/affiliations/shopaffiliations-subpage/' + this.subpage.idSubpage,
        responseCallbackSuccess: res => {
          this.affiliations = res.data.affiliations;
        }
      }
    )
  }
}
</script>

<style scoped>

</style>
