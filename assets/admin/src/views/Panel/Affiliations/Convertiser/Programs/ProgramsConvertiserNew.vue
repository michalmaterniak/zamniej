<template>
  <div class="card-title">Nowe programy afiliacyjne Convertiser</div>
</template>

<script>
export default {
  name: "ProgramsConvertiserNew",
  methods:{
    setPrograms(){
      this.ajax({
        url: '/admin/api/affiliations/convertiser/programs-new',
        responseCallbackSuccess: res => {
          //this.programs = res.data.programs;
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
