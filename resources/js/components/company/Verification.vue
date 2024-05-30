<template>
  <section class="space-ptb mb-5">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-xl-8 col-lg-10 col-md-12">
          <div class="login-register">
            <div class="section-title">
              <h4 class="text-center">新規登録</h4>
              <p class="text-center mt-2 error-text" v-if="company.errors && company.errors.messages">{{ company.errors.messages }}</p>
              <p class="text-center mt-2" v-show="verifiable">PrimeDXにご登録いただきありがとうございます。 求人情報に必要な企業情報を更新してください。</p>
            </div>
            <div class="tab-content">
              <div class="tab-pane active">
                <form class="mt-4">
                  <div class="form-row justify-content-md-center">
                    <div class="col-md-6">
                      <router-link class="btn blue-btn btn-block mb-3" :to="{ name: 'company.dashboard' }">企業情報を登録</router-link>
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
  <!-- Main -->
  <!-- <main role="main" class="col-lg-12 main-block">
    <section class="main-cont">
      <h3 class="main-title">
        <span>Verification</span>
      </h3>
      <p class="sub-title" v-show="verifiable">Verification Success</p>
      <p class="error-title" v-if="company.errors && company.errors.messages">{{ company.errors.messages }}</p>
      <div class="btn-block link-btn">
        <router-link class="btn btn-primary" :to="{ name: 'company.dashboard' }">企業情報を登録</router-link>
      </div>
    </section>
  </main> -->
</template>

<script>
import { mapGetters, mapActions } from "vuex";
export default {
  data() {
    return {
      company: {
        token: "",
        errors: null
      },
      verifiable: false
    };
  },
  computed: {
    ...mapGetters(["errors"])
  },
  mounted() {
    this.$store.commit("setErrors", {});
    this.$store.commit("setTemplates", { footerFixed: true });
    this.company.token = this.$route.params.token;
    this.verification();
  },
  methods: {
    ...mapActions("company", ["sendVerification"]),
    async verification() {
      let _self = this;
      this.sendVerification(_self.company).then(
        () => {
          _self.verifiable = true;
        },
        error => {
          _self.company.errors = _self.errors;
        }
      );
    }
  }
};
</script>
