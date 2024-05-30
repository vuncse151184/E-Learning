<template>
  <div class="d-flex flex-column h-100">
    <Header />
    <HeaderInner v-if="$store.getters.templates.breadcrumb" />
    <section class="space-ptb mb-5">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-xl-8 col-lg-10 col-md-12">
            <div class="login-register">
              <div class="section-title">
                <h4 class="text-center">新規登録</h4>
                <p class="text-center mt-2">登録メールアドレスに会員登録URLを送信しました。<br />メール本文のURLをクリックして、会員登録を48時間以内に行ってください。</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <FooterTop />
    <BackToTop />
  </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import Header from "../layouts/user_inc/Header";
import HeaderInner from "../layouts/user_inc/HeaderInner";
import FooterTop from "../layouts/page_inc/FooterTop";
import BackToTop from "../layouts/page_inc/BackToTop";
export default {
  beforeCreate() {},
  data() {
    return {
      user: {}
    };
  },
  computed: {
    ...mapGetters(["errors"])
  },
  mounted() {
    this.$store.commit("setErrors", {});
    this.$store.commit("setTemplates", { footerFixed: true });
  },
  methods: {},
  components: {
    Header,
    HeaderInner,
    FooterTop,
    BackToTop
  }
};
</script>
