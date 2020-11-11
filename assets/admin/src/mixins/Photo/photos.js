export default {
  methods:{
    getIndexPhoto(photos, group)
    {
      for(let elem in photos) {
        console.log(photos[elem].group);
        if(photos[elem].group === group)
          return elem;
      }


      return null;
    }
  }
}
