<template>
  <div  v-if="links">
    <div class="main-footer padT60">
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="footer-logo">
              <p>
                Bądź na bieżąco z najnowszymi promocjami
              </p>
              <p>
                "Pieniądze szczęścia nie dają. Dopiero zakupy."
              </p>

              <div v-if="loadedContent">
                <h4>Kontakt</h4>
                <a href="mailto:kontakt@zamniej.pl">kontakt@zamniej.pl</a>
              </div>

            </div>
          </div>
          <div class="col-md-2 col-sm-2 col-xs-12" v-for="(group, index) in links" v-if="group && group.links.length > 0" :key="index">
            <h4 v-text="group.group"></h4>
            <p v-for="(link, indexLink) in group.links" :key="indexLink">
              <nuxt-link :to="{path: link.link}" v-html="link.name"></nuxt-link>
            </p>
          </div>
          <div class="col-md-12 col-sm-12 col-xs-12">
          </div>
        </div>
      </div>
    </div>
    <div class="copyright-section">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <p><font-awesome-icon :icon="'copyright'"/> 2020 <a href="https://commit-m.pl/"><span class="itg-color">commit-m</span></a></p>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: "Footer",
  data() {
    return {
      loadedContent: false
    }
  },
  computed: {
    links() {
      return this.$store.getters.initFront.data.links.footer;
    }
  },
  mounted() {
    window.addEventListener('load', () => {
      this.loadedContent = true
    });
  }
}
</script>

<style scoped>

</style>
