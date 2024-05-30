<template>
  <div>
    <div class="header-inner bg-light text-center header-inner-custom">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <h2 class="text-blue">お役立ちコンテンツ</h2>
            <ol class="breadcrumb mb-0 p-0">
              <li class="breadcrumb-item text-blue">お役立ち資料をご用意しております。ぜひ一度ご覧ください。</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <section class="py-5 mb-3 news-block">
      <DocumentMaterial v-on:show-login="handleLogin" />
    </section>
    <section class="space-ptb pt-5 news-block">
      <SimilarVideo v-on:show-login="handleLogin" />
    </section>
    <footer-nav />
    <DialogLogin v-if="!isLogin" />
  </div>
</template>
<script>
  import { mapGetters } from "vuex";
  import DocumentMaterial from "./UsefulContent/DocumentMaterial";
  import SimilarVideo from "./UsefulContent/SimilarVideo";
  import FooterNav from "../layouts/inc/FooterNav";
  import DialogLogin from "../../modals/DialogLogin";
  export default {
    components: {
      DocumentMaterial,
      SimilarVideo,
      FooterNav,
      DialogLogin
    },
    data() {
      return {
        isLogin: false,
        user: {
          jobs: [],
          errors: null
        },
      };
    },
    computed: {
      ...mapGetters(["errors"]),
      ...mapGetters("user", ["userData"])
    },
    created() {
      this.$store.state.user.isLogin;
      this.$store.commit("setTemplates", {breadcrumb: false, footerFixed: false, menu_title: document.title});
    },
    mounted() {
      this.$store.commit("setErrors", {});
    },
    methods: {
      handleLogin () {
        let params = {
          title: "ログイン",
          redirecUrl: window.location.href
        };
        this.$modal.dialogLogin(params);
      },
    }
  }
</script>
