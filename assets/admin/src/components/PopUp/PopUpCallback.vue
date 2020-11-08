<template>
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="mainModalLabel" v-text="title"></h5>
            <button type="button" class="close" aria-label="Close" data-dismiss="modal">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12" v-html="data.content"></div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn" :class="callbackBtnClass" @click="callback" v-html="callbackText"></button>
            <button type="button" class="btn btn-secondary" @click="closePopup" data-dismiss="modal">Anuluj</button>
        </div>
    </div>
</template>


<script>
	export default {
		name: "PopUpCallback",
		props: ['data', 'title'],

		computed: {
			callbackText() {
				return (this.data.callbackBtnText === undefined) ? "Zapisz" : this.data.callbackBtnText;
			},
			callbackBtnClass() {
				return (this.data.callbackBtnClass === undefined) ? "btn-danger" : this.data.callbackBtnClass;
			}
		},
		methods: {
			callback() {
				this.data.callbackAccept();
				this.closePopup();
			}
		}
	}
</script>

<style scoped>

</style>
