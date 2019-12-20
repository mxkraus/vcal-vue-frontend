<template>
  <f7-page color-theme="orange">
    <f7-navbar :sliding="false">
      <f7-nav-left>
        <f7-link
          panel-open="left"
          icon-ios="f7:menu"
          icon-aurora="f7:menu"
          icon-md="material:menu"
        ></f7-link>
      </f7-nav-left>

      <f7-nav-title sliding>
        Vereinskalender
      </f7-nav-title>

      <f7-nav-right>
        <!-- <f7-link class="searchbar-enable" data-searchbar=".searchbar-components" icon-ios="f7:search" icon-aurora="f7:search" icon-md="material:search"></f7-link> -->
      </f7-nav-right>
    </f7-navbar>

    <f7-toolbar tabbar labels :position="isBottom ? 'bottom' : 'top'">
      <f7-link
        tab-link="#"
        text="Vereine"
        icon-ios="f7:rectangle_grid_2x2"
        icon-aurora="f7:rectangle_grid_2x2"
        icon-md="material:view_module"
        tab-link-active
      ></f7-link>
      <f7-link
        tab-link="#"
        href="/com-list-f7/"
        text="Termine"
        icon-ios="f7:today_fill"
        icon-aurora="f7:today_fill"
        icon-md="material:today"
      ></f7-link>
      <f7-link
        tab-link="#tab-3"
        text="Tab 3"
        icon-ios="f7:cloud_fill"
        icon-aurora="f7:cloud_fill"
        icon-md="material:file_upload"
      ></f7-link>
    </f7-toolbar>

    <f7-block>
      <f7-row>
        <f7-col><div class="layoutComponent">Verein1</div></f7-col>
        <f7-col><div class="layoutComponent">Verein2</div></f7-col>
      </f7-row>
      <f7-row>
        <f7-col><div class="layoutComponent">Verein3</div></f7-col>
        <f7-col><div class="layoutComponent">Verein4</div></f7-col>
      </f7-row>
    </f7-block>

    
  </f7-page>
</template>

<script>
/* eslint-disable */

import {
  f7Page,
  f7Card,
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
  f7Toolbar,
  f7Block,
  f7Row,
  f7Col,
  
} from "framework7-vue";

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
    f7Toolbar,
    f7Block,
    f7Row,
    f7Col
  },
  data() {
    return {
      isBottom: true
    };
  }
};
</script>

<style lang="scss" scoped>

    .row{
      margin-bottom: 30px;
    }

    .layoutComponent{
      background-color: #b2b2b2;
      height: 100px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

</style>