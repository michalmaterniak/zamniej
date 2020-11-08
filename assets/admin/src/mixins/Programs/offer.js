import PopupFilesManager from "../../components/PopUp/PopupFilesManager";

export default
{
  methods:{
    loadPhoto(photo){
      this.openPopup('Załaduj zdjęcie', {
        template: PopupFilesManager,
        data:{
          object: photo,
          afterCallback: this.savePhotoOffer
        },
      })
    },
    savePhotoOffer(path, offer)
    {
      this.ajax({
        url: '/admin/api/offers/loadPhoto/' + offer.idOffer,
        data:{
          path: path
        },
        responseCallbackSuccess: res => {
          this.$set(this.offer, 'photo',  res.data.offer.photo);
          this.showAlert('Zapisano zdjęcie do oferty', 'success');
        }
      })
    },
    removePhotoOffer(offer)
    {
      this.ajax({
        url: '/admin/api/offers/removePhoto/' + offer.idOffer,
        responseCallbackSuccess: res => {
          this.offer.photo = null;
          this.showAlert('Usunięto zdjęcie z oferty', 'success');
        }
      })
    },
  }
}
