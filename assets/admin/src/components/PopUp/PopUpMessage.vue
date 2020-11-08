<template>
    <form>
        <div class="form-group">
            <label for="recipient-name" class="col-form-label">Temat:</label>
            <input type="text" class="form-control" id="recipient-name" v-model="data.title">
        </div>
        <div class="form-group">
            <label for="message-text" class="col-form-label">Wiadomość:</label>
            <textarea class="form-control" id="message-text" v-text="data.content"></textarea>
        </div>
    </form>
</template>

<script>
	export default {
		name: "PopUpMessage",
		props: ['data']
	}
</script>

<style scoped>

</style>
