<template>
  <client-only>
    <div class="row">
      <div class="col-md-12">
        <form class="theme-form">
          <div class="form-row">
            <div class="col-md-6">
              <input id="name"
                     class="form-control"
                     placeholder="Wpisz swoje imię"
                     v-model="opinion.name"
                     type="text">
            </div>
            <rating-shop-edit @setRatingComment="setRatingComment"/>
            <div class="col-md-12">
              <textarea id="review"
                        class="form-control"
                        placeholder="Wpisz swój komentarz"
                        rows="6"
                        v-model="opinion.comment"
              >
              </textarea>
            </div>
            <div class="col-md-12" v-if="responseValidation.success">
              <span :class="{'btn-outline-danger' : !responseValidation.success, 'btn-outline-success': responseValidation.success}" v-text="responseValidation.text"></span>
            </div>
            <div class="col-md-12">
              <button class="btn btn-solid" type="submit" @click.prevent="addComment()" :disabled="!validateOpinion">Dodaj opinię</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </client-only>
</template>

<script>
import RatingShopEdit from "@/views/Shops/Shop/CommentAdding/RatingShopEdit";
export default {
  name: 'CommentAdding',
  components: {RatingShopEdit},
  data() {
    return {
      responseValidation: {
        success: null,
        text: ''
      },
      opinion: {
        rating: null,
        comment: '',
        name: ''
      }
    }
  },
  computed: {
    shop() {
      return this.$store.getters.model;
    },
    validateOpinion()
    {
      return this.opinion.rating >= 1 && this.opinion.rating <= 5
        && this.opinion.comment.length > 0 && this.opinion.comment.length < 5000
        && this.opinion.name.length > 0 && this.opinion.name.length <= 50
        ;
    }
  },
  methods: {
    setRatingComment(rating) {
      this.opinion.rating = rating;
    },
    addComment(ev)
    {
      if(this.validateOpinion)
      {
        this.$axios({
          method: "POST",
          url: 'page/api/shops/opinions/comment/' + this.shop.subpage.subpage.idSubpage,
          responseType: 'json',
          data: {
            comment:{
              comment: this.opinion.comment,
              name: this.opinion.name,
              rating: this.opinion.rating
            }
          },
        }).then(res => {
          if(res.data.message)
            this.responseValidation.text = res.data.message;
          this.responseValidation.success = true;
        })
          .catch(res => {
            this.responseValidation.success = false;
          })
      }
      else
        this.showRequirements = true;
    }
  }
}
</script>

<style scoped>

</style>
