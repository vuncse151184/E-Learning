<template>
  <ul class="breadcrumb-block">
    <li>
      <router-link :to="{name:'company.dashboard'}" title="ホーム">ホーム</router-link>
    </li>
    <li v-if="sub">
      <router-link :to="{name:sub_data.name}" :title="sub_data.title">{{sub_data.title}}</router-link>
    </li>
    <li>{{menu_active}}</li>
  </ul>
</template>

<script>
export default {
  props: {
    sub: Boolean,
    sub_data: Object,
  },
  name: "Breadcrumb",
  data() {
    return {
      menu_active: document.title,
    };
  },
  mounted() { },
};
</script>