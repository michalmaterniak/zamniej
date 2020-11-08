<template>
    <div>
        <div id="main-wrapper" data-layout="vertical" data-sidebar-position="fixed" data-header-position="fixed"
             :data-sidebartype="sidebarMini ? 'mini-sidebar' : 'full'">
            <header-menu :sidebar="sidebarMini" @sidebar="setSidebar" @mouseenter="setSidebar(true)"
                         @mouseleave="setSidebar(false)"/>
            <sidebar-menu/>
            <div class="page-wrapper">
                <div class="container-fluid">
                  <button class="btn btn-info" @click="$router.back()"><i class="mdi mdi-arrow-left"></i>Wróć</button>
                  <hr>
                  <router-view/>
                    <!--                    <router-view />-->
                  <button v-if="scrolling > 150" class="btn btn-info go-to-top" @click="gotToTop"><i
                            class="mdi mdi-arrow-up"></i></button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
	import HeaderMenu from "../components/Menu/HeaderMenu";
	import SidebarMenu from "../components/Menu/SidebarMenu";

	export default {

		name: "Panel",
		components: {SidebarMenu, HeaderMenu},
		data() {
			return {
				scrolling: 0,
				sidebarMini: false,
			}
		},
		computed: {},
		methods: {
			setSidebar(force = false) {
				if (force === false)
					this.sidebarMini = !this.sidebarMini;
				else
					this.sidebarMini = true;
			},
			scroll() {
				this.scrolling = window.scrollY;
			},
			gotToTop() {
				document.body.scrollTop = 0;
				document.documentElement.scrollTop = 0;
			},

		},
		created() {

			// customApp.init();
			window.addEventListener('scroll', this.scroll);


		},
		mounted() {
			this.setLoading(false);
		}
	}
</script>

<style scoped>
    .go-to-top {
        position: fixed;
        bottom: 0;
        right: 0;
    }

</style>
