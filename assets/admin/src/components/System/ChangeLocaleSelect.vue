<template>
  <v-select :options="options" v-model="selectedLocale" :clearable="false" @input="change"></v-select>
</template>

<script>
    export default {
      name: "ChangeLocaleSelect",
      data(){
        return {
          selectedLocale: this.$store.getters.currentLocale
        }
      },
      computed:{
        availableResource(){
          return Object.keys(this.$store.getters.resource.modelEntity.subpages);
        },
        options(){
          return this.availableResource;
        }
      },
      methods:{
        change()
        {
          this.$store.commit('setCurrentLocale', this.selectedLocale);
        }
      }
    }
</script>

<style scoped>
</style>
