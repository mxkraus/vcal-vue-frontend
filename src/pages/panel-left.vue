<template>
  <f7-page>
    <f7-list>

      <f7-list-item 
        link="/" 
        title="Vereine" 
        panel-close
      >
        <f7-link
          slot="media"
          href="/"
          icon-ios="f7:rectangle_grid_2x2"
          icon-aurora="f7:rectangle_grid_2x2"
          icon-md="material:view_module"
        ></f7-link>
      </f7-list-item>

      <f7-list-item
        link="/com-list-f7/"
        title="Termine"
        panel-close
      >
        <f7-link
          slot="media"
          href="/com-list-f7/"
          icon-ios="f7:today_fill"
          icon-aurora="f7:today_fill"
          icon-md="material:today"
        ></f7-link>
      </f7-list-item>

    </f7-list>
  </f7-page>
</template>
<script>
/* eslint-disable */

import {
  f7Page,
  f7BlockTitle,
  f7Block,
  f7List,
  f7ListItem,
  f7Link
} from "framework7-vue";

export default {
  components: {
    f7Page,
    f7BlockTitle,
    f7Block,
    f7List,
    f7ListItem,
    f7Link
  }
};
</script>
