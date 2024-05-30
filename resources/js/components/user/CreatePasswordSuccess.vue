<template>
  <section class="space-ptb mb-5">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-xl-8 col-lg-10 col-md-12">
          <div class="login-register">
            <div class="section-title">
              <h4 class="text-center">パスワードが正常に作成されました。</h4>
              <p class="text-center mt-2">パスワードが作成されました。 <br />マイアカウントにアクセスしてください</p>
            </div>
            <div class="tab-content">
              <div class="tab-pane active">
                <form class="mt-4">
                  <div class="form-row justify-content-md-center">
                    <div class="col-md-6">
                      <router-link class="btn yellow-btn btn-block mb-3" :to="{ name: 'user.myaccount' }" title="アカウント情報">アカウント情報</router-link>
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
    return {};
  },
  computed: {
    ...mapGetters(["errors"])
  },
  created() {
    this.setTimeout(3000);
  },
  mounted() {
    this.$store.commit("setErrors", {});
    this.$store.commit("setTemplates", { breadcrumb: false });
    if (!localStorage.getItem("created")) {
      this.$router.push({ name: "user.myaccount" });
    }
  },
  methods: {
    async setTimeout(timer = 0) {
      return setTimeout(() => {
        localStorage.removeItem("created");
      }, timer);
    }
  }
};
</script>
