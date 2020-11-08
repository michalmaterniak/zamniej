<template>
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="mainModalLabel" v-text="title"></h5>
            <button type="button" class="close" aria-label="Close" @click="closePopup">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            {{ data.content }}
        </div>
        <div class="modal-footer">
            <button type="button" class="btn" :class="buttonClass" @click="action" v-text="buttonClose"></button>
        </div>
    </div>
</template>

<script>
	export default {
		props: ['title', 'data'],
		name: "PopupText",
		methods: {
			action() {
				if (this.data.buttonAction !== undefined) {
					this.data.buttonAction();
				}
				this.closePopup();
			}
		},

		computed: {
			buttonClose() {
				return (this.data.buttonClose === undefined) ? 'Anuluj' : this.data.buttonClose;
			},
			buttonClass() {
				return (this.data.buttonClass === undefined) ? 'btn-secondary' : this.data.buttonClass;
			},
		}
	}
</script>

<style scoped>

</style>

