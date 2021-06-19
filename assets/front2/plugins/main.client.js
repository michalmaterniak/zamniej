function lazy()
{
  $('.lazy-d-none').addClass('d-none');
  $('.lazy-d-xs-none').addClass('d-xs-none');
  $('.lazy-d-lg-none').addClass('d-lg-none');
  $('.lazy-d-xl-none').addClass('d-xl-none');
  $('.lazy-d-xxl-none').addClass('d-xxl-none');
  $('.lazy-d-md-none').addClass('d-md-none');
  $('.lazy-d-sm-none').addClass('d-sm-none');
}
// window.addEventListener('load', lazy);

function eachMounted() {
  window.addEventListener('scroll', function handler() {
    lazy();
    this.removeEventListener('scroll', handler);
  });

  $(".bg-top").parent().addClass('b-top');
  $(".bg-bottom").parent().addClass('b-bottom');
  $(".bg-center").parent().addClass('b-center');
  $(".bg_size_content").parent().addClass('b_size_content');
  $(".bg-img").parent().addClass('bg-size');
  $(".bg-img.blur-up").parent().addClass('blur-up lazyload');

  jQuery('.bg-img').each(function () {
    var el = $(this),
      src = el.attr('src'),
      parent = el.parent();

    parent.css({
      'background-image': 'url(' + src + ')',
      'background-size': 'cover',
      'background-position': 'center',
      'display': 'block'
    });

    el.hide();
  });
}

export default (context, inject) => {
  inject('lazyHide', lazy)
  context.$lazyHide = lazy;

  inject('eachMounted', eachMounted)
  context.$eachMounted = eachMounted;
}
