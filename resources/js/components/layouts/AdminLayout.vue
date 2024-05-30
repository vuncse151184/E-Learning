<template>
  <div>
    <Navbar />
    <Sidebar />
    <div class="content-wrapper">
      <Pageheader ref="admin-page-header" />
      <section class="content">
        <div class="container-fluid">
          <slot />
        </div>
      </section>
    </div>
    <Footer />
    <!-- <Dialog /> -->
    <DialogConfirm />
    <DialogConfirmCompany />
  </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import Navbar from "./admin_inc/Navbar";
import Sidebar from "./admin_inc/Sidebar";
import Pageheader from "./admin_inc/Pageheader";
import Footer from "./admin_inc/Footer";
export default {
  name: "AdminLayout",
  components: {
    Navbar,
    Sidebar,
    Pageheader,
    Footer
  },
  computed: {
    ...mapGetters("admin", ["isLogin", "adminData"])
  }
};
</script>
