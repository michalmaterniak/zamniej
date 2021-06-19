export default function (to, from, savedPosition) {
  if(to.params.scroll === false)
    return {};
  else if(to.params.scrollSlowly === true)
  {
    $('html,body').animate({ scrollTop: 0 }, 'slow');
    return {};
  }
  else
    return { x: 0, y: 0 }
}
