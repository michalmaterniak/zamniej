<template>
  <div class="card-title">Nieaktywne programy afiliacyjne Tradetracker</div>
</template>

<script>
export default {
  name: "ProgramsTradetrackerUnactive",
  methods:{
    setPrograms(){
      this.ajax({
        url: '/admin/api/affiliations/tradetracker/programs-unactive',
        responseCallbackSuccess: res => {
          this.$emit('setPrograms', res.data.programs);
          this.$emit('setOrdering', {
            by: 'idShop',
            ordering: 'asc'
          });
        }
      })
    }
  },
  created() {
    this.setPrograms();
  }
}
</script>

<style scoped>

</style>
