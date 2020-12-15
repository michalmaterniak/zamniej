<template>
<div>
  <ckeditor :value="value" :config="configWysiwyg"  @input="change"/>
</div>
</template>

<script>
export default {
  name: "Wysiwyg",
  props:{
    value:{
      type: String,
    },
    config:{
      type: Object,
      default: () => { return {} }
    }
  },
  data(){
    return {
      configWysiwyg:{
        allowedContent: true,
        language: 'pl',
        filebrowserBrowseUrl: '/admin/elfinder',
        uiColor : '#b7c6ee'
      }
    }
  },
  methods:{
    change(value)
    {
      this.$emit('input', value)
    }
  },
  created() {
    this.configWysiwyg = Object.assign(this.configWysiwyg, this.config);
  }
}
</script>

<style scoped>

</style>
