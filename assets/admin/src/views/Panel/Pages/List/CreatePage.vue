<template>
  <div class="row ">
    <div class="col-md-8" >
      <v-select :value="selectedChildType" @input="selectChild" :options="childrenTypesResource" :reduce="type => type.key" label="name">
        <template v-slot:no-options="{ childrenTypesResource }">
          <template v-if="!childrenTypesResource">
            Ta podstrona nie może mieć swoich podstron
          </template>
        </template>
      </v-select>
    </div>
    <div class="col-md-4">
      <button class="btn btn-success" @click="createPage">Twórz podstronę.</button>
    </div>
  </div>
</template>

<script>
export default {
  name: "CreatePage",
  props:['parent', 'childrenTypesResource'],
  data() {
    return {
      selectedChildType: '',
    }
  },
  watch: {
    childrenTypesResource() {
      this.setDefaultSelected();
    }
  },
  computed: {
    // typesResources() {
    //   if(this.childrenTypesResource.length > 0) {
    //     return this.childrenTypesResource;
    //   } else {
    //     return {
    //
    //     }
    //   }
    // }
  },
  methods:{
    selectChild(value) {
      this.selectedChildType = value;
    },
    createPage() {
      if(this.selectedChildType) {
        console.log('create page ' + this.selectedChildType);
      }
    },
    setDefaultSelected() {
      this.selectedChildType = this.childrenTypesResource[0].key;
    }
  },
  created() {
    if(this.childrenTypesResource.length > 0) {
      this.setDefaultSelected();
    }
  }

}
</script>

<style scoped>

</style>
