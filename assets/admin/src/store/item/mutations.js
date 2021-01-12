
export default {
  setConfig(state, payload) {
		state.system = payload;
	},
  setCurrentLocale(state, payload)
  {
    state.system.currentLocale = payload;
  },
  setResource(state, payload)
  {
    state.resource = payload;
  },
  setForms(state, payload)
  {
    state.forms = payload;
  },

  setChanges(state, payload)
  {
    if(!_.isEmpty(payload)) {
      _.set(state.changes, payload.path, payload.value);
    } else {
      state.changes = {};
    }
  },
  changeValueResource(state, payload)
  {
    if (_.get(state.resource, payload.path) !== undefined || payload.forceCreate === true) {
      _.set(state.resource, payload.path, payload.value);
    }
  },
}
