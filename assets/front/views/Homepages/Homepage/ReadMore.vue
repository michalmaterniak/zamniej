<template>
  <div :class="{'pointer' : !isShowContent}"
       class="row marB30">
    <div class="container">
      <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 text-center" @click="showContent">
        <div class="content content-homepage" v-html="lead"></div>
      </div>
      <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 text-right" @click="showContent">
        <button v-if="!isShowContent" class="btn ">Czytaj więcej</button>
      </div>
      <div :class="{'hidden' : !isShowContent}" class="col-sm-12 col-xs-12 col-md-12 col-lg-12 text-center">
        <div class="content content-homepage" v-html="content"></div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "ReadMore",
  props: {
    content: {
      default: '',
      type: String
    },
    lead: {
      default: '',
      type: String
    }
  },
  data() {
    return {
      isShowContent: true
    }
  },
  methods: {
    showContent() {
      if (!this.isShowContent) {
        this.isShowContent = true;
      }

      if (typeof window.ontouchstart !== 'undefined') {
        this.isShowContent = false;
        this.$store.commit('setPopup', {
          template: () => import("@/views/Homepages/Sections/PopupTextHomepage"),
          title: '',
          data: {
            lead: this.lead,
            content: this.content
          },
          options: {
            styleDialog: {width: '85%'}
          }
        })
      }
    }
  },
  mounted() {
    self = this;
    window.addEventListener('scroll', function handler() {
      self.isShowContent = false;
      this.removeEventListener('scroll', handler);
    });
  }
}
</script>

<style scoped>
.btn-orange {
  color: #fff;
  background-color: #f57f25;
  border-color: #f57f25;
  width: 100%;
}

.btn-orange:hover {
  color: #212529;
  background-color: #eee;
  border-color: #f57f25;
}

.white-gradient {
  background: rgba(255, 255, 255, 0);
  background: -moz-linear-gradient(top, rgba(255, 255, 255, 0) 0%, rgba(246, 246, 246, 1) 50%, rgba(255, 255, 255, 1) 100%);
  background: -webkit-gradient(left top, left bottom, color-stop(0%, rgba(255, 255, 255, 0)), color-stop(50%, rgba(246, 246, 246, 1)), color-stop(100%, rgba(255, 255, 255, 1)));
  background: -webkit-linear-gradient(top, rgba(255, 255, 255, 0) 0%, rgba(246, 246, 246, 1) 50%, rgba(255, 255, 255, 1) 100%);
  background: -o-linear-gradient(top, rgba(255, 255, 255, 0) 0%, rgba(246, 246, 246, 1) 50%, rgba(255, 255, 255, 1) 100%);
  background: -ms-linear-gradient(top, rgba(255, 255, 255, 0) 0%, rgba(246, 246, 246, 1) 50%, rgba(255, 255, 255, 1) 100%);
  background: linear-gradient(to bottom, rgba(255, 255, 255, 0) 0%, rgba(246, 246, 246, 1) 50%, rgba(255, 255, 255, 1) 100%);
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ededed', endColorstr='#ffffff', GradientType=0);

}
</style>
