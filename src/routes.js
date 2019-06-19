import Home from './pages/home.vue';
import PanelLeft from './pages/panel-left.vue';
import CommunityList from './pages/com-list.vue';
import CommunityListF7 from './pages/com-list-f7.vue';

// Pages
export default [
    // Index page
    {
      path: '/',
      component: Home,
    },
    // Left Panel
    {
      path: '/panel-left/',
      component: PanelLeft,
    },
    // Vereinsliste
    {
      path: '/com-list/',
      component: CommunityList
    },
    // Vereinsliste F7
    {
      path: '/com-list-f7/',
      component: CommunityListF7
    },
  ];
  