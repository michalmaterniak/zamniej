<template>
    <aside class="left-sidebar" data-sidebarbg="skin5">
        <!-- Sidebar scroll-->
        <div class="scroll-sidebar">
            <!-- Sidebar navigation-->
            <nav class="sidebar-nav">
                <ul id="sidebarnav" class="p-t-30">
                    <router-link v-for="(link, index) in sidebar" :key="index" tag="li"
                                 :to="{name:  getDefaultRouteName(link)}" class="sidebar-item"
                                 :class="{'selected' : checkIfSelected(link.routeName)}">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link"
                           :class="{'has-arrow' : link.submenu && link.show === true, 'active' : link.submenu && link.show === true, }"
                           aria-expanded="false">
                            <i class="mdi" :class="link.icon"></i>
                            <span class="hide-menu" v-text="link.text"></span>
                        </a>
                        <ul v-if="link.submenu" aria-expanded="false" class="collapse first-level"
                            :class="{'in' : link.show === true}">
                            <router-link tag="li" v-for="(sublink, indexSublink) in link.submenu" :key="indexSublink"
                                         :to="{name: getDefaultRouteName(sublink)}" class="sidebar-item"
                                         :class="{'selected' : checkIfSelected(sublink.routeName)}">
                                <a class="sidebar-link waves-effect waves-dark sidebar-link" aria-expanded="false">
                                    <i class="mdi" :class="sublink.icon"></i>
                                    <span class="hide-menu" v-text="sublink.text"></span>
                                </a>
                            </router-link>
                        </ul>
                    </router-link>
                </ul>
            </nav>
        </div>
    </aside>
</template>

<script>
	export default {
		name: "SidebarMenu",
		computed: {
			sidebar() {
				return this.$store.getters.sidebar;
			}
		},
		methods: {
			getDefaultRouteName(link) {
				if (typeof link.routeName === 'object') {
					return link.routeName.default;
				} else if (typeof link.routeName === 'string') {
					return link.routeName;
				}
			},
			checkIfSelected(routeName) {
				if (typeof routeName === 'object') {
					const index = routeName.routesNameSelected.indexOf(this.$route.name);
					return index !== -1 || routeName.default === this.$route.name;
				} else if (typeof routeName === 'string') {
					return routeName === this.$route.name;
				}
			}
		},
		mounted() {
			// $('#sidebarnav a').on('click', function (e) {
			//
			//     if (!$(this).hasClass("active")) {
			//         // hide any open menus and remove all other classes
			//         $("ul", $(this).parents("ul:first")).removeClass("in");
			//         $("a", $(this).parents("ul:first")).removeClass("active");
			//
			//         // open our new menu and add the open class
			//         $(this).next("ul").addClass("in");
			//         $(this).addClass("active");
			//
			//     }
			//     else if ($(this).hasClass("active")) {
			//         $(this).removeClass("active");
			//         $(this).parents("ul:first").removeClass("active");
			//         $(this).next("ul").removeClass("in");
			//     }
			// })
			// $('#sidebarnav >li >a.has-arrow').on('click', function (e) {
			//     e.preventDefault();
			// });
		}
	}
</script>

<style scoped>

</style>
