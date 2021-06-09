<template>
  <div>
    <component :is="typePage" v-if="typePage && model"/>
  </div>
</template>

<script>
  import PopUpView from "@/components/Popup/PopUpView";
  export default {
    components: {PopUpView},
    watch:{
      $route(to, from)
      {
        this.forceContent();
        this.$fullPathToLowercase();
      }
    },
    computed:{
      model()
      {
        return this.$store.getters.model;
      },
      typePage()
      {
        return () => import('../views/' + this.model.resourceType.replace(/-/g, '/'));
      },
      title()
      {
        if(this.model)
          return this.model.subpage.seo.title;
        return 'zamniej.pl';
      },
      description()
      {
        if(this.model)
          return this.model.subpage.seo.description;
        return '';
      },
    },
    methods:{
      forceContent() {
        if (location.hash && location.hash === '#force-content') {
          localStorage.setItem('forceContent', '1');
        }

        if (Boolean(localStorage.getItem('forceContent')) && !this.$store.getters.model.subpage.content.content) {
          setTimeout(() => {
              this.$axios({
                url: '/page/api/subpage-content/' + this.$store.getters.model.subpage.subpage.idSubpage,
                method: 'POST',
                responseType: 'json'
              }).then(res => {
                this.$store.commit('changeValueCurrentSubpage', {
                  path: 'content.content',
                  value: res.data.content,
                  forceCreate: true
                })
              })
          }, 1000)
        }

      }
    },
    asyncData (context) {
      context.store.commit('setLoader', true);
      let locale =    context.store.getters.currentLocale;
      let slug =      context.route.path.replace(/^\//g, '');


      if(!context.store.getters.checkKeyModel(locale + slug))
      {
        let headers = {};
        if(context.store.getters.isSetInitFront === false)
          headers = {
            "InitFront" : true
          }
        let objRequest = context.route.query;
        objRequest.locale = locale;
        objRequest.slug = slug;
        return context.$axios.post('page/api/main', objRequest,{
            headers
        }).then(res => {

          if(process.env.NODE_ENV === 'development' && res.headers['x-debug-token-link'])
            context.store.commit('setDebug', {
              token: res.headers['x-debug-token'],
              dev: process.env.DEV_HOST
            });


          context.store.commit('setModel', {model: res.data.model, key: locale + slug});
          if(res.data.initFront)
            context.store.commit('setInitFront', res.data.initFront);
          if(res.status === 404 && res.data.model === undefined)
          {
            context.error({ statusCode: 404, message: res.data.message ? res.data.message : 'Nie znaleziono podstorny' })
          }
          else if(res.status === 404 && res.data.model !== undefined)
          {
            context.layout = 'default';
            context.error({
              statusCode: 404,
              message: res.data.message ? res.data.message : 'Nie znaleziono podstorny',
              model: res.data.model
            })
          }
          else if(res.status >= 500)
          {
            context.error({ statusCode: res.status, message: "Błąd serwera" })
          }

        }).catch(e => {
        }).finally(() => {
          context.store.commit('setLoader', false);
        })

      }
      else
      {
        context.store.commit('setKeyModel', locale + slug);
        setTimeout(() => {
          context.store.commit('setLoader', false);
        }, 300);
      }
    },
    created() {
      this.$fullPathToLowercase();
    },
    mounted() {
      this.forceContent();
      setTimeout(() => {
        this.checkPopupPromo();
      }, 300);
    },
    head () {
      return {
        title: this.title,
        meta: [
          { hid: 'description', name: 'description', content: this.description }
        ],
      }
    },
  }
</script>

<style>

</style>
