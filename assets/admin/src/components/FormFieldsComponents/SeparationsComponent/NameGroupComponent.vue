<template>
  <div class="h4 mt-4 mb-4" v-text="form.text"></div>
</template>

<script>
export default {
  name: "NameGroupComponent",
  props:{
    form:{
      type: Object
    },
    path:{
      type: String
    }
  },
}
</script>

<style scoped>

</style>
