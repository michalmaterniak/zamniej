<template>
  <div>
    <div class="row mb-3">
      <div class="col-md-12">
        Aktywność: <button-active-subpage :id-subpage="subpage.idSubpage" :active="subpageActive" @setActive="setActiveInStore"/>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <ul class="nav nav-tabs" role="tablist">
          <li class="nav-item" v-for="(subt, index) in subtabs" :key="index"> <a class="nav-link " :class="{active : subtab === index}" href="#" data-toggle="tab" role="tab" @click="changeSubtab(index)"><span class="hidden-sm-up"></span> <span class="hidden-xs-down" v-text="subt.name"></span></a> </li>
        </ul>
      </div>
    </div>
    <content-form-component :forms="forms" :path="createPath" :key-name="subtab"/>
  </div>
</template>

<script>

  import ContentFormComponent from "../../FormFieldsComponents/ContentFormComponent";
  import ButtonActiveSubpage from "../../Subpages/ButtonActiveSubpage";
  import activeManage from "../../../mixins/Resources/activeManage";
  export default {
    components: {ButtonActiveSubpage, ContentFormComponent},
    props: {
      form: {
        type: String,
        default: {}
      }
    },
    name: "SubpageContentComponent",
    mixins: [activeManage],
    data(){
      return {
        subtab: 'main',
      }
    },
    computed:{
      subpageActive() {
        let ac = this.$store.getters.resource.modelEntity.subpages[this.$store.getters.currentLocale].active;
        console.log(ac);
        return ac;
      },
      subpage()
      {
        return this.$store.getters.resource.modelEntity.subpages[this.$store.getters.currentLocale];
      },
      options()
      {
        return this.$store.getters.forms[this.form]['options']
      },
      subtabs()
      {
        return this.$store.getters.forms[this.form]['parts'];
      },
      forms()
      {
        return this.$store.getters.forms[this.form]['parts'][this.subtab].fields;
      },
      createPath()
      {
        return this.options.resource+'.'+ this.$store.getters.currentLocale + '.';
      },
    },
    methods:{
      changeSubtab(subtab)
      {
        this.subtab = subtab;
      }
    }
  }
</script>

<style scoped>

</style>
