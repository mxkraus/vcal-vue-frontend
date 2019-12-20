<template>
  <f7-page color-theme="orange">
    
    <f7-navbar :sliding="false">

      <f7-nav-left>
        <f7-link panel-open="left" icon-ios="f7:menu" icon-aurora="f7:menu" icon-md="material:menu"></f7-link>
      </f7-nav-left>

      <f7-nav-title sliding>
        Vereinskalender
      </f7-nav-title> 

      <f7-nav-right>
        <!-- <f7-link class="searchbar-enable" data-searchbar=".searchbar-components" icon-ios="f7:search" icon-aurora="f7:search" icon-md="material:search"></f7-link> -->
      </f7-nav-right>

    </f7-navbar>

    <CommunityList></CommunityList>

  </f7-page>
</template>
<script>

/* eslint-disable */

  import { f7Page, f7Card, f7Navbar, f7NavLeft, f7NavTitle, f7NavTitleLarge, f7NavRight, f7BlockTitle, f7List, f7ListItem, f7Link, f7Searchbar, f7Icon } from 'framework7-vue';
  import CommunityList from '../components/community-list';

  export default {
    components: {
      f7Page,
      f7Navbar,
      f7NavLeft,
      f7NavTitle,
      f7NavTitleLarge,
      f7NavRight,
      f7BlockTitle,
      f7List,
      f7ListItem,
      f7Link,
      f7Searchbar,
      f7Icon,
      f7Card,
      CommunityList,
    },
  };
</script>




