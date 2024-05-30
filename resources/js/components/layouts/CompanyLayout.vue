<template>
  <div class="d-flex flex-column h-100">
    <Header />
    <HeaderInner :menu-title="$store.getters.templates.menu_title" v-if="$store.getters.templates.breadcrumb" />
    <!-- Main -->
    <slot />
    <!-- End Main -->
    <FooterTop />
    <BackToTop />
  </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import Header from "./company_inc/Header";
import HeaderInner from "./company_inc/HeaderInner";
import FooterTop from "./page_inc/FooterTop";
import BackToTop from "./page_inc/BackToTop";
export default {
  name: "CompanyLayout",
  components: {
    Header,
    HeaderInner,
    FooterTop,
    BackToTop
  },
  computed: {
    ...mapGetters("company", ["isLogin", "companyData"])
  }
};
</script>
