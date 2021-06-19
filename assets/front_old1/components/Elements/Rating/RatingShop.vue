<template>
  <div>
      <rating-shop-showing class="rating-shop-showing" v-if="isRated" :rating="rating"/>
      <div class="stars text-center rating-box pointer" @mouseenter="starsBig" @mouseleave="starsSmall" @touchmove="setValueMouseTouch" v-else>

        <ul v-if="!responseText" class="stars">
          <template v-for="i in 5">
            <li v-if="i <= roundRating" >
              <font-awesome-icon icon="star" :data-star="i" @mouseenter="setValueMouse(i)"  @click="openPopupRating($event, i)"/>
            </li>
            <li v-else-if="i > roundRating && i < roundRating+1" >
              <font-awesome-icon icon="star-half-alt" :data-star="i" @mouseenter="setValueMouse(i)" @click="openPopupRating($event, i)"/>
            </li>
            <li class="grey-a" v-else >
              <font-awesome-icon icon="star" :data-star="i" @mouseenter="setValueMouse(i)" @click="openPopupRating($event, i)"/>
            </li>
          </template>
          <li>
            <h5 class="capital">(<span v-text="rating.count"></span>)</h5>
          </li>
        </ul>
        <div v-else class="">
          <span class="green" v-text="responseText"></span>
        </div>
        <div class="mar20">
          <button class="btn btn-link" @click="openPopupRating($event, 5)"> Dodaj swoją opinie</button>
        </div>

      </div>
  </div>

</template>

<script>
import RatingShopShowing from "@/components/Elements/Rating/RatingShopShowing";

export default {
  name: "RatingShop",
  components: {RatingShopShowing},
  props: {
    shop: {
      type: Object,
    },

  },
  data() {
    return {
      valueMouse: null,
      isRated: false,
      responseText: null,
    }
  },
  methods:
    {
      setValueMouseTouch(ev)
      {
        var myLocation = ev.touches[0];
        var realTarget = document.elementFromPoint(myLocation.clientX, myLocation.clientY);
        if(realTarget.parentNode && realTarget.parentNode.hasAttribute('data-star'))
        {
          this.valueMouse = Number(realTarget.parentNode.getAttribute('data-star'));
        }
      },
      setValueMouse(i) {
        this.valueMouse = i;
      },
      starsBig(ev) {
        ev.target.classList.add('stars-big');
      },
      starsSmall(ev) {
        ev.target.classList.remove('stars-big');
        this.valueMouse = null;
      },
      idResource()
      {
        return this.shop.modelEntity.idResource;
      },
      openPopupRating(ev, star)
      {
        // console.log(star);
        // if(ev.type === 'touchend' && ev.target.parentNode && ev.target.parentNode.hasAttribute('data-star'))
        // {
        //   star = Number(ev.target.parentNode.getAttribute('data-star'));
        // }
        // else
        //   return ;
        this.$store.commit('setPopup', {
          template: () => import("@/views/Shops/Shop/PopupOpinionsShop"),
          title: 'Dodaj opinie!',
          options: {
            blockExit: false,
            afterRating: () => {
              this.isRated = true;
            },
          },
          data:{
            shop: this.shop,
            selectedStar: star ? star : 5,
          }
        })
      }
    },
  computed: {
    rating()
    {
      return this.shop.rating;
    },
    roundRating() {
      if (this.valueMouse !== null)
        return this.valueMouse;

      return Math.round(this.rating.rating * 2) / 2
    },
  },
}
</script>

<style scoped>
div.stars.stars-big > ul > li {
  cursor: pointer;
  font-size: 24px;
}

</style>
