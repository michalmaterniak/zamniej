<template>
<div>
  <h4 class="orange capital marT20 ">Kontakt</h4>
  <span class="underline-hover pointer" @click="contactShow = true" v-if="!contactShow">Pokaż dane kontaktowe</span>
  <div v-else>
    <p>tel: <span v-text="contact.phone"></span></p>
    <p>email: <span><a :href="'mailto:' + contact.email"
                       v-text="contact.email"></a> </span>
    </p>
  </div>
</div>
</template>

<script>
export default {
  name: "ContactDetails",
  props:['contact'],
  data()
  {
    return {
      contactShow: false
    }
  }
}
</script>

<style scoped>

</style>
