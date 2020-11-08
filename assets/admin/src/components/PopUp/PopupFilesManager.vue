<template>
    <div class="modal-content big-frame">
        <div class="modal-header">
            <h5 class="modal-title" id="mainModalLabel" v-text="title"></h5>
            <button type="button" class="close" aria-label="Close" @click="closePopup">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
<!--          <script data-main="/admin/elfinder.main.js" src=""></script>-->
          <div id="elfinder"></div>
        </div>
        <div class="modal-footer">
<!--            <button type="button" class="btn" :class="buttonClass" @click="action" v-text="buttonClose"></button>-->
        </div>
    </div>
</template>

<script>
	export default {
		props: ['title', 'data'],
		name: "PopupText",
    data(){
		  return {
		    filepath: ''
      }
    },
		computed: {
			buttonClose() {
				return (this.data.buttonClose === undefined) ? 'Anuluj' : this.data.buttonClose;
			},
			buttonClass() {
				return (this.data.buttonClass === undefined) ? 'btn-secondary' : this.data.buttonClass;
			},
      filepathDecoded()
      {
        let path = this.value.folder;
        if (path.charAt(path.length - 1) === "/") path = path.substr(0, path.length - 1);
        return btoa(path.replace(this.rootPath, '')).replace(/\+/g, '-').replace(/\//g, '_').replace(/=/g, '.').replace(/\.+$/, '');
      },
      rootPath()
      {
        return this.$store.getters.config.filePath;
      },
      urlFileManager()
      {
        return this.baseUrl + '/admin/elfinder/form';
      }
		},
    methods: {
      setValue(filename){
        this.filepath = filename;
        this.data.afterCallback(filename, this.data.object);
        this.closePopup();
      },
      openManager()
      {
        window.setValue = this.setValue;
        window.open(this.urlFileManager, "", "width=800,height=400");
      },
      initManager()
      {
        {
          let scriptMain = document.createElement('script');
          scriptMain.setAttribute('data-main', this.baseUrl + '/admin/elfinder.main.js');
          scriptMain.src = '//cdnjs.cloudflare.com/ajax/libs/require.js/2.3.6/require.js';
          document.body.appendChild(scriptMain);

          scriptMain.onload = () => {
            // this.openManager();
            define('elFinderConfig', {
              // elFinder options (REQUIRED)
              // Documentation for client options:
              // https://github.com/Studio-42/elFinder/wiki/Client-configuration-options
              defaultOpts : {
                url : this.baseUrl + '/admin/efconnect/form',
                lang : 'pl',
                onlyMimes: [],
                getFileCallback: file => {
                  this.filepath = file;
                  this.closePopup();
                },
                commandsOptions : {
                  edit : {
                    extraOptions : {
                      // set API key to enable Creative Cloud image editor
                      // see https://console.adobe.io/
                      creativeCloudApiKey : '',
                      // browsing manager URL for CKEditor, TinyMCE
                      // uses self location with the empty value
                      managerUrl : ''
                    }
                  },
                  quicklook : {
                    // to enable CAD-Files and 3D-Models preview with sharecad.org
                    sharecadMimes : ['image/vnd.dwg', 'image/vnd.dxf', 'model/vnd.dwf', 'application/vnd.hp-hpgl', 'application/plt', 'application/step', 'model/iges', 'application/vnd.ms-pki.stl', 'application/sat', 'image/cgm', 'application/x-msmetafile'],
                    // to enable preview with Google Docs Viewer
                    googleDocsMimes : ['application/pdf', 'image/tiff', 'application/vnd.ms-office', 'application/msword', 'application/vnd.ms-word', 'application/vnd.ms-excel', 'application/vnd.ms-powerpoint', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.openxmlformats-officedocument.presentationml.presentation', 'application/postscript', 'application/rtf'],
                    // to enable preview with Microsoft Office Online Viewer
                    // these MIME types override "googleDocsMimes"
                    officeOnlineMimes : ['application/vnd.ms-office', 'application/msword', 'application/vnd.ms-word', 'application/vnd.ms-excel', 'application/vnd.ms-powerpoint', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.openxmlformats-officedocument.presentationml.presentation', 'application/vnd.oasis.opendocument.text', 'application/vnd.oasis.opendocument.spreadsheet', 'application/vnd.oasis.opendocument.presentation']
                  }
                },
                // bootCalback calls at before elFinder boot up
                bootCallback : function(fm, extraObj) {
                  /* any bind functions etc. */
                  fm.bind('init', function() {
                    // any your code
                  });
                  // for example set document.title dynamically.
                  var title = document.title;
                  fm.bind('open', function() {
                    var path = '',
                      cwd  = fm.cwd();
                    if (cwd) {
                      path = fm.path(cwd.hash) || null;
                    }
                    document.title = path? path + ':' + title : title;
                  }).bind('destroy', function() {
                    document.title = title;
                  });
                }
              },
              managers : {
                // 'DOM Element ID': { /* elFinder options of this DOM Element */ }
                'elfinder': {}
              }
            });
          }
        }
      }
    },
    created() {
      this.openManager();
    },
    mounted() {
		  //this.initManager();
      this.closePopup();
    }
  }
</script>

<style scoped>
.big-frame{
  height: 80%;
  width: 150%;
}
</style>

