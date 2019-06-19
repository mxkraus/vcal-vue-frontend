<template>
  <f7-page>

    <f7-block-title>
      Navigation
      <f7-link 
        no-link-class=true
        :class="close-icon" 
        panel-close
        icon-f7="close"
        icon-only="true"
        color="red"> 
      </f7-link>
    </f7-block-title>

    <f7-list>
      <f7-list-item link="/" title="Home" panel-close></f7-list-item>
      <f7-list-item link="/com-list/" title="Vereinsliste Bootstrap" panel-close></f7-list-item>
      <f7-list-item link="/com-list-f7/" title="Vereinsliste Framework7" panel-close></f7-list-item>
    </f7-list>

  </f7-page>
</template>
<script>

/* eslint-disable */

  import { f7Page, f7BlockTitle, f7Block, f7List, f7ListItem, f7Link } from 'framework7-vue';

  export default {

    components: {
      f7Page,
      f7BlockTitle,
      f7Block,
      f7List,
      f7ListItem,
      f7Link,
    },
  };
</script>

