<template>
<div>
  <button type="button" class="btn dropdown-toggle" :class="type" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <slot/>
  </button>
  <div class="dropdown-menu">
    <a class="dropdown-item" href="#" v-for="(action, index) in actions" :key="index" v-text="action.name" @click.prevent="action.action"></a>
  </div>
</div>
</template>

<script>
export default {
  name: "ButtonDropdown",
  props: {
    type: {
      type: String,
      default: 'btn-success'
    },
    actions: {
      type: Array,
      /**
        {
          name: String,
          action: Callback
        }
       */
      default: []
    }
  }
}
</script>

<style scoped>

</style>
