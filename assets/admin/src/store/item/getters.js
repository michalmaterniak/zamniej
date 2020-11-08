export default {
  system: state => {
		return state.system;
	},
  langs: state => {
	  return state.system.langs;
  },
  currentLocale: state => {
	  return state.system.currentLocale;
  },
  resource: state => {
    return state.resource;
  },
  forms: state => {
    return state.forms;
  },
  changes: state => {
    return state.changes;
  },
  config: state => {
    return state.system;
  },
}
