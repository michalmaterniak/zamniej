<template>
  <div>
    <div class="row">
      <div class="col-md-12">
        <ul class="nav nav-tabs" role="tablist">
          <li class="nav-item" v-for="(config, index) in configs" :key="index">
            <a class="nav-link" href="#" :class="{active : subtab === 'tab' + index}" data-toggle="tab" role="tab" @click="changeTab('tab'+index)">
              <span class="hidden-sm-u`p"></span>
              <span class="hidden-xs-down" v-text="config.name"></span>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="row mt-5">
      <div class="tab-pane active" role="tabpanel" v-if="subtab === 'tab' + index" v-for="(config, index) in configs" :key="index">
        <pre>
          {{ config }}
        </pre>
      </div>
    </div>
  </div>
</template>
<script>

export default {
  props:{
    program:{
      type: Object
    }
  },
  name: "PagesSettings",
  data(){
    return {
      subtab: 'tab1',
      configs: []
    }
  },
  computed:{
    tab()
    {
      switch (this.subtab)
      {
        case 'homepage' : return 'homepage';
        default : return 'homepage';
      }
    }
  },
  methods:{

    changeTab(subtab)
    {
      this.subtab = subtab;
    }
  },
  created() {
    this.ajax({
      url: '/admin/api/pages/resource/types',
      responseCallbackSuccess: res => {
        this.configs = res.data;
        this.subtab = 'tab' + 1;
      }
    })
  }
}
</script>

<style scoped>

</style>

