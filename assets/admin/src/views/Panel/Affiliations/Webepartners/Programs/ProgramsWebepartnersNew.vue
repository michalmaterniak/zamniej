<template>
  <div class="card-title">Nowe programy afiliacyjne Webepartners</div>
</template>

<script>
export default {
  name: "ProgramsNew",
  methods:{

    setPrograms(){
      this.ajax({
        url: '/admin/api/affiliations/webepartners/programs-new',
        responseCallbackSuccess: res => {
          //this.programs = res.data.programs;
          this.$emit('setPrograms', res.data.programs);
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
