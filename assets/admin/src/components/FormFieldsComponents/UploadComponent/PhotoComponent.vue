<template>
  <div class="card">
    <div class="card-title" v-text="name"></div>
    <div class="card-text">
      <div class="row">
        <div class="col-md-12">
          <div class="form-group row m-t-20">
            <div class="col-md-2">
              <label>Plik</label>
            </div>

            <div class="col-md-6">
              <button class="btn btn-info" @click="openFilesManager"><i class="mdi mdi-upload"></i> </button>
              <div v-text="value.path"></div>
            </div>
            <div class="col-md-4">
              <img :src="loadImage(value).src" class="thumb-lg">
            </div>

            <!--      <img v-if="filepath" :src="filepath" style="width: 60px; height: 60px">-->
          </div>
          <hr>
          <div class="form-group row m-t-20">
            <div class="col-md-3">
              <label>Alt</label>
            </div>
            <div class="col-md-9">
              <input type="text" class="form-control" v-model="value.data.alt">
            </div>
            <!--      <img v-if="filepath" :src="filepath" style="width: 60px; height: 60px">-->
          </div>
          <hr>
        </div>
      </div>
    </div>
  </div>

</template>

<script>
import valueResourceByPath from "../../../mixins/Page/valueResourceByPath";
import photos from "../../../mixins/Photo/photos";
export default {
  name: "PhotoComponent",
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
      value: null
    }
  },
  mixins:[valueResourceByPath, photos],
  watch:{
    value()
    {
      this.change();
    },
  },
  computed:{
    indexPhoto()
    {
      console.log(this.getResourceValue(this.path));
      return this.getIndexPhoto(this.getResourceValue(this.path), this.group);
    },
    pathPhoto()
    {
      return this.path + '[' + this.indexPhoto + ']';
    },
    options()
    {
      return this.form.options;
    },
    name()
    {
      return this.form.name;
    },
    filepathDecoded()
    {
      let path = this.value.folder;
      if (path.charAt(path.length - 1) === "/") path = path.substr(0, path.length - 1);
      return btoa(path.replace(this.rootPath, '')).replace(/\+/g, '-').replace(/\//g, '_').replace(/=/g, '.').replace(/\.+$/, '');
    },
    rootPath()
    {
      return this.$store.getters.config.filePath;
    },
    group()
    {
      return this.options.group;
    },
    urlFileManager()
    {
      return this.baseUrl + '/admin/elfinder/form'+'#elf_l1_' + this.filepathDecoded;
    }
  },
  methods:
    {

      openFilesManager()
      {
        window.setValue = filename => {
          this.value.path = filename;
        }
        window.open(this.urlFileManager, "", "width=800,height=400");

      },
      change()
      {
        let index = this.indexPhoto;
        this.$store.commit('setChanges', {
          path: this.path + '.' + this.indexPhoto,
          value: this.value,
          type: this.form.type
        })
      }
    },
  created() {
    this.value = this.getResourceValue(this.pathPhoto, {
      path: "",
      data: {
        alt: ''
      },
      folder: this.rootPath
    });
  }
}
</script>

<style scoped>

</style>
