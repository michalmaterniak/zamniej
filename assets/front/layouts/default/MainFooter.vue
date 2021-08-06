<template>
  <footer class="footer-light">
    <div class="row footer-theme partition-f m-5">
      <div v-for="(group, index) in links" class="col-12 col-sm-6 col-xl-3 col-md-6 mt-md-5">
        <div class="sub-title">
          <div class="footer-title">
            <h4 v-text="group.group"></h4>
          </div>
          <div class="footer-contant">
            <ul>
              <li v-for="(link, indexLink) in group.links" :key="indexLink">
                <nuxt-link :to="{path: link.link}" v-html="link.name"></nuxt-link>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="sub-footer">
      <div class="container">
        <div class="row">
          <div class="col-xl-6 col-md-8 col-sm-12 offset-xl-6 offset-md-2" >
            <div class="footer-end">
              <p><i aria-hidden="true" class="fa fa-copyright"></i> 2021 ZaMniej.pl</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>
</template>
<script>
export default {
  name: 'MainFooter',
  data() {
    return {
      isFooterEnabled: false
    }
  },
  computed:{
    links() {
      return this.$store.getters.initFront.data.links.footer;
    }
  }
}
</script>

<style scoped>
.footer-light {
  background-color: #e8e7e7;
}
</style>
