<template>
  <div class="form-group m-t-20">
    <label v-text="name"></label>
    <button class="btn btn-info" @click="openFilesManager"><i class="mdi mdi-upload"></i> </button>
    <div class="content" v-text="value ? value : filepath">
<!--      <img v-if="filepath" :src="filepath" style="width: 60px; height: 60px">-->
    </div>
  </div>
</template>

<script>
    import valueResourceByPath from "../../../mixins/Page/valueResourceByPath";
    export default {
      name: "UploadComponent",
      props:{
        form:{
          type: Object
        },
        path:{
          type: String
        }
      },
      data(){
        return {
          filepath: ''
        }
      },
      mixins:[valueResourceByPath],
      computed:{
        name(){
          return this.form.name;
        },
        value()
        {
          return this.getResourceValue(this.path);
        }
      },
      watch:{
        filepath()
        {
          this.$store.commit('setChanges', {
            path: this.path,
            value: this.filepath,
            type: this.form.type
          })
        }
      },
      methods:
      {
        openFilesManager()
        {
          window.setValue = filename => {
            this.filepath = filename;
          }
          window.open('/elfinder/form', "", "width=800,height=400");
        },
        change(ev)
        {
          this.$emit('changeComponent', {
            path: this.pathResource,
            value: ev.target.value
          })
        }
      },
      created() {

      }
    }
</script>

<style scoped>

</style>
