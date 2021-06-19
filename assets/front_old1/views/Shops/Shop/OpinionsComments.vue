<template>
  <div class="opinions-area marT20">
    <div class="row ">
      <h3 class="h3 marT10 marB20 capital"><strong>Opinie i komentarze</strong></h3>

      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12   padR30 padL30" v-for="(opinion, index) in opinions" :key="index">
        <div class="dialogbox">
          <div class="body">
            <span class="tip tip-left"></span>
            <div class="message">
              <div class="row">
                <div class="col-md-12">
                  <span class="marR10 orange" v-text="opinion.name"></span>
                  <font-awesome-icon icon="calendar"/> <span v-text="$moment(opinion.datetimeCreate).format('ll')"></span>
                </div>
                <div class="col-md-12">
                  <rating-shop-showing-rate :rating="opinion.rating"/>
                </div>
              </div>
              <div class="row marT20">
                <div class="col-md-12">
                  <div class="content" v-text="opinion.comment"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</template>

<script>
import RatingShop from "@/components/Elements/Rating/RatingShop";
import RatingShopShowingRate from "@/components/Elements/Rating/RatingShopShowingRate";
export default {
  name: "OpinionsComments",
  components: {RatingShopShowingRate, RatingShop},
  computed:{
    opinions()
    {
      return this.$store.getters.model.subpage.opinions;
    }
  }
}
</script>

<style scoped>

.comment
{
  width: 100%;

}
.tip {
  width: 0px;
  height: 0px;
  position: absolute;
  background: transparent;
  border: 10px solid #ccc;
}

.tip-up {
  top: -25px; /* Same as body margin top + border */
  left: 10px;
  border-right-color: transparent;
  border-left-color: transparent;
  border-top-color: transparent;
}

.tip-down {
  bottom: -25px;
  left: 10px;
  border-right-color: transparent;
  border-left-color: transparent;
  border-bottom-color: transparent;
}

.tip-left {
  top: 10px;
  left: -25px;
  border-top-color: transparent;
  border-left-color: transparent;
  border-bottom-color: transparent;
}

.tip-right {
  top: 10px;
  right: -25px;
  border-top-color: transparent;
  border-right-color: transparent;
  border-bottom-color: transparent;
}

.dialogbox .body {
  position: relative;
  height: auto;
  margin: 20px 10px;
  padding: 5px;
  background-color: #eeecec;
  border-radius: 15px;
  border: 5px solid #e0e0e0;
}

.body .message {
  min-height: 30px;
  border-radius: 15px;
  font-size: 14px;
  line-height: 1.5;
  color: #797979;
}
</style>
