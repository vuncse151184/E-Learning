<template>
  <section class="space-ptb mb-5">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-xl-8 col-lg-10 col-md-12">
          <div class="login-register">
            <div class="section-title">
              <h4 class="text-center">パスワードを忘れた場合</h4>
              <p class="text-center mt-2">パスワードの再設定メールを送信されました。</p>
            </div>
            <div class="tab-content">
              <div class="tab-pane active"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
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
    this.$store.commit("setTemplates", { breadcrumb: false, footerFixed: true });
  },
  methods: {}
};
</script>
