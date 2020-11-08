<template>
    <div>
        <div class="preloader" v-if="$store.getters.isLoading">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <router-view/>
        <footer class="footer text-center">
            <a href="#">&copy; Michal Materniak COMMIT-M</a>
        </footer>
        <pop-up-view/>
    </div>
</template>
<script>
	import PopUpView from "./components/PopUp/PopUpView";

	export default {
		components: {PopUpView},
		created() {
			this.$http.defaults.validateStatus = (status) => {
				return true;
			};
		},
    mounted() {
		  // this.openPopup('elo');
    }
  }
</script>
<style>
</style>
