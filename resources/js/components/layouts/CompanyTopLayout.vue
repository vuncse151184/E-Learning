<template>
  <div>
    <HeaderTop />
    <slot />
    <FooterTop />
    <BackToTop />
    <DialogLogin />
  </div>
</template>
<script>
import { mapGetters, mapActions } from "vuex";
import HeaderTop from "./company_inc/HeaderTop";
import FooterTop from "./page_inc/FooterTop";
import BackToTop from "./page_inc/BackToTop";
export default {
  name: "CompanyTopLayout",
  components: {
    HeaderTop,
    FooterTop,
    BackToTop
  },
  computed: {
    ...mapGetters("company", ["isLogin", "companyData"])
  }
};
</script>
