export default {
	sidebar: [
		{
			text: "Ustawienia",
			routeName: 'panel-settings',
			show: true,
			submenu: [
				{
					text: "Ustawienai globalne",
					routeName: {default: 'panel-settings-global', routesNameSelected: ['panel-settings-global']},
				}
			]
		},
		// {
		// 	text: "Programy",
		// 	routeName: 'panel-affiliations-programs',
		// 	show: true,
		// 	submenu: [
		// 		{
		// 			text: "Nowe",
		// 			routeName: {default: 'panel-affiliations-programs-new', routesNameSelected: []},
		// 		},
		// 		{
		// 			text: "Aktywne",
		// 			routeName: {default: 'panel-affiliations-programs-active', routesNameSelected: []},
		// 		},
		// 		{
		// 			text: "Nieaktywne",
		// 			routeName: {default: 'panel-affiliations-programs-unactive', routesNameSelected: []},
		// 		},
		// 	]
		// },
		{
			text: "Strony",
			routeName: 'panel-pages',
			show: true,
			submenu: [
				{
					text: "Ustawienia stron",
					routeName: {default: 'panel-pages-setting', routesNameSelected: ['panel-pages-setting']},
				},
				{
					text: "Lista stron",
					routeName: {default: 'panel-pages-list', routesNameSelected: ['panel-pages-list', 'panel-pages-list-search', 'panel-pages-list-parent']},
				}
			]
		}
	]
}
