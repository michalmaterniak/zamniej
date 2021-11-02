<template>
  <div>
    <div class="row">
      <div class="col-md-12">
        <ul class="nav nav-tabs" role="tablist">
          <li class="nav-item" v-for="(config, index) in configs" :key="index">
            <a class="nav-link" href="#" :class="{active : subtab === index}" data-toggle="tab" role="tab" @click="changeTab(index)">
              <span class="hidden-sm-u`p"></span>
              <span class="hidden-xs-down" v-text="config.name"></span>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="row mt-5" v-if="subtab === index" v-for="(config, index) in configs" :key="index">
      <div class="col-md-8">
        <div class="form-group" v-for="(setting, index2) in config.setting.settings">
          <label v-text="translate(index2)"></label>
          <input type="text" class="form-control" v-model="config.setting.settings[index2]">
        </div>
      </div>
    </div>
    <div class="col-md-12">
      <button class="btn btn-success" @click="save">Zapisz</button>
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
      subtab: null,
      configs: [],
      settings: []
    }
  },
  methods:{
    translate(title) {
      switch (title) {
        case 'description':
          return 'Opis description';
        case 'title':
          return 'Tytuł';
        case 'header':
          return 'Nagłówek H1';
      }
    },
    changeTab(subtab)
    {
      this.subtab = subtab;
    },
    save() {
      this.ajax({
        url: '/admin/api/pages/resource/seo/save',
        data: {
          config: this.configs[this.subtab]
        }
      })
    }
  },
  created() {
    this.ajax({
      url: '/admin/api/pages/resource/seo/types',
      responseCallbackSuccess: res => {
        this.configs = res.data.configs;
        res.data.settings.forEach(item => {
          let index = _.findIndex(this.configs, config => {

            return config.typeName === item.target;
          });
          this.configs[index].setting = item;
        });

        this.subtab = 0;
      }
    })
  }
}
</script>

<style scoped>

</style>

