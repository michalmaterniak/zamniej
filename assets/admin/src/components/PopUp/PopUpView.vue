<template>
    <!-- Modal -->
    <div class="modal fade" id="MainModal" tabindex="-1" role="dialog" aria-labelledby="mainModalLabel"
         :aria-hidden="true">
        <div class="modal-dialog" :class="options.classDialog" :style="options.styleDialog" role="document">
            <component :is="template" :title="title" :data="options.data"/>
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
				title() {
					return this.$store.getters.getPopup.title;
				},
				template() {
					return this.options.template;
				},
				options() {
					return this.$store.getters.getPopupOptions;
				},
			},
		methods:
			{
				close() {
					this.modal.modal('hide');
				}
			},
		mounted() {
			this.modal = $('#MainModal');
		}
	}
</script>

<style scoped>
    .maxWidth100 {
        max-width: 100%;
    }
    .maxWidth75 {
        max-width: 75%;
    }
</style>
