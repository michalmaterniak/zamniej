export default {
  methods:{
    getIndexPhoto(photos, group)
    {
      for(let elem in photos) {
        if(photos[elem].group === group)
          return elem;
      }


      return null;
    }
  }
}
