export default {

  methods:{
    enterMousePagination(callback, ev)
    {
      if (window.addEventListener) // older FF
        window.addEventListener('DOMMouseScroll', callback, false);

      window.onwheel = callback; // modern standard
      window.onmousewheel = document.onmousewheel = callback; // older browsers, IE
      window.ontouchmove  = callback; // mobile
      document.onkeydown  = this.preventDefaultForScrollKeys;
    },
    exitMousePagination(callback, ev)
    {
      if (window.removeEventListener)
        window.removeEventListener('DOMMouseScroll', callback, false);
      window.onmousewheel = document.onmousewheel = null;
      window.onwheel = null;
      window.ontouchmove = null;
      document.onkeydown = null;
    },

    preventDefaultForScrollKeys(e) {

      e = e || window.event;
      if (e.preventDefault)
        e.preventDefault();
      e.returnValue = false;
      },
  }
}
