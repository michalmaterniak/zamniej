<template>
  <div class="form-group m-t-20">
    <label v-text="name"></label>
    <div class="row">
      <div class="card" :class="'col-md-' + options.colsperrow" v-for="(val, index) in elements">
        <div class="card-title">
          Numer: {{ index+1 }}
        </div>
        <div class="card-text">
          <div  v-for="(field, indexField) in fields">
            <component :is="formFieldsComponents[field.type]" :form="field" :path="createPath(form.resource, index, field.resource)" />
          </div>
        </div>
        <div class="card-footer text-right">
          <button class="btn btn-danger" @click="removeElement(index)"><i class="mdi mdi-delete"></i> </button>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 text-right">
        <button class="btn btn-info" @click="addElement"><i class="mdi mdi-plus"></i></button>
      </div>
    </div>
  </div>
</template>

<script>
    import valueResourceByPath from "../../../mixins/Page/valueResourceByPath";
    export default {
      name: "ArrayComponent",
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
          elements: 0,
          values: []
        }
      },
      watch:{
        path(){
          this.values = this.getResourceValue(this.path, []);
          this.elements = this.values.length;
        }
      },
      computed:{
        options(){
          return this.form.options;
        },
        name(){
          return this.form.name;
        },
        fields(){
          return this.form.fields.basic.main.fields;
        },

      },
      mixins:[valueResourceByPath],
      methods:
      {
        addElement()
        {
          this.elements++;
        },
        removeElement(index)
        {
          this.values.splice(index, 1);
          this.elements--;
        },
        createPath(path, elem, name)
        {
          return this.path + '.' + elem + '.' + name;
        },
        change(ev)
        {
          this.$store.commit('setChanges', {
            path: this.path,
            value: ev.target.value
          })
        }
      },
      created() {
        this.values = this.getResourceValue(this.path, []);
        this.$store.commit('setChanges', {
          path: this.path,
          value: this.values,
          type: this.form.type
        })

        this.elements = this.values.length;
      }
    }
</script>

<style scoped>
</style>
