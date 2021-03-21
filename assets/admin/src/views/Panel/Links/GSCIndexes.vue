<template>
  <div class="form-group">
    <div class="row">
      <div class="col-md-4">
        <div class="">
          <input type="file" id="validatedCustomFile" ref="file" @change="handleFileUpload()">
          <label class="custom-file-label" for="validatedCustomFile" v-text="fileName"></label>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4 text-right">
        <button class="btn btn-primary" :disabled="!this.file" @click="submitFile">Załaduj</button>
      </div>
    </div>
  </div>

</template>

<script>
export default {
  name: "GSCIndexes",
  data() {
    return {
      file: null
    }
  },
  computed:{
    fileName() {
      return this.file ? this.file.name : 'Wybierz plik...';
    }
  },
  methods:{
    submitFile() {
      let formData = new FormData();
      formData.append('file', this.file);
      this.ajax({
        url: '/admin/api/links/uploadStateIndexesFile',
        data: formData,
        header: {
          'Content-Type': 'multipart/form-data'
        },
        responseCallbackSuccess: res => {
          if (res.data.success) {
            this.showAlert("Zaktualizowano stan zaindeksowanych podstron", 'success');
          }
        }
      })
    },
    handleFileUpload() {
      this.file = this.$refs.file.files[0];
    }
  }
}
</script>

<style scoped>

</style>
