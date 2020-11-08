export default {
  data(){
    return {
      sliders:[]
    }
  },
  methods:{
    setSliders()
    {
      this.ajax({
        url: '/admin/api/sliders/sliders/listing/',
        responseCallbackSuccess: res => {
          this.sliders = res.data.sliders;
        }
      })
    }
  },
  created() {
    this.setSliders();
  },
}
