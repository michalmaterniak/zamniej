<template>
  <!--modal popup start-->
  <div id="MainModal" aria-hidden="true" class="modal fade bd-example-modal-lg theme-modal" role="dialog"
       tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-body modal1">
          <div class="container-fluid p-0">
            <div class="row">
              <div class="col-12">
                <div class="modal-bg">
                  <button aria-label="Close" class="close btn" data-dismiss="modal" type="button">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  <div class="offer-content"><img alt=""
                                                  class="img-fluid blur-up lazyload"
                                                  src="/page2/images/Offer-banner.png">
                    <h2>newsletter</h2>
                    <form
                      id="mc-embedded-subscribe-form"
                      action="https://pixelstrap.us19.list-manage.com/subscribe/post?u=5a128856334b598b395f1fc9b&amp;id=082f74cbda"
                      class="auth-form needs-validation"
                      method="post" name="mc-embedded-subscribe-form"
                      target="_blank">
                      <div class="form-group mx-sm-3">
                        <input id="mce-EMAIL" class="form-control" name="EMAIL"
                               placeholder="Enter your email"
                               required="required" type="email">
                        <button id="mc-submit" class="btn btn-solid"
                                type="submit">subscribe
                        </button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--modal popup end-->
</template>

<script>
import { BModal, BButton } from 'bootstrap-vue'
export default {
  name: 'Modal',
  methods: {
    showModal() {
    }
  },
  mounted() {

  }
}
</script>

<style scoped>

</style>
