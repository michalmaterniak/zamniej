export default function (context) {
  if (process.server) {
    //console.log('server');
  }
  else
  {

  }
  context.$axios.defaults.validateStatus = (status) => {
    return true;
  };
}
