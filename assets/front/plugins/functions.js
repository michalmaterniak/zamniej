class Functions {
  constructor(context) {
    this.context = context;
    this.urlParser  = require('url');
  }
  functions(){
    return {
      isTouchedEnable()
      {
        return 'TouchEvent' in window;
      },
      generateHash(object){
        return '#' + btoa(JSON.stringify(object));
      },
      parseHash(){
        if(this.$router.currentRoute.hash)
        {
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
  context.$cutTextHidden = functions.cutTextHidden;
  context.$cutText = functions.cutText;
  context.$parseHash = functions.parseHash;
  context.$generateHash = functions.generateHash;
  context.$isTouchedEnable = functions.isTouchedEnable;
}
