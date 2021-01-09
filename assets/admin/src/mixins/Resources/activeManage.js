import valueResourceByPath from "../Page/valueResourceByPath";

export default {
  mixins: [valueResourceByPath],
  methods:{
    setActiveSubpage(active, idSubpage, successCallback)
    {
      this.ajax({
        url: '/admin/api/pages/subpage-active/' + Number(active) + '/' + idSubpage,
        responseCallbackSuccess: res => {
          successCallback(res)
        }
      });
    },
    setActiveInStore(payload) {
      this.$store.commit('changeValueResource', {
        path: 'modelEntity.subpages.' + this.$store.getters.currentLocale + '.active',
        value: payload
      })
    }
  }
}
