<template>
  <div>
    <div class="row">
      <div class="col-md-12">
        <ul class="nav nav-tabs" role="tablist">
          <li class="nav-item"> <a class="nav-link " href="#" :class="{active : subtab === 'basic'}" data-toggle="tab" role="tab" @click="changeTab('basic')"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Podstawowe</span></a> </li>
        </ul>
      </div>
    </div>
    <div class="row mt-5">
      <div class="col-md-12">
        <keep-alive>
          <component :is="tab" :program="program"/>
        </keep-alive>
      </div>
    </div>
  </div>
</template>
<script>


import BasicTradetracker from "./Tabs/BasicTradetracker";

export default {
  props:{
    program:{
      type: Object
    }
  },
  name: "DetailsTradetrackerProgram",
  data(){
    return {
      subtab: 'basic'
    }
  },
  computed:{
    tab()
    {
      switch (this.subtab)
      {
        case 'basic' : return BasicTradetracker;
        default : return BasicTradetracker;
      }
    }
  },
  methods:{

    changeTab(subtab)
    {
      this.subtab = subtab;
    }
  }
}
</script>

<style scoped>

</style>
