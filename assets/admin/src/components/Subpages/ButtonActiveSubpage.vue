<template>
  <button :class="{'btn-danger' : !active, 'btn-success' : active}" :disabled="!changeable" @click="setActive"
          class="btn ">
    <i class="mdi " :class="{'mdi-minus' : !active, 'mdi-check' : active}"></i>
  </button>
</template>

<script>
import activeManage from "../../mixins/Resources/activeManage";

export default {
  props: {
    changeable: {
      type: Boolean,
      default: true
    },
    active: {
      type: Boolean,
      default: false
    },
    idSubpage: {
      type: Number,
      default: 0
    }
  },
  mixins: [activeManage],
  name: "ButtonActiveSubpage",
  methods:{
    callbackSetActive(res) {
      this.$emit('setActive', res.data.active)
    },
    setActive() {
      this.setActiveSubpage(!this.active, this.idSubpage, this.callbackSetActive)
    }
  }
}
</script>

<style scoped>

</style>
