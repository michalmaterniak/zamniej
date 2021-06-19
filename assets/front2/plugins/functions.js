class Functions {
  constructor(context) {
    this.context = context;
    this.urlParser  = require('url');
  }
  functions(){
    return {
      gtagEv(gtagData) {
        // action - akcja,
        // category - umiejscowienie w serwisie
        // label - umiejscowienie na zakładce
        // value - unikalna wartość
        gtagData.event = gtagData.action;
        this.$gtm.push(gtagData)
      },
      isTouchedEnable() {
        return 'TouchEvent' in window;
      },
      generateHash(object) {
        return '#' + btoa(JSON.stringify(object));
      },
      parseHash() {
        if (this.$router.currentRoute.hash) {
          let hash = this.$router.currentRoute.hash.replace(/^#/g,'');
          try {
            return JSON.parse(atob(hash));
          }
          catch (e)
          {
            return null;
          }

        }
        else
          return null;
      },
      cutTextHidden(content, letters = 100, endShowing = '', contentClass='lazy-hidden'){
        content = this.$stripTags(content);
        if(content.length > letters){
          return content.slice(0, letters) + endShowing + '<div class="'+contentClass+'">' + content.slice(letters, content.length) + '</div>';
        }

        return content;
      },
      cutText(content, letters = 100, endShowing = ''){
        content = this.$stripTags(content);
        if(content.length > letters){
          return content.slice(0, letters) + endShowing;
        }

        return content + endShowing;
      },
      showDateText(date, defaultEmpty = ''){
        if(date == null)
        {
          return defaultEmpty;
        }
        if(typeof date === 'string')
        {
          date = new Date(date);
        }
        return ((date.getDate() < 10) ? ('0' + date.getDate()) : date.getDate()) + '.' + (date.getMonth()+1) + '.' + date.getFullYear();
      },
      showDatetimeText(date, defaultEmpty = ''){
        if(date == null)
        {
          return defaultEmpty;
        }
        if(typeof date === 'string')
        {
          date = new Date(date);
        }
        return ((date.getDate() < 10) ? ('0' + date.getDate()) : date.getDate()) +
          '.' + (((date.getMonth()+1) < 10) ? ('0' + (date.getMonth()+1)) : (date.getMonth()+1)) +
          '.' + date.getFullYear() +  ' ' +
          ((date.getHours() < 10) ? ('0' + date.getHours()) : date.getHours()) +
          ':' + ((date.getMinutes() < 10) ? ('0' + date.getMinutes()) : date.getMinutes()) +
          ':' + ((date.getSeconds() < 10) ? ('0' + date.getSeconds()) : date.getSeconds());
          ;
      },
      stripTags(content){
        return content.replace(/(<([^>]+)>)/gi, "");
      },
      fullPathToLowercase: (router) => {
        if(
          this.urlParser.parse(this.context.route.fullPath).path !==
          this.urlParser.parse(this.context.route.fullPath).path.toLowerCase()
        )
        {
          if(router === undefined)
            this.context.redirect(301, this.context.route.fullPath.toLowerCase());
          else
            router.push({path: this.context.route.fullPath.toLowerCase()})
        }
      },
      getRandomInt(min, max) {
        min = Math.ceil(min);
        max = Math.floor(max);
        return Math.floor(Math.random() * (max - min)) + min;
      }
    }
  }
}

export default (context, inject) => {
  let functions =  (new Functions(context)).functions();
  for(let key in functions)
  {
    inject(key, functions[key]);
  }
  context.$fullPathToLowercase = functions.fullPathToLowercase;
  context.$stripTags = functions.stripTags;
  context.$showDateText = functions.showDateText;
  context.$showDatetimeText = functions.showDatetimeText;
  context.$cutTextHidden = functions.cutTextHidden;
  context.$cutText = functions.cutText;
  context.$parseHash = functions.parseHash;
  context.$generateHash = functions.generateHash;
  context.$isTouchedEnable = functions.isTouchedEnable;
  context.$gtagEv = functions.gtagEv;
  context.$getRandomInt = functions.getRandomInt;
}
