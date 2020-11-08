<template>
  <div>
    <div class="row">
      <div class="col-md-12">
        <button class="btn btn-info" @click="showLocale = !showLocale">Edytuj tagi</button>
      </div>
    </div>
    <div class="row" v-if="showLocale">
      <div class="col-md-12">
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">lp.</th>
              <th scope="col">Tag</th>
              <th scope="col">Dzialanie</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(tag, index) in tags" v-if="tag.tags[currentLocale]" :key="index" :class="{'table-primary' : tag.idShopTag === selectedTag}">
              <th scope="row" v-text="index+1"></th>
              <td v-text="tag.tags[currentLocale].name"></td>
              <td>
                <button class="btn btn-primary" @click="selectTag(tag.idShopTag)">Zaznacz</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="row" v-else>
      <div class="col-md-12">
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col" style="width: 5%">lp.</th>
              <th scope="col" style="width: 10%" v-for="(lang, indexLang) in langs" v-text="lang"></th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(tag, index) in tags" :key="index" :class="{'table-primary' : tag.idShopTag === selectedTag}">
              <th scope="row" v-text="index+1"></th>
              <input-locale-tag v-for="(lang, indexLang) in langs" :key="indexLang" :tag="tag.tags[lang] ? tag.tags[lang].name : ''" :locale="lang" :idShopTag="tag.idShopTag" @editTag="editTag"/>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="col-md-12">
        <button class="btn btn-info" @click="showAddNewTag = true"><i class="mdi mdi-plus"></i></button>
        <input-locale-tag-new v-if="showAddNewTag" :langs="langs" @addingNewTag="addNewTag"/>
      </div>
    </div>
  </div>
</template>
<script>
import InputLocaleTag from "./ShopBasicShopTags/InputLocaleTag";
import InputLocaleTagNew from "./ShopBasicShopTags/InputLocaleTagNew";
export default {
  name: "ShopBasicShopTags",
  components: {InputLocaleTagNew, InputLocaleTag},
  data(){
    return {
      tags: [],
      showLocale: true,
      showAddNewTag: false,
      selectedTag: 0,
    }
  },
  computed:{
    langs()
    {
      return this.$store.getters.langs;
    },
    currentLocale()
    {
      return this.$store.getters.currentLocale;
    },
    shop()
    {
      return this.$store.getters.resource;
    }
  },
  methods:{
    selectTag(idShopTag)
    {
      this.ajax({
        url: '/admin/api/pages/shops/shop/tag/' + this.shop.modelEntity.resource.id + '/' + idShopTag,
        responseCallbackSuccess: res => {
          this.$store.commit('changeValueResource', {
            value: res.data.tag,
            path: 'resource.details.tag'
          })
          this.selectedTag = res.data.tag.idShopTag;
        }
      })
    },
    addNewTag(payload)
    {
      this.showAddNewTag = false;
      this.tags.push(payload.tag);
    },
    editTag(payload)
    {
      let index = _.findIndex(this.tags, tag => {
        return tag.idShopTag === payload.id;
      })
      if(index !== -1)
      {
        this.tags[index].tags[payload.locale].name = payload.name;
      }
    }
  },
  created(){
    this.selectedTag = this.shop.modelResource.tag.idShopTag;
    this.ajax({
      url: '/admin/api/tags/tags',
      responseCallbackSuccess: res => {
        this.tags = res.data.tags;
      }
    })
  }
}
</script>

<style scoped>

</style>
