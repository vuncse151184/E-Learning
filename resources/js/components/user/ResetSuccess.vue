<template>
  <section class="space-ptb mb-5">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-xl-8 col-lg-10 col-md-12">
          <div class="login-register">
            <div class="section-title">
              <h4 class="text-center">パスワードを忘れた場合</h4>
              <p class="text-center mt-2">パスワードが更新されました。<br />新しいパスワードでログインしてください。</p>
            </div>
            <div class="tab-content">
              <div class="tab-pane active">
                <form class="mt-4">
                  <div class="form-row justify-content-md-center">
                    <div class="col-md-6">
                      <router-link class="btn yellow-btn btn-block mb-3" :to="{ name: 'user.login' }" title="ログイン">ログイン</router-link>
                    </div>
                  </div>
                </form>
              </div>
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
  }
};
</script>
