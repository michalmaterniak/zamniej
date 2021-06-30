<template>
  <div>
    <div v-if="isTouchDevice && isClickCoupon" class="green" v-text="'Skopiowano!'"></div>
    <div>
      <a @mouseenter="setTextButton(code)" @mouseleave="setTextButton(null)" href="#" class="btn btn-solid const-width" id="clipboard-code" :class="{clicked: isClickCoupon}" v-clipboard:copy="code" v-clipboard:success="clipboard">
        <!--      {{ code }}-->
        <span v-if="!isClickCoupon"><span v-text="showingTextButton" ></span></span><span v-else>Skopiowano</span></a>
    </div>
  </div>
</template>
<script>
export default {
  name: "CodeClipboard",
  props: ['code'],
  data(){
    return {
      isClickCoupon: false,
      showingTextButton: null
    }
  },
  methods:{
    setTextButton(text) {
      if (text) {
        this.showingTextButton = text;
      } else {
        this.showingTextButton = 'Kliknij, aby skopiować kupon';
      }
    },
    clipboard(e)
    {
      this.isClickCoupon = true;
      this.$emit('afterCopy');
    },
    isTouchDevice()
    {
      return "ontouchstart" in document.documentElement;
    }
  },
  created() {
    this.setTextButton();
  }
}
</script>

<style scoped>
.const-width {
  width: 320px;
}
@media (max-width: 576px) {
  .const-width {
    width: 220px;
  }
}
</style>
