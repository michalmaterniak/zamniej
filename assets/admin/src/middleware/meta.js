function title(param) {
	let title = 'Panel Administracyjny';
	if (param.to.meta && param.to.meta.title) {
		title = param.to.meta.title + ' - ' + title;
	}
	document.title = title;
}

export default function meta(param) {
	title(param);
	param.next();
}
