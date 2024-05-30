<template>
  <div class="d-flex flex-column h-100">
    <Header />
    <HeaderInner v-if="$store.getters.templates.breadcrumb" />
    <!-- Main -->
    <slot />
    <!-- End Main -->
    <FooterTop />
    <BackToTop />
  </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import Header from "./user_inc/Header";
import HeaderInner from "./user_inc/HeaderInner";
import FooterTop from "./page_inc/FooterTop";
import BackToTop from "./page_inc/BackToTop";
export default {
  name: "UserLayout",
  components: {
    Header,
    HeaderInner,
    FooterTop,
    BackToTop
  },
  computed: {
    ...mapGetters("user", ["isLogin", "userData"])
  }
};
</script>
