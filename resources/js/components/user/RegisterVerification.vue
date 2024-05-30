<template>
  <div class="d-flex flex-column h-100">
    <Header />
    <HeaderInner v-if="$store.getters.templates.breadcrumb" />
    <section class="space-ptb mb-5">
      <div class="container">
        <div class="row justify-content-center">
          <p v-if="loading" class="col-12 text-center">読み込み中...</p>
          <div v-else class="col-xl-8 col-lg-10 col-md-12">
            <div class="login-register">
              <div class="section-title">
                <h4 class="text-center">新規登録</h4>
                <p ref="register-massage" class="text-center mt-2">
                  PrimeDXにご登録いただきありがとうございます。<br />
                  マイページ情報を更新するとマッチング率が高まります。<br />
                  マイページの情報を充実させていただくと、紹介案件が増える可能性が高まります。
                </p>
              </div>
              <div class="tab-pane active" ref="login-button">
                <form class="mt-4">
                  <div class="form-row justify-content-md-center">
                    <div class="col-md-6">
                      <router-link :to="{ name: 'user.login' }" class="btn blue-btn btn-block mb-3" href="#!" title="ログイン">ログイン</router-link>
                    </div>
                  </div>
                </form>
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
      user: {
        token: ""
      },
      userData: {},
      verifiable: false,
      loading: true,
    };
  },
  computed: {
    ...mapGetters(["errors"])
  },
  mounted() {
    this.$store.commit("setErrors", {});
    this.$store.commit("setTemplates", { footerFixed: true });
    this.user.token = this.$route.params.token;
    this.verification();
  },
  methods: {
    ...mapActions("user", ["sendVerification"]),
    verification() {
      this.$_loadingIcon('show');
      var _this = this;
      this.sendVerification(this.user).then(
        response => {
          _this.verifiable = true;
          _this.userData = response.data.payload;
          _this.endLoading();
        },
        error => {
          _this.loading = false;
          setTimeout(() => {
            $(_this.$refs["register-massage"]).text(error.response.data.errors.messages);
            $(_this.$refs["login-button"]).remove();
            _this.endLoading();
          })
        }
      );
    },
    endLoading() {
      this.loading = false;
      this.$_loadingIcon('hide');
    },
  },
  components: {
    Header,
    HeaderInner,
    FooterTop,
    BackToTop
  }
};
</script>
