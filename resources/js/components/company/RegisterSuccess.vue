<template>
  <section class="space-ptb mb-5">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-xl-8 col-lg-10 col-md-12">
          <div class="login-register">
            <div class="section-title">
              <h4 class="text-center">新規登録</h4>
              <p class="text-center mt-2">メールを確認し、メールアドレスの認証を行ってください。</p>
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
  computed: {
    ...mapGetters(["errors"])
  },
  created() {
    this.setTimeout(3000);
  },
  mounted() {
    this.$store.commit("setErrors", {});
    this.$store.commit("setTemplates", { breadcrumb: false, footerFixed: true, menu_title: document.title });
    if (!localStorage.getItem("registered")) {
      this.$router.push({ name: "company.dashboard" });
    }
  },
  methods: {
    async setTimeout(timer = 0) {
      return setTimeout(() => {
        localStorage.removeItem("registered");
      }, timer);
    }
  }
};
</script>
