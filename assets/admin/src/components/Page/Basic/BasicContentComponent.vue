<template>
  <div>
    <div class="row">
      <div class="col-md-12">
        <ul class="nav nav-tabs" role="tablist">
          <li class="nav-item" v-for="(subt, index) in subtabs" :key="index"> <a class="nav-link " :class="{active : subtab === index}" href="#" data-toggle="tab" role="tab" @click="changeSubtab(index)"><span class="hidden-sm-up"></span> <span class="hidden-xs-down" v-text="subt.name"></span></a> </li>
        </ul>
      </div>
    </div>
    <content-form-component :forms="forms" :path="createPath" :key-name="subtab" :key="subtab + '-' + _uid"/>
  </div>
</template>

<script>

  import ContentFormComponent from "../../FormFieldsComponents/ContentFormComponent";
  export default {
    components: {ContentFormComponent},
    props: {
      form: {
        type: String,
        default: {}
      }
    },
    name: "BasicContentComponent",
    data(){
      return {
        subtab: 'main',
        constPath: ''
      }
    },
    computed:{
      options(){
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
        return this.options.resource + '.';
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
