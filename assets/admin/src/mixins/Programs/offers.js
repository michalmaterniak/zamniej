import PopupFilesManager from "../../components/PopUp/PopupFilesManager";
import PopupSlidersSearch from "../../components/PopUp/PopupSlidersSearch";
import offer from "./offer";

export default {
  mixins: [offer],
  data()
  {
    return {
      countAll: null,
      offers:[],
      pagination: {
        page: 1,
        countAll: 0,
        maxResult: 50
      }
    }
  },
  computed:{
    fragmentUrl()
    {
      return '?page=' + this.pagination.page
    },
  },
  methods:{

    changePage(page)
    {
      this.pagination.page = page;
      this.setOffers();
    },

    addToSlider(offer)
    {
      this.openPopup('Szukaj sliderów',{
        template: PopupSlidersSearch,
        data:{
          offer: offer
        },
        styleDialog: {'max-width': '100%'}
      });
    }
  }


}
