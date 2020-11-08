
import Auth from "../views/Auth";
import Login from "../views/Auth/Login";
import Panel from "../views/Panel";
import auth from "../middleware/auth";
import Logout from "../views/Auth/Logout";
import Global from "../views/Panel/Settings/Global";
import Settings from "../views/Panel/Settings";
import Pages from "../views/Panel/Pages";
import PagesList from "../views/Panel/Pages/List";
import Page from "../views/Panel/Pages/Page";
import PagesSettings from "../views/Panel/Pages/Settings";
import Sliders from "../views/Panel/Sliders";
import Slider from "../views/Panel/Sliders/Slider";
import SlidersList from "../views/Panel/Sliders/SlidersList";
import Offers from "../views/Panel/Offers";
import Listing from "../views/Panel/Offers/Listing";
import Offer from "../views/Panel/Offers/Offer";
import Links from "../views/Panel/Links";
import Popular from "../views/Panel/Links/Popular";
import ListingPages from "../views/Panel/Pages/List/Listing";
import Search from "../views/Panel/Pages/List/Search";
import Webepartners from "../views/Panel/Affiliations/Webepartners";
import ProgramsWebepartners from "../views/Panel/Affiliations/Webepartners/ProgramsWebepartners";
import ProgramsWebepartnersNew from "../views/Panel/Affiliations/Webepartners/Programs/ProgramsWebepartnersNew";
import ProgramsWebepartnersActive from "../views/Panel/Affiliations/Webepartners/Programs/ProgramsWebepartnersActive";
import ProgramsWebepartnersUnactive from "../views/Panel/Affiliations/Webepartners/Programs/ProgramsWebepartnersUnactive";
import ProgramWebepartners from "../views/Panel/Affiliations/Webepartners/ProgramWebepartners";

export default [
  {
    name: "homepage",
    path: '/',
    meta: {
      middleware: [auth],
    },
    redirect: {
      name: 'panel'
    }
  },
  {
    name: "auth",
    path: "/auth",
    redirect: {
      name: 'auth-login'
    },
    component: Auth,
    children: [
      {
        name: "auth-login",
        path: "login",
        component: Login,
        meta: {
          title: 'Logowanie'
        }
      },
      {
        name: "auth-logout",
        path: "logout",
        component: Logout,
        meta: {
          title: 'Wylogowanie'
        }
      }
    ]
  },
  {
    name: 'panel',
    path: '/panel',
    component: Panel,
    meta: {
      middleware: [auth],
    },
    children: [
      {
        name: 'panel-links',
        path: 'links',
        component: Links,
        meta: {
          middleware: [auth],
        },
        children:[
          {
            name: 'panel-links-popular',
            path: 'popular',
            component: Popular,
            meta: {
              middleware: [auth],
            },
          },
        ]
      },
      {
        name: 'panel-sliders',
        path: 'sliders',
        component: Sliders,
        meta: {
          middleware: [auth],
        },
        children:[
          {
            name: 'panel-sliders-slider',
            path: 'slider/:id',
            component: Slider,
            props: true,
            meta: {
              middleware: [auth],
            },
          },
          {
            name: 'panel-sliders-sliders',
            path: 'sliders',
            component: SlidersList,
            props: true,
            meta: {
              middleware: [auth],
            },
          },
        ]
      },
      {
        name: 'panel-affiliations-webepartners',
        path: 'affiliations-webepartners',
        component: Webepartners,
        meta: {
          middleware: [auth],
        },
        redirect: {
          name: 'panel-affiliations-webepartners-programs-new'
        },
        children:[
          {
            name: 'panel-affiliations-webepartners-programs',
            path: 'programs',
            component: ProgramsWebepartners,
            meta: {
              middleware: [auth],
            },
            children:[
              {
                name: 'panel-affiliations-webepartners-programs-new',
                path: 'new',
                component: ProgramsWebepartnersNew,
                meta: {
                  middleware: [auth],
                },
              },
              {
                name: 'panel-affiliations-webepartners-programs-active',
                path: 'active',
                component: ProgramsWebepartnersActive,
                meta: {
                  middleware: [auth],
                },
              },
              {
                name: 'panel-affiliations-webepartners-programs-unactive',
                path: 'unactive',
                component: ProgramsWebepartnersUnactive,
                meta: {
                  middleware: [auth],
                },
              }
            ]
          },
          {
            name: 'panel-affiliations-webepartners-program',
            path: 'program/:id',
            component: ProgramWebepartners,
            props: true,
            meta: {
              middleware: [auth],
            },
          }
        ]
      },
      {
        name: 'panel-settings',
        path: 'settings',
        component: Settings,
        meta: {
          middleware: [auth],
        },
        redirect: {name: 'panel-settings-global'},
        children: [
          {
            name: 'panel-settings-global',
            path: 'global',
            component: Global,
            meta: {
              middleware: [auth],
            },
          }
        ]
      },
      {
        name: 'panel-offers',
        path: 'offers',
        component: Offers,
        meta: {
          middleware: [auth],
        },
        children:[
          {
            name: 'panel-offers-listing',
            path: 'listing',
            component: Listing,
            meta: {
              middleware: [auth],
            },
          },
          {
            name: 'panel-offers-offer',
            path: 'offer/:id',
            props: true,
            component: Offer,
            meta: {
              middleware: [auth],
            },
          },
        ]
      },
      {
        name: 'panel-pages',
        path: 'pages',
        component: Pages,
        meta: {
          middleware: [auth],
        },
        children: [
          {
            name: 'panel-pages-setting',
            path: 'setting',
            component: PagesSettings,
            meta: {
              middleware: [auth],
            },
          },
          {
            name: 'panel-pages-list',
            path: 'pageslist',
            component: PagesList,
            meta: {
              middleware: [auth],
            },
            redirect: {name: 'panel-pages-list-parent'},
            children: [
              {
                name: 'panel-pages-list-parent',
                path: 'pageslist/:parent?',
                component: ListingPages,
                props: true,
                meta: {
                  middleware: [auth],
                },
              },
              {
                name: 'panel-pages-list-search',
                path: 'pageslist-search/:search?',
                component: Search,
                props: true,
                meta: {
                  middleware: [auth],
                },
              },
            ]
          },

          {
            name: 'panel-pages-page',
            path: 'page/:id',
            component: Page,
            props: true,
            meta: {
              middleware: [auth],
            },
          },
        ]
      }
    ]
  }
];
