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
    },
    toggleActiveResource(index, newActive) {
      this.resources[index].modelEntity.subpages[this.$store.getters.currentLocale].active = newActive;
    },
    toggleActivePrograms(index, newActive) {
      this.programs[index].subpage.active = newActive;
    },
  }
}
