<template>
  <div class="card-title">Aktywne programy afiliacyjne Convertiser</div>
</template>

<script>
export default {
  name: "ProgramsConvertiserActive",
  methods:{
    setPrograms(){
      this.ajax({
        url: '/admin/api/affiliations/convertiser/programs-active',
        responseCallbackSuccess: res => {
          this.$emit('setPrograms', res.data.programs);
          this.$emit('setOrdering', {
            by: 'subpage.datetimeCreate',
            ordering: 'desc'
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
