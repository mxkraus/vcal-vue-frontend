<template>
  <f7-page>
    <f7-navbar large :sliding="false">

      <f7-nav-left>
        <f7-link panel-open="left" icon-ios="f7:menu" icon-aurora="f7:menu" icon-md="material:menu"></f7-link>
      </f7-nav-left>

      <f7-nav-title-large>Vereinskalender</f7-nav-title-large>
      
      <f7-nav-right>
        <f7-link class="searchbar-enable" data-searchbar=".searchbar-components" icon-ios="f7:search" icon-aurora="f7:search" icon-md="material:search"></f7-link>
      </f7-nav-right>

      <f7-searchbar 
        class="searchbar-components"
        search-container=".components-list"
        search-in="a"
        expandable
        :disable-button="!this.$theme.aurora"
      ></f7-searchbar>

    </f7-navbar>


  </f7-page>
</template>
<script>

/* eslint-disable */

  import { f7Page, f7Navbar, f7NavLeft, f7NavTitle, f7NavTitleLarge, f7NavRight, f7BlockTitle, f7List, f7ListItem, f7Link, f7Searchbar, f7Icon } from 'framework7-vue';

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
    },
  };
</script>
