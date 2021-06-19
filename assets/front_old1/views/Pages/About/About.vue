<template>
<div v-if="$store.getters.typePage === 'Pages-About-About'">
  <div class="slider-section bg padB60">
    <div class="container">
      <div class="row">
        <div class="col-md-3 col-sm-3 col-xs-12">
          <!-- nav -->
        </div>
        <div class="col-md-9 col-sm-9 col-xs-12">
          about
        </div>
      </div>
    </div>
  </div>
</div>
</template>

<script>

  export default {
    name: "About",
    data()
    {
      return {
        component: 1
      }
    },
    methods:{
      setActiveComponent(value)
      {
        this.component = value;
      },
    },
    computed:{
      subpage()
      {
        return this.$store.getters.currentSubpage;
      }
    },
  }
</script>

<style>

</style>
