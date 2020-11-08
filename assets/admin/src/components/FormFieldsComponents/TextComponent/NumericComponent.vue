<template>
  <div class="form-group m-t-20">
    <label v-text="name"></label>
    <input type="number" class="form-control" v-model="value">
  </div>
</template>

<script>

    import valueResourceByPath from "../../../mixins/Page/valueResourceByPath";

    export default {
      name: "NumericComponent",
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
        change()
        {
          this.$store.commit('setChanges', {
            path: this.path,
            value: this.value,
            type: this.form.type
          })
        }
      },
      created() {
        this.value = this.getResourceValue(this.path);
      }
    }
</script>

<style scoped>

</style>
