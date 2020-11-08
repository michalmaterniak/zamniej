<template>
<div>
  <table class="table table-striped" v-if="slider">
    <thead>
      <tr>
        <th scope="col" style="width: 5%">Lp.</th>
        <th scope="col" style="width: 5%">ID</th>
        <th scope="col" style="width: 20%">Tytuł</th>
        <th scope="col" style="width: 20%">Zdjęcie</th>
        <th scope="col" style="width: 20%">Działania</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="(slide, index) in slides" :key="index">
        <th scope="row">Lp.</th>
        <td><span v-text="slide.idSlide"></span></td>
        <td><span v-text="slide.header"></span></td>
        <td>
          <img @click="openPopupImage(slide.photo)" :src="loadImage(slide.photo).src" class="mini-thumb">
        </td>
        <td>
          <button class="btn btn-danger" @click="removeSlide(slide.idSlide)"><i class="mdi mdi-delete"></i>Usuń slajd</button>
        </td>
      </tr>
    </tbody>
  </table>
</div>
</template>

<script>
export default {
name: "Slider",
  props:['id'],
  data(){
    return {
      slider: null,
    }
  },
  computed:{
    slides()
    {
      return this.slider.slides;
    }
  },
  methods:{
    removeSlide(idSlide)
    {
      this.ajax({
        url: '/admin/api/sliders/sliders/removeSlide/' + idSlide,
        responseCallbackSuccess: res => {
          let index = _.findIndex(this.slides, obj => {
            return obj.idSlide === idSlide;
          })
          this.slider.slides.splice(index, 1);
          this.showAlert('Poprawnie usunięto slajd', 'success');
        }
      })
    },
    setSlider()
    {
      this.ajax({
        url: '/admin/api/sliders/sliders/slider/' + this.id,
        responseCallbackSuccess: res => {
          this.slider = res.data.slider;
        }
      })
    }
  },
  created() {
    this.setSlider();
  }
}
</script>

<style scoped>

.mini-thumb
{
  width: 20%;
  height: auto;
}
</style>
