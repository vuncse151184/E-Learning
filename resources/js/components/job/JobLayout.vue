<template>
  <div class="d-flex flex-column h-100">
    <Header />
    <!-- Main -->
    <slot />
    <!-- End Main -->
    <FooterTop />
    <BackToTop />
  </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import Header from "./../layouts/user_inc/Header";
import FooterTop from "./../layouts/page_inc/FooterTop";
import BackToTop from "./../layouts/page_inc/BackToTop";
export default {
  name: "JobLayout",
  components: {
    Header,
    FooterTop,
    BackToTop
  },
  data() {
    return {
      search_options: {
        keyword:'',
        work_style: '',
        job_category: ''
      },
    }
  },
  computed: {
    ...mapGetters("user", ["isLogin", "userData"])
  }
};
</script>
