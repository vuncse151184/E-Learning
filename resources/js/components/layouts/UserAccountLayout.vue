<template>
  <div class="d-flex flex-column h-100">
    <Header />
    <HeaderInner />
    <DashboardNav />
    <!-- Main -->
    <slot />
    <!-- End Main -->
    <FooterTop />
    <BackToTop />
  </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import Header from "./user_account_inc/Header";
import HeaderInner from "./user_account_inc/HeaderInner";
import DashboardNav from "./user_account_inc/DashboardNav";
import FooterTop from "./page_inc/FooterTop";
import BackToTop from "./page_inc/BackToTop";
export default {
  name: "UserAccountLayout",
  components: {
    Header,
    HeaderInner,
    DashboardNav,
    FooterTop,
    BackToTop
  },
  computed: {
    ...mapGetters("user", ["isLogin", "userData"])
  }
};
</script>
