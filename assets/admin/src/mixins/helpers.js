import TextComponent from "../components/FormFieldsComponents/TextComponent/TextComponent";
import TextareaComponent from "../components/FormFieldsComponents/TextComponent/TextareaComponent";
import WysiwygComponent from "../components/FormFieldsComponents/TextComponent/WysiwygComponent";
import MiniWysiwygComponent from "../components/FormFieldsComponents/TextComponent/MiniWysiwygComponent";
import UploadComponent from "../components/FormFieldsComponents/UploadComponent/UploadComponent";
import ArrayComponent from "../components/FormFieldsComponents/ArrayComponent/ArrayComponent";
import NumericComponent from "../components/FormFieldsComponents/TextComponent/NumericComponent";
import PopUpImage from "../components/PopUp/PopUpImage";
import toastr from "toastr";
import PhotoComponent from "../components/FormFieldsComponents/UploadComponent/PhotoComponent";
import LineSeparationComponent from "../components/FormFieldsComponents/SeparationsComponent/LineSeparationComponent";
import NameGroupComponent from "../components/FormFieldsComponents/SeparationsComponent/NameGroupComponent";
import ShopSubpageOffers from "../components/Page/Subpage/ShopSubpage/ShopSubpageOffers";
import ShopBasicShopTags from "../components/Page/Basic/Shop/ShopBasicShopTags";

export default {
	data() {
		return {
			rootLink: '/admin/',
      formFieldsComponents: {
        'text': TextComponent,
        'textarea': TextareaComponent,
        'wysiwyg': WysiwygComponent,
        'mini-wysiwyg': MiniWysiwygComponent,
        'upload': UploadComponent,
        'photo': PhotoComponent,
        'array' : ArrayComponent,
        'lineseparation' : LineSeparationComponent,
        'namegroup' : NameGroupComponent,
        'numeric': NumericComponent,
        'shop-offers': ShopSubpageOffers,
        'shop-tags': ShopBasicShopTags,
      },
		}
	},
  computed:{
	  baseUrl()
    {
      return process.env.NODE_ENV === 'development' ? 'http://zamniej.loc' : '';
    },
    isAuth() {
      return this.$store.getters.isAuth;
    },
    currentUserFullname() {
      return this.currentUser.firstName + ' ' + this.currentUser.lastName;
    },
    currentUser() {
      return this.$store.getters.user;
    },
    getToken() {
      return this.$store.getters.token;
    },
    getTokenDateExpired() {
      return this.getToken.datetimeExpired;
    }
  },
	methods: {
    logout() {
      this.ajax({
        url: '/admin/api/auth/logout',
        method: 'post',
        responseCallbackSuccess: (res) => {
          this.setToken('');
          this.$router.push({name: 'auth-login'});
        },
        responseCallbackError: () => {
          this.showAlert("Nieprawidłowe dane logowania", 'error');
        }
      });

    },
    setConfig(config)
    {
      this.$store.commit('setConfig', config);
    },
    login() {
      this.ajax({
        url: '/admin/api/login_check',
        method: 'post',
        data: {
          username: this.email,
          password: this.password,
        },
        responseCallbackSuccess: (res) => {
          this.setToken(res.data.token);
          this.checkAuth();
        },
        responseCallbackError: () => {
          this.showAlert("Nieprawidłowe dane logowania", 'error');
        }
      });
    },
    setUser(user) {
      this.$store.commit('setUser', user);
      localStorage.setItem('user', JSON.stringify(user));
    },
    setToken(token) {
      this.$store.commit('setToken', token);
      localStorage.setItem('token', token);
    },
    setAuth(auth) {
      this.$store.commit('setAuth', auth);
    },
    checkAuth() {
      this.$http.defaults.headers = {
        'Content-Type': 'application/json',
        'Authorization': 'Bearer ' + this.getToken,
        'X-Requested-With': 'XMLHttpRequest'
      };
      this.ajax({
        url: '/admin/api/auth/check',
        method: 'post',
        responseCallbackSuccess: res =>
        {
          this.setUser(res.data.user);
          this.setConfig(res.data.config);
          this.setAuth(true);
          this.showAlert('Użytkownik zalogowany', 'success');
          let routerNext = this.$router.currentRoute.params.routerNext;
          this.$router.push(routerNext ? routerNext : {name: 'panel'})
        },
        responseCallbackError: res =>
        {
          this.logout();
          this.setToken('');
          if (this.$router.currentRoute.name !== 'auth-login')
            this.$router.push({name: 'auth-login'})
        }
      });
    },
		setLoading(value) {
			this.$store.commit('setLoading', value);
		},
    openPopupImageUrl(url)
    {
      this.openPopup('Zdjęcie', {
        template: PopUpImage,
        data:{
          src: url
        },
        styleDialog: {'max-width': 'max-content'}

      })
    },
    openPopupImage(photo)
    {
      this.openPopup('Zdjęcie', {
        template: PopUpImage,
        data:{
          src: photo.src
        },
        styleDialog: {'max-width': 'max-content'}

      })
    },
    loadImageUrl(url, object)
    {
      let image = new Image();
      image.src = url;
      image.onload = (ev) => {
        this.$set(object, 'src', image.src)
        this.$set(object, 'width', image.naturalWidth)
        this.$set(object, 'height', image.naturalHeight)
      }
      return object;
    },

    loadImage(photo) {
      let image = new Image();
      image.src = this.baseUrl + photo.path;
      image.onload = (ev) => {
        this.$set(photo, 'src', image.src)
        this.$set(photo, 'width', image.naturalWidth)
        this.$set(photo, 'height', image.naturalHeight)
      }
      return photo;
    },
    openPopup(title = 'title', options = {}) {
      this.$store.commit('setPopupData', {
        title: title,
        options: Object.assign({}, this.$store.getters.getPopupDefaultOptions, options)
      });
      $('#MainModal').modal('show');
    },
    closePopup() {
      $('#MainModal').modal('hide');
      this.$store.commit('setPopupData', {title: '', options: null});
    },
    showErrorsValidate(message, errors)
    {
      this.showAlert(message, 'danger');
      errors.violations.forEach(obj => {
        this.showAlert(obj.title, 'error');
      })
    },
    showAlert(message, type = 'info', description = null, options = {}) {

      switch (type) {
        case "error":
          toastr.error(description, message, options);
          break;
        case "danger":
          toastr.error(description, message, options);
          break;
        case "info":
          toastr.info(description, message, options);
          break;
        case "success":
          toastr.success(description, message, options);
          break;
        case "warning":
          toastr.warning(description, message, options);
          break;
        default:
          toastr.info(description, message, options);
          break;
      }
    },
    ajax(obj) {
      this.setLoading(true);
      if (obj.method === undefined)
        obj.method = 'post';
      if (obj.data === undefined)
        obj.data = {};
      if (obj.headers === undefined)
        obj.headers = {};
      if (obj.notSetLoading === undefined || obj.notSetLoading === false)
        this.setLoading(true);

      this.$http({
        method: obj.method,
        url: obj.url,
        headers: obj.headers,
        responseType: 'json',
        data: obj.data,
      })
        .then((res) => {
          if (res.status === 200) {
            if(res.data.success === true && res.data.message)
              this.showAlert(res.data.message, 'success')

            if (obj.responseCallbackSuccess !== undefined)
              obj.responseCallbackSuccess(res);
          }
          else if(res.status === 401)
          {
            this.$router.push({name: 'auth-login'});
          }
          else {
            if (obj.responseCallbackError !== undefined)
              obj.responseCallbackError(res);
            else if (res.data && res.data.message !== undefined) {
              this.showAlert('Błąd serwera', 'error', res.data.message);
            }
          }
          if (obj.alwaysCallbackResponse !== undefined)
            obj.alwaysCallbackResponse(res);

          this.setLoading(false);
        })
    },
    showDatetimeText(date, defaultEmpty = '')
    {
      if(date == null)
      {
        return defaultEmpty;
      }
      if(typeof date === 'string')
      {
        date = new Date(date);
      }
      return ((date.getDate() < 10) ? ('0' + date.getDate()) : date.getDate()) + '.' + (date.getMonth()+1) + '.' + date.getFullYear() + ' ' + date.getHours() + ':' + date.getMinutes() + ':' + date.getSeconds();

    },
    showDateText(date, defaultEmpty = '')
    {
      if(date == null)
      {
        return defaultEmpty;
      }
      if(typeof date === 'string')
      {
        date = new Date(date);
      }
      return ((date.getDate() < 10) ? ('0' + date.getDate()) : date.getDate()) + '.' + (date.getMonth()+1) + '.' + date.getFullYear();
    }
	},
  created() {
    toastr.options = {
      "closeButton": true,
      "debug": false,
      "newestOnTop": false,
      "progressBar": false,
      "positionClass": "toast-bottom-right move-toastr-10",
      "preventDuplicates": false,
      "onclick": null,
      "showDuration": "300",
      "hideDuration": "1000",
      "timeOut": "7000",
      "extendedTimeOut": "7000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    };
  }
}
