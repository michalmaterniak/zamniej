<template>
<div>
  <span v-text="program.programUrl"></span>
<pre v-text="program"></pre>
</div>
</template>

<script>
export default {
name: "BasicTradetracker",
  props:{
    program:{
      type:Object,
    }
  },

}
</script>

<style scoped>

</style>
