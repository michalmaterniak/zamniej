<template>
  <div class="form-group m-t-20">
    <label v-text="name"></label>
    <ckeditor v-model="value" :config="config" />
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
      name: "MiniWysiwygComponent",
      computed:{
        name(){
          return this.form.name;
        }
      },
      mixins:[valueResourceByPath],
      data()
      {
        return {
          value: '',
          config:{
            //width: 500,
            width: '80%',
            toolbar: [
              ['Bold','Italic','Underline','StrikeThrough','-','Undo','Redo','-','Cut','Copy','Paste','Find','Replace','-','Outdent','Indent','-','Print'],
              ['NumberedList','BulletedList','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
              ['Image','Table','-','Link','Flash','Smiley','TextColor','BGColor','Source']
            ],
            language: 'pl',
            filebrowserBrowseUrl: '/admin/elfinder',
            uiColor : '#b7c6ee'
          }
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
        this.value = this.getResourceValue(this.path, null);
      },
    }
</script>

<style scoped>

</style>
