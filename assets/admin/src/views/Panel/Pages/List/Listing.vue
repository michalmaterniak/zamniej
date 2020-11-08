<template>
<div>
  <div class="row">
    <div class="col-md-6">
      <create-page v-if="parent" :parent="parent" :childrenTypesResource="configListing.childrenTypesResource"/>
    </div>
    <div class="col-md-6">
      <button class="btn btn-primary" @click="allResources = !allResources" v-text="allResources === false ? 'Pokaż wszystkie ' : 'Ukryj nieaktywne' + this.allResourcesCount"></button>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <table class="table table-striped" v-if="resources.length > 0">
        <thead>
        <tr>
          <th scope="col" style="width: 10%">LP.</th>
          <th scope="col" style="width: 60%">Nazwa</th>
          <th scope="col" style="width: 30%">Działania</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="(model, index) in resources" :key="parent + '_' + index" v-if="model.modelEntity.config.hidden === false || allResources === true">
          <th scope="row" v-html="index+1"></th>
          <td>

            <router-link :to="{name: 'panel-pages-page', params: {id: model.modelEntity.idResource} }">
              <span v-text="model.modelEntity.name"></span>
            </router-link>

          </td>
          <td>
            <router-link tag="button" class="btn btn-info"
                         :title="model.modelEntity.countChildren + ' podstron'"
                         :to="{name: 'panel-pages-list-parent', params: {parent: model.modelEntity.idResource} }">
              <i class="mdi mdi-arrow-down-bold"></i>
            </router-link>

            <button-list :parentRes="model.modelEntity.idResource"
                         :active="model.modelEntity.active"
                         :changeable="model.modelEntity.config.unactivable"
                         :callbackAction="toggleActiveResource">
              <i class="mdi mdi-check"></i>
            </button-list>

            <button-list :parentRes="model.modelEntity.idResource" color="danger"
                         :active="true"
                         :changeable="model.modelEntity.config.removable"
                         :callbackAction="removeResource">
              <i class="mdi mdi-delete"></i>
            </button-list>
          </td>
        </tr>
        </tbody>
      </table>
      <div v-else class="alert alert-info mt-5">Nie ma żadnych podstron
        <button class="btn btn-outline-info" @click="$router.back()"><i class="mdi mdi-arrow-left-bold"></i></button>
      </div>
    </div>
  </div>
</div>
</template>

<script>
import ButtonList from "../../../../components/Buttons/ButtonList";
import PopUpCallback from "../../../../components/PopUp/PopUpCallback";
import CreatePage from "./CreatePage";
export default {
  name: "Listing",
  props: {
    parent: {
      type: [String, Number],
      default: 0
    },
  },
  components: {CreatePage, ButtonList},
  data() {
    return {
      resources: [],
      configListing: {
        childrenTypesResource : []
      },
      allResources: false
    }
  },
  watch: {
    parent() {
      this.loadResources();
    }
  },
  computed: {
    allResourcesCount() {
      let countActive = 0;
      this.resources.forEach(resource => {
        if(resource.modelEntity.active) {
          countActive++;
        }
      })
      if(countActive !== this.resources.length)
        return ' ' + String(this.resources.length) + '/' + countActive;
      else
        return '';
    }
  },
  methods:{
    toggleActiveResource(parentResource) {
      let index = _.findIndex(this.resources, ({modelEntity}) => modelEntity.idResource === parentResource);

      this.ajax({
        url: '/admin/api/pages/resource-store/' + this.resources[index].modelEntity.idResource,
        data: {
          modelEntity: {
            active: !this.resources[index].modelEntity.active
          }
        },
        responseCallbackSuccess: res => {
          if (res.data.status === true) {
            this.resources[index].modelEntity.active = res.data.resource.modelEntity.active;
          }
        }
      });
    },
    removeResource(parentResource) {
      let index = _.findIndex(this.resources, ({modelEntity}) => modelEntity.idResource === parentResource);
      if (index !== -1) {
        this.openPopup('Ukryj podstronę', {
          template: PopUpCallback,
          data: {
            content: 'Czy na pewno chcesz ukryć podstronę "<strong>' + this.resources[index].modelEntity.name + '</strong>"?',
            callbackBtnText: "Tak",
            callbackAccept: () => {
              this.ajax({
                url: '/admin/api/pages/resource-remove/' + this.resources[index].modelEntity.idResource,
                responseCallbackSuccess: res => {
                  if (res.data.status === true) {
                    this.resources.splice(index, 1);
                  }
                }
              });
            }
          }
        })
      }
    },
    loadResources() {
      this.ajax({
        url: '/admin/api/pages/resource-listing/' + this.parent,
        responseCallbackSuccess: res => {
          this.configListing = res.data.configListing;
          this.resources = res.data.resources;
        }
      });
    }
  },
  created() {
    this.loadResources();
  }
}
</script>

<style scoped>

</style>
