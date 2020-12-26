<template>
  <div class="card-title">Nieaktywne programy afiliacyjne Webepartners</div>
</template>

<script>
export default {
  name: "ProgramsUnactive",
  methods:{
    setPrograms(){
      this.ajax({
        url: '/admin/api/affiliations/webepartners/programs-unactive',
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
