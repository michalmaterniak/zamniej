<template>
    <!-- Modal -->
    <div class="modal fade" id="MainModal" tabindex="-1" role="dialog" aria-labelledby="mainModalLabel"
         :aria-hidden="true"  data-keyboard="false" data-backdrop="static" @click.stop="closeClickOutside" @keydown.esc="closeKeyEsc">
        <div class="modal-dialog" :class="classDialog" :style="styleDialog" role="document">
            <component :is="template" :title="title" :data="dataPopup" :options="options" />
        </div>
    </div>
    <!-- Modal -->
</template>

<script>
	export default {
		name: "PopUpView",
		data() {
			return {
				modal: null,
			}
		},
		computed:
      {
        blockedExit()
        {
          if (this.options.blockedExit && this.options.blockedExit === true)
            return true;
          else
            return false;
        },
			  popup(){
			    return this.$store.getters.getPopup;
        },
				title() {
					return this.popup.title;
				},
				template() {
          return this.popup.template;
				},
				options() {
          return this.popup.options;
				},
				dataPopup() {
          return this.popup.data;
				},
        classDialog(){
			    return this.popup.options.classDialog ? this.popup.options.classDialog : {};
        },
        styleDialog(){
			    return this.popup.options.styleDialog ? this.popup.options.styleDialog : {};
        }
			},
		methods:
			{
			  closeClickOutside(ev)
        {
          if(this.blockedExit === false && ev.target.getAttribute('id') === 'MainModal')
            this.close();
        },
        closeKeyEsc()
        {
          if(this.blockedExit === false)
            this.close();
        },
				close() {
          this.$store.commit('setPopup', {title: '', options: null, template: null, data: {}, objectClose: {}});
        }
			},
		mounted() {
			this.modal = $('#MainModal');
		},
    updated() {
		  // this.$forceUpdate();
    }
  }
</script>

<style scoped>
    .fullWidth {
        width: 85% !important;
    }
    .fullHeight{
      height: 85% !important;
    }
    .maxWidth75 {
        width: 75% !important;
    }

</style>
