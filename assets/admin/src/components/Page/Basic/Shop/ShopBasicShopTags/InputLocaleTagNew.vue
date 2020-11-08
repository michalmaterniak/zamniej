<template>
  <div class="row mb-5">
    <div class="col-md-6">
      <div class="row">
        <div class="col-md-6">
          <input type="text" class="form-control" v-model="valueTag">
        </div>
        <div class="col-md-4">
          <v-select  :options="langs" v-model="selectedLang" :clearable="false"></v-select>
        </div>
        <div class="col-md-2">
          <button class="btn btn-success" @click="addNewTag"><i class="mdi mdi-check"></i> </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "InputLocaleTagNew",
  props:['langs'],
  data()
  {
    return {
      valueTag: '',
      selectedLang: null
    }
  },
  methods:{
    addNewTag()
    {

      this.ajax({
        url: '/admin/api/tags/new',
        data: {
          locale: this.selectedLang ? this.selectedLang : this.$store.getters.currentLocale,
          tag: this.valueTag
        },
        responseCallbackSuccess: res => {
          this.$emit('addingNewTag', {
            tag: res.data.tag
          })
        }
      })
    }
  },
  created() {
    this.selectedLang = this.$store.getters.currentLocale;
  }
}
</script>

<style scoped>

</style>
