<template>
  <div class="categoriess" v-if="links">
    <div class="categorie-section">
      <h5 @click="changeShow" :class="{pointer: canHide}">kategorie <i class="fa fa-bars" aria-hidden="true"></i></h5>
    </div>
    <ul class="nav navbar-nav vertical-menu" v-show="isShow">
      <li v-for="(category, index) in links.categories" :key="index">
        <nuxt-link :to="{path: category.link}" exact-active-class="active" v-text="category.name"></nuxt-link>
      </li>
      <li id="category-link">
        <nuxt-link :to="{path: links.category.link}" exact-active-class="active" ><span v-text="links.category.name"></span> <i class="flaticon-external-link-symbol"></i></nuxt-link>
      </li>
    </ul>
    <!-- navbar-collapse -->
  </div>
</template>

<script>
export default {
  name: "Categories",
  props:{
    show:{
      type:Boolean,
      default: false
    },
    canHide:{
      type:Boolean,
      default: true
    }
  },
  data(){
    return {
      click:false,
      categories:[
        {
          name: 'Biżuteria i zegarki',
          path: '/kategorie/bizuteria-i-zegarki'
        },
        {
          name: 'Dla dziecka',
          path: '/kategorie/dla-dziecka-parenting'
        },
        {
          name: 'Dom i ogród',
          path: '/kategorie/dom-i-ogrod'
        },
        {
          name: 'Elektronika',
          path: '/kategorie/elektronika'
        },
        {
          name: 'Zdrowie i uroda',
          path: '/kategorie/zdrowie-i-uroda'
        },
        {
          name: 'Zwierzęta',
          path: '/kategorie/zwierzeta'
        }
      ]
    }
  },
  methods:{
    changeShow()
    {
      if(this.canHide)
        this.click = !this.click;
    }
  },
  computed:{
    links()
    {
      return this.$store.getters.initFront.data.links.categories;
    },
    isShow(){
      return this.click;
    }
  },
  created()
  {
    this.click = this.show;
  }
}
</script>

<style scoped>
#category-link{
  background-color: #f57f25;
}
#category-link > a{
  color: #fff;
}
.categorie-section > h5{
  font-weight: bold;
}
</style>
