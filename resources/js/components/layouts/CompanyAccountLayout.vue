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
    <Dialog />
    <DialogConfirm />
    <DialogConfirmCompany />
    <DialogAppList />
    <DialogEntryForm />
  </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import Header from "./company_account_inc/Header";
import HeaderInner from "./company_account_inc/HeaderInner";
import DashboardNav from "./company_account_inc/DashboardNav";
import FooterTop from "./page_inc/FooterTop";
import BackToTop from "./page_inc/BackToTop";
export default {
  name: "CompanyAccountLayout",
  components: {
    Header,
    HeaderInner,
    DashboardNav,
    FooterTop,
    BackToTop
  },
  computed: {
    ...mapGetters("company", ["isLogin", "companyData"])
  }
};
</script>
