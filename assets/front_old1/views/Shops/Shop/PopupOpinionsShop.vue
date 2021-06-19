<template>
  <div class="modal-content" id="main-modal" style="height: 85%">
    <div class="modal-header">
      <h5 class="modal-title" id="mainModalLabel" v-text="title"></h5>
      <button type="button" class="close" aria-label="Close" @click="closePopup">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">

      <div class="row">
        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
          <div class="comments-form">
            <form method="post" action="">
              <div class="col-md-12 col-sm-12 col-xs-12 marB30">
                <h3 class="h3"><strong>twoja opinia</strong></h3>
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 marB30">
                <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="stars text-center rating-box pointer" @mouseleave="valueMouse = null">
                      <ul class="stars" :class="{'stars-disabled' : disabled}">
                        <template v-for="i in 5">
                          <li v-if="i <= roundRating"  @mouseenter="setValueMouse(i)"  @click="setSelectedRating(i)" >
                            <font-awesome-icon icon="star"/>
                          </li>
                          <li v-else-if="i > roundRating && i < roundRating+1" @click="setSelectedRating(i)"  @mouseenter="setValueMouse(i)" >
                            <font-awesome-icon icon="star-half-alt"/>
                          </li>
                          <li class="grey-a" v-else @click="setSelectedRating(i)"  @mouseenter="setValueMouse(i)" >
                            <font-awesome-icon icon="star"/>
                          </li>
                        </template>

                        <!--                <li>-->
                        <!--                  <h5>Ważny przez: <span class="red" v-text="slider.expired"></span></h5>-->
                        <!--                </li>-->
                      </ul>
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                    Zaznaczona ocena: <span v-text="opinion.rating.value"></span>
                    <!--          <button class="btn btn-link" @click="addRating">Dodaj opinie bez komentarza</button>-->

                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center" v-if="validateTextRating">
                    <span class="red" v-text="validateTextRating"></span>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-sm-6 col-xs-12 marB30">
                <input class="editor-content form-control" type="text" id="name" min="3" name="name" v-model="opinion.name.value" placeholder="Imię*"  :disabled="disabled" @input="changeName()">
                <span class="small red" v-if="opinion.name.value.length > 0 && !opinion.validate('name')" >*Minimalna ilość znaków: {{ opinion.name.min }}, Maksymalna: {{ opinion.name.max }} znaków</span>
                <span class="small red" v-if="showRequirements">Imię jest wymagane</span>
              </div>
              <div class="col-md-12 col-sm-12 col-xs-12 marB30">


<!--                <editor-text-comment :content="opinion.comment.value" @setContentComment="setContentComment"/>-->

                    <textarea class="editor-content form-control" placeholder="Wpisz swój komentarz" rows="5" v-model="opinion.comment.value" :disabled="disabled"></textarea>

                <span class="small red" v-if="opinion.comment.value.length > 0 && !opinion.validate('comment')" >*Minimalna ilość znaków: {{ opinion.comment.min }}, Maksymalna: {{ opinion.comment.max }} znaków</span>
              </div>
              <div class="col-md-12 col-sm-12 col-xs-12 marB30">
                <span :class="{red : !responseValidation.success, green: responseValidation.success}" v-if="responseValidation.success" v-text="responseValidation.value"></span>
              </div>
              <div class="col-md-12 col-sm-12 col-xs-12 text-right">
                <button type="submit" class="itg-btn cart-btn" @click.prevent="addComment">Dodaj opinię</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <div class="row">
        <div class="col-md-4 text-left">
          <button class="bt btn-link" @click="showingComments = !showingComments">
            <span v-if="showingComments === false">Pokaż komentarze</span>
            <span v-else>Ukryj komentarze</span>
          </button>
        </div>
        <div class="col-md-8 text-right">
          <button class="itg-btn cart-btn" @click="closePopup">Zamknij</button>
        </div>
      </div>
    </div>
    <div class="modal-body" v-show="showingComments === true ">
      <div class="row">
        <div class="col-md-6">
          <opinions-comments v-if="shop.subpage.opinions.length > 0"/>
          <div class="row" v-else>
            <div class="col-md-12">
              <h4 class="h4">Ten sklep nie posiada w tej chwili żadnych opini. Bądź pierwszą osobą</h4>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="modal-footer">

    </div>
  </div>
</template>

<script>

import OpinionsComments from "@/views/Shops/Shop/OpinionsComments";
export default {
  components: {OpinionsComments},
  props: ['title', 'data', 'options'],
  name: "PopupOpinionsShop",
  data(){
    return {
      showingComments: false,
      showRequirements: false,
      valueMouse: null,
      isRated: false,
      responseValidation: {
        success: null,
        text: ''
      },
      sentRating: false,
      disabled: false,
      validateText: '',
      validateTextRating: '',
      opinion: {
        validate: (field) => {
          field = this.opinion[field];
          if(typeof field.validate === "function")
            return field.validate();
          if(!field)
            return false;
          if(!isNaN(field.value))
            return (field.value >= field.min && field.value <= field.max);
          else if(typeof field.value === "string")
            return (field && field.value.length >= field.min && field.value.length <= field.max);
          else
            return false;
        },
        rating:{
          validation: true,
          value: null,
          max: 5,
          min: 1,
        },
        comment:{
          validation: true,
          value: '',
          max: 5000,
          min: 0,
        },
        name:{
          validation: true,
          value: '',
          max: 50,
          min: 3,
        }
      }
    }
  },
  computed:{

    shop(){
      return this.$store.getters.model;
    },
    rating()
    {
      return this.shop.subpage.rating;
    },
    roundRating() {
      if(this.valueMouse && !this.sentRating)
        return this.valueMouse;

      return this.opinion.rating.value;
    },

  },
  methods: {
    setContentComment(payload)
    {
      this.opinion.comment.value = payload;
    },
    changeName()
    {
      this.showRequirements = false;
    },
    validateOpinion()
    {
      if(this.disabled)
        return false;
      for(let item in this.opinion)
      {
        if(typeof this.opinion[item] === "object" && this.opinion[item].validation === true)
        {
          if(this.opinion.validate(item) === false)
            return false;
        }
      }
      return true;
    },
    validateRating()
    {
      return this.opinion.validate('rating');
    },
    addComment(ev)
    {

      if(this.validateOpinion() && !this.isRated)
      {
        this.$axios({
          method: "POST",
          url: 'page/api/shops/opinions/comment/' + this.shop.subpage.subpage.idSubpage,
          responseType: 'json',
          data: {
            comment:{
              comment: this.opinion.comment.value,
              name: this.opinion.name.value,
              rating: Number(this.opinion.rating.value)
            }
          },
        }).then(res => {
          if(res.data.message)
            this.responseValidation.value = res.data.message;
          this.responseValidation.success = true;
          this.disabled = true;
          this.options.afterRating();
          if(!this.opinion.comment.value)
          {
            this.$store.commit('changeValueCurrentSubpage', {
              forceCreate: true,
              path: 'opinions['+ this.$store.getters.model.subpage.comments.length +']',
              value: res.data.comment
            })
          }
          this.$store.commit('changeValueModel', {
            path: 'rating',
            value: res.data.rating
          });
          setTimeout(() => {
            this.closePopup();
          }, 2000);
        })
        .catch(res => {
          this.responseValidation.success = false;
        })
      }
      else
        this.showRequirements = true;
    },
    addRating()
    {
      this.$axios({
        method: "POST",
        url: 'page/api/shops/opinions/rating/' + this.shop.modelEntity.idResource,
        responseType: 'json',
        data: {
          rating: Number(this.opinion.rating.value)
        },
      }).then(res => {
        if(res.data.message)
          this.responseValidation.value = res.data.message;
        this.responseValidation.success = true;
        this.disabled = true;
        this.options.afterRating();

        this.$store.commit('changeValueModel', {
          path: 'rating',
          value: res.data.rating
        });

        this.closePopup();
      })
        .catch(res => {
          this.responseValidation.success = false;
        })
    },
    setValueMouse(i) {
      if(!this.disabled)
        this.valueMouse = i;
    },
    setSelectedRating(i) {
      if(!this.disabled)
        this.opinion.rating.value = i;
    },
    closePopup() {
      this.$store.commit('setPopup', {title: '', options: null, template: null, data: {}});
    },
  },
  created() {
    this.opinion.rating.value = this.data.selectedStar;
  },

}
</script>

<style scoped>
ul.stars
{
  height: 70px;
}
ul.stars li {
  cursor: pointer;
  font-size: 30px;
  margin-right: 20px;
  height: 50px;
}
ul.stars li:hover {
  font-size: 40px;
  height: 50px;
}

ul.stars.stars-disabled li:hover{
  font-size: 30px;
}
.cart-btn
{
  border: #f57f25 solid;
}
.cart-btn:hover
{
  background-color: #fff;
  color: #000;
}
</style>

