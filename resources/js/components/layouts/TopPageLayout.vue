<template>
  <div class="d-flex flex-column h-100">
    <HeaderTopPage />
    <slot />
    <FooterTop />
    <BackToTop />
    <DialogLogin />
  </div>
</template>
<script>
import { mapGetters, mapActions } from "vuex";
import HeaderTopPage from "./page_inc/HeaderTopPage";
import FooterTop from "./page_inc/FooterTop";
import BackToTop from "./page_inc/BackToTop";
export default {
  name: "UserTopPageLayout",
  components: {
    HeaderTopPage,
    FooterTop,
    BackToTop
  },
  computed: {
    ...mapGetters("user", ["isLogin", "userData"])
  }
};
</script>
