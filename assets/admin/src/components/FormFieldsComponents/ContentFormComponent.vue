<template>
  <div>
    <div v-for="(form, index) in forms" :key="index + _uid">
      <component :is="formFieldsComponents[form.type]" :form="form" :path="createPath(form.resource)" :key="keyName + '-' + index + _uid" />
    </div>
  </div>
</template>

<script>
    export default {
      props:['forms', 'path', 'keyName'],
      name: "ContentFormComponent",
      methods:{
        createPath(path)
        {
          return this.path + path
        }
      },
    }
</script>

<style scoped>

</style>
