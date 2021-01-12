<template>
  <div class="card-title">Aktywne programy afiliacyjne Webepartners</div>
</template>

<script>
export default {
  name: "ProgramsActive",
  methods:{
    setPrograms(){
      this.ajax({
        url: '/admin/api/affiliations/webepartners/programs-active',
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
