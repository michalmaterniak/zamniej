<template>
  <div class="form-group m-t-20">
    <label v-text="name"></label>
    <textarea type="text" class="form-control" v-model="value"></textarea>
  </div>
</template>

<script>


    import valueResourceByPath from "../../../mixins/Page/valueResourceByPath";

    export default {
      name: "TextareaComponent",
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
          value: ''
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
        },
      },
      mixins:[valueResourceByPath],

      methods:
      {
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
      }
    }
</script>

<style scoped>

</style>
