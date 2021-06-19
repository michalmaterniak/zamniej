<template>
<div class="mt-3">
  <h4><strong>Kontakt</strong></h4>
  <p class="underline-hover pointer" @click="contactShow = true" v-if="!contactShow">Pokaż dane kontaktowe</p>
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
