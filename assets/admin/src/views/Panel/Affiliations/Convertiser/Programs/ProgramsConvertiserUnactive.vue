<template>
  <div class="card-title">Nieaktywne programy afiliacyjne Convertiser</div>
</template>

<script>
export default {
  name: "ProgramsConvertiserUnactive",
  methods:{
    setPrograms(){
      this.ajax({
        url: '/admin/api/affiliations/convertiser/programs-unactive',
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
