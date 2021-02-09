import PopUpCreateSubpage from "../../components/PopUp/Programs/PopUpCreateSubpage";
import PopUpSearchSubpages from "../../components/PopUp/Programs/PopUpSearchSubpages";

export default {
  methods:{

    trash()
    {
      this.ajax({
        url: '/admin/api/affiliations/program/trash/' + this.program.idShop,
        responseCallbackSuccess: res => {
          this.program = res.data.program;
        }
      })
    },
    createSubpagePopUp(){
      this.openPopup('Twórz stronę sklepu', {
        template: PopUpCreateSubpage,
        classDialog: 'maxWidth75',
        data: {
          name: this.program.name,
          create: idCategory => {
            this.createSubpage(idCategory);
          }
        }
      })
    },
    createSubpage(idCategory)
    {
      this.ajax({
        url: '/admin/api/affiliations/program/createShopSubpage/' + idCategory + '/' + this.program.idShop,
        responseCallbackSuccess: res => {
          this.program = res.data.program;
          this.showAlert('Utworzono podstronę programu afiliacyjnego!', 'success');
        }
      })
    },
    searchSubpage(){
      this.openPopup('Wyszukiwanie stron', {
        template: PopUpSearchSubpages,
        classDialog: 'maxWidth75',
        data: {
          name: this.program.name,
          tie: id => {
            this.tieProgramWithSubpage(id);
          }
        }
      })
    },
    tieProgramWithSubpage(idSubpage)
    {
      this.ajax({
        url: '/admin/api/affiliations/program/tie/' + this.program.idShop,
        data:{
          idSubpage: idSubpage,
        },
        responseCallbackSuccess: res => {
          this.showAlert('Powiązano program ze stroną', 'success');
          this.program = res.data.program;
        }
      })
    },
  }
}
