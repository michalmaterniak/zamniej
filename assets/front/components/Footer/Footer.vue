<template>
  <div  v-if="links">
    <div class="main-footer padT60">
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="footer-logo">
<!--              <a href=""><img src="@/assets/img/footer-logo.png" alt=""></a>-->
              <p>
                Bądź na bieżąco z najnowszymi promocjami
              </p>
              <p>
                "Pieniądze szczęścia nie dają. Dpiero zakupy."
              </p>
            </div>
          </div>
          <div class="col-md-2 col-sm-2 col-xs-12" v-for="(group, index) in links" :key="index">
            <h4 v-text="group.group"></h4>
            <p v-for="(link, indexLink) in group.links" :key="indexLink">
              <nuxt-link :to="{path: link.link}" v-text="link.name"></nuxt-link>
            </p>
          </div>


          <div class="col-md-12 col-sm-12 col-xs-12">
<!--            <div class="newsletter">-->
<!--              <div class="col-md-3 col-sm-3 col-xs-12">-->
<!--                <div class="row">-->
<!--                  <h5>bądź na bieżąco z najnowszymi promocjami</h5>-->
<!--                  <h3>newsletter</h3>-->
<!--                </div>-->
<!--              </div>-->
<!--              <div class="col-md-5 col-sm-5 col-xs-12">-->
<!--                <div class="row">-->
<!--                  <div class="newsletter-bar">-->
<!--                    <input type="text" placeholder="Podaj swój adres E-Mail">-->
<!--                  </div>-->
<!--                  <div class="submit">-->
<!--                    <a href="#" class="itg-btn">zapisz</a>-->
<!--                  </div>-->
<!--                </div>-->
<!--              </div>-->
<!--              <div class="col-md-4 col-sm-4 col-xs-12 text-right">-->
<!--                <div class="row">-->
<!--                  <ul>-->
<!--                    <li><a href=""><i class="fa fa-twitter" aria-hidden="true"></i></a></li>-->
<!--                    <li><a href=""><i class="fa fa-linkedin-square" aria-hidden="true"></i></a></li>-->
<!--                    <li><a href=""><i class="fa fa-facebook" aria-hidden="true"></i></a></li>-->
<!--                    <li><a href=""><i class="fa fa-skype" aria-hidden="true"></i></a></li>-->
<!--                    <li><a href=""><i class="fa fa-pinterest-square" aria-hidden="true"></i></a></li>-->
<!--                    <li><a href=""><i class="fa fa-google-plus-square" aria-hidden="true"></i></a></li>-->
<!--                    <li><a href=""><i class="fa fa-dribbble" aria-hidden="true"></i></a></li>-->
<!--                    <li><a href=""><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>-->
<!--                  </ul>-->
<!--                </div>-->
<!--              </div>-->
<!--            </div>-->
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
  computed:{
    links()
    {
      return this.$store.getters.initFront.data.links.footer;
    }
  }
}
</script>

<style scoped>

</style>
