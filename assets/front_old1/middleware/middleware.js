export default function ({$axios, route, redirect}) {
  if (process.server) {
    //console.log('server');
    if (route.fullPath === '/sklepy') {
      redirect('/sklepy?letter=0')
    }
  } else {

  }
  $axios.defaults.validateStatus = (status) => {
    return true;
  };
}
