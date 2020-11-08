export default {
  methods:{
    getResourceValue(resourceStringPath, defaultEmpty = null)
    {
      return _.get(this.$store.getters.resource, resourceStringPath, defaultEmpty);
    },
  }
}
