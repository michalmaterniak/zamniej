<template>
  <div class="breadcrumb-section">
    <div class="breadcrumb-text">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="breadcrumb-text padTB50">
                <ul class="breadcrumb-list">
                  <li v-for="(breadcrumb, index) in breadcrumbs">
                    <nuxt-link :class="{'breadcrumb-item' : index > 0}" :to="{path:  breadcrumb.slug}" >
                      <span v-text="breadcrumb.name" v-if="index < breadcrumbs.length-1"></span>
                      <strong v-text="breadcrumb.name" v-else></strong>
                    </nuxt-link>
                  </li>
                </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "BreadCrumbs",
  computed:{
    name()
    {
      return this.$store.getters.model.subpage.subpage.name;
    },
    breadcrumbs()
    {
      return this.$store.getters.model.breadcrumbs;
    }
  }
}
</script>

<style scoped>
.breadcrumb-item:before{
  padding: 0 5px;
  color: #fff;
  content: "/\00a0";
}
</style>
