<template>
<div>
  <button type="button" class="btn dropdown-toggle" :class="type" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <slot/>
  </button>
  <div class="dropdown-menu">
    <button class="dropdown-item" href="#" v-for="(action, index) in actions" :key="index" v-text="action.name + ' (' + countAffiliations(action.name) + ')'" @click.prevent="action.action" v-if="isEnable(action.name)"></button>
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
    },
    shopsAffiliations: {
      type: Array,
      default: []
    }
  },
  methods:{
    isEnable(name) {
      return this.countAffiliations(name) > 0;
    },
    countAffiliations(name) {
      let count = 0;
      this.shopsAffiliations.forEach(item => {
        if(item.affiliation.name === name)
          count++;
      });
      return count;
    }
  }
}
</script>

<style scoped>

</style>
