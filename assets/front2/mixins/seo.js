export default {
  data() {
    return {
      seo: null,
    }
  },
  computed:{
    title() {
      return this.seo.title;
    },
    canonical() {
      return this.seo.title;
    },
    description() {
      return this.seo.title;
    }
  },
  head () {
    return {
      title: this.seo ? this.title : '',
      meta: [
        { hid: 'description', name: 'description', content: this.seo ? this.description : '' }
      ],
    }
  },
}
