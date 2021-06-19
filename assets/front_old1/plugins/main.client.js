import Vue from 'vue';
import VueGlide from 'vue-glide-js';

let lazyStoped = false;
function lazy(e) {
  window.addEventListener('scroll', function lazyFun() {
    if (lazyStoped === false) {
      $('.lazy-hidden').addClass('hidden');
      $('.lazy-hidden-xs').addClass('hidden-xs');
      $('.lazy-hidden-lg').addClass('hidden-lg');
      $('.lazy-hidden-md').addClass('hidden-md');
      $('.lazy-hidden-sm').addClass('hidden-sm');
      this.removeEventListener('scroll', lazyFun);
      lazyStoped = true;
    }
  });
}

Vue.use(VueGlide);

export default (context, inject) => {
  inject('lazyHide', lazy)
  context.$lazyHide = lazy;
}
