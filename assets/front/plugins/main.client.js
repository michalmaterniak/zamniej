import Vue from 'vue';
import axios from 'axios';

function lazy(e)
{
  $('.lazy-hidden').addClass('hidden');
  $('.lazy-hidden-xs').addClass('hidden-xs');
  $('.lazy-hidden-lg').addClass('hidden-lg');
  $('.lazy-hidden-md').addClass('hidden-md');
  $('.lazy-hidden-sm').addClass('hidden-sm');
  window.removeEventListener('scroll', e, true);
}
window.addEventListener('scroll', lazy);

import VueGlide from 'vue-glide-js';
Vue.use(VueGlide);


export default (context, inject) => {
  inject('lazyHide', lazy)
  context.$lazyHide = lazy;
}
