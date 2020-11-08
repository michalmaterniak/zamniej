<template>
  <div class="row">
    <div class="col-md-12">
      <table class="table">
        <thead>
        <tr>
          <th scope="col" style="width: 5%">Lp.</th>
          <th scope="col" style="width: 50%">Opis</th>
          <th scope="col" style="width: 30%">Działania</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="(slider, index) in sliders">
          <th scope="row" v-text="index+1"></th>
          <td v-text="slider.description"></td>
          <td>
            <router-link  class="btn btn-info" :to="{name: 'panel-sliders-slider', params:{id: slider.idSlider}}" @click.native="closePopup"><i class="mdi mdi-arrow-right"></i>Zobacz więcej</router-link>
          </td>
        </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>


import sliders from "../../../mixins/Sliders/sliders";

export default {

name: "SlidersList",
  mixins:[sliders]
}
</script>

<style scoped>

</style>
