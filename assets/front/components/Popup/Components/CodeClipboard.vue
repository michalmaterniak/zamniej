<template>
  <div>
    <span v-if="isTouchDevice && isClickCoupon" class="green" v-text="'Skopiowano!'"></span>
    <button class="itg-btn box-btn black " id="clipboard-code" :class="{clicked: isClickCoupon}" v-clipboard:copy="code" v-clipboard:success="clipboard">
      {{ code }}
      <span v-if="!isClickCoupon">Skopiuj kupon</span><span v-else>Skopiowano</span></button>
  </div>

</template>
<script>
export default {
  name: "CodeClipboard",
  props: ['code'],
  data(){
    return {
      isClickCoupon: false
    }
  },
  methods:{

    clipboard(e)
    {
      this.isClickCoupon = true;
    },
    isTouchDevice()
    {
      return "ontouchstart" in document.documentElement;
    }
  },
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
