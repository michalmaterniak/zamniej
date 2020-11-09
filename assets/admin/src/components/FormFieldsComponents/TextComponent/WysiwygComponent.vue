<template>
  <div class="form-group m-t-20">
    <label v-text="name"></label>
    <ckeditor v-model="value" :config="config" @input="change"/>
  </div>
</template>

<script>
    import valueResourceByPath from "../../../mixins/Page/valueResourceByPath";
    export default {
      props:{
        form:{
          type: Object
        },
        path:{
          type: String
        }
      },
      name: "WysiwygComponent",

      mixins:[valueResourceByPath],
      data()
      {
        return {
          value: '',
          config:{
            allowedContent: true,
            language: 'pl',
            filebrowserBrowseUrl: '/elfinder',
            uiColor : '#b7c6ee'
          }
        }
      },
      watch:{
        value()
        {
          this.change();
        }
      },
      computed:{
        name(){
          return this.form.name;
        }
      },
      methods:{
        change(ev)
        {
          this.$store.commit('setChanges', {
            path: this.path,
            value: this.value,
            type: this.form.type
          })
        }
      },
      created() {
        this.value = this.getResourceValue(this.path, '');
      },
    }
</script>

<style scoped>

</style>
