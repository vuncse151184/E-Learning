<template>
  <section class="space-ptb mb-5">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-xl-8 col-lg-10 col-md-12">
          <div class="login-register">
            <div class="section-title">
              <h4 class="text-center">パスワードの変更に成功しました!</h4>
              <p class="text-center mt-2">パスワードが変更された。<br />新しいパスワードでログインしてください。</p>
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
  beforeCreate() {},
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
    if (!localStorage.getItem("changed")) {
      this.$router.push({ name: "home" });
    }
  },
  methods: {
    async setTimeout(timer = 0) {
      return setTimeout(() => {
        localStorage.removeItem("changed");
      }, timer);
    }
  }
};
</script>
