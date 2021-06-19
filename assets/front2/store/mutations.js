import {BModal} from "bootstrap-vue";

export default {
  setDebug (state, payload) {
    state.debug.active = true;
    state.debug.token = payload.token;
    state.debug.dev = payload.dev;
  },
  setLoader (state, payload) {
    state.loader = payload;
  },
  setResource (state, payload) {
    state.currentSubpage = payload;
  },
  setModel (state, payload) {
    state.currentKeyModel =                 payload.key;
    state.models[state.currentKeyModel] =   payload.model;
  },
  setKeyModel(state, payload) {
    state.currentKeyModel = payload;
  },
  setPopup(state, payload) {
    if(state.popup.template !== null)
      if (state.popup.options.actionAfterClose !== undefined) {
        state.popup.options.actionAfterClose(payload.objectClose);
      }
    state.popup.template = payload.template;
    state.popup.title = payload.title;

    state.popup.data = payload.data ? payload.data : {};
    state.popup.options = payload.options ? payload.options : {};
    if (payload.template) {
      $('#MainModal').css('display', 'block').css('opacity', 1);
      $('body').addClass('modal-open');
    }
    else {
      $('#MainModal').css('display', 'none').css('opacity', 0);
      $('body').removeClass('modal-open');
    }
  },
  setInitFront(state, payload) {
    state.initFront.data = payload;
    state.initFront.init = true;
  },
  setRating(state, payload) {
    state.models[state.currentKeyModel].rating = payload;
  },
  changeValueModel(state, payload) {
    if(_.get(state.models[state.currentKeyModel], payload.path) || payload.forceCreate === true)
      _.set(state.models[state.currentKeyModel], payload.path, payload.value);
  },
  changeValueCurrentSubpage(state, payload) {
    if(_.get(state.models[state.currentKeyModel].subpage, payload.path) || payload.forceCreate === true)
      _.set(state.models[state.currentKeyModel].subpage, payload.path, payload.value);
  },
  setLeftSidebar(state, payload) {
    state.sidebar.left = payload;
  },
  setRightSidebar(state, payload) {
    state.sidebar.right = payload;
  },
  setSearchOpen(state, payload) {
    state.isSearchOpen = payload;
  },
  addFavoriteShop(state, shop) {
    state.favoriteShops.push(shop.subpage);
    localStorage.setItem('favoriteShops', JSON.stringify(state.favoriteShops));
  },
  removeFavoriteShop(state, id) {
    let index = _.findIndex(state.favoriteShops, obj => {
      return obj.id === id
    });
    if (index >= 0) {
      state.favoriteShops.splice(index, 1);
      localStorage.setItem('favoriteShops', JSON.stringify(state.favoriteShops));
    }
  },
  setFavoriteShop(state, shops) {
    state.favoriteShops = shops;
  }
}
