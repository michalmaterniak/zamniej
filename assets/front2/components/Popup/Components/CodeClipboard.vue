<template>
  <div>
    <span v-if="isTouchDevice && isClickCoupon" class="green" v-text="'Skopiowano!'"></span>
    <a @mouseenter="setTextButton(code)" @mouseleave="setTextButton(null)" href="#" class="btn btn-solid " id="clipboard-code" :class="{clicked: isClickCoupon}" v-clipboard:copy="code" v-clipboard:success="clipboard">
<!--      {{ code }}-->
      <span v-if="!isClickCoupon"><span v-text="showingTextButton" ></span></span><span v-else>Skopiowano</span></a>
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
.itg-btn
{
  height: 50px;
}
.itg-btn.box-btn.clicked span
{
  left: -95%
}
</style>
