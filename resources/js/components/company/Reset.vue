<template>
  <section class="space-ptb mb-5">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-xl-8 col-lg-10 col-md-12">
          <div class="login-register">
            <div class="section-title">
              <h4 class="text-center">パスワードを忘れた場合</h4>
              <p class="text-center mt-2 text-error" v-if="!resetable && company.errors && company.errors.messages">{{ company.errors.messages[0] }}</p>
              <p class="text-center mt-2 text-error" v-else-if="!reset_success && company.errors && company.errors.messages">{{ company.errors.messages[0] }}</p>
              <p class="text-center mt-2" v-else>パスワードをお忘れでログインができない場合は、メールアドレスを入力してください。</p>
            </div>

            <div class="tab-content" v-if="resetable && reset_success">
              <div class="tab-pane active">
                <ValidationObserver tag="form" class="mt-4" v-slot="{ handleSubmit }">
                  <ValidationProvider name="新しいパスワード" v-slot="{ errors }" rules="required|minmax:8,20" vid="new_password" slim>
                    <div class="form-group col-12">
                      <label for="new_password">新しいパスワード</label>
                      <input type="password" class="form-control" id="new_password" v-model="company.new_password" />
                      <div class="form-text text-error">{{ errors[0] }}</div>
                    </div>
                  </ValidationProvider>
                  <ValidationProvider name="新しいパスワード（確認用）" v-slot="{ errors }" rules="required|minmax:8,20|confirmed_new_password:new_password" slim>
                    <div class="form-group col-12">
                      <label for="new_password_confirm">新しいパスワード（確認用）</label>
                      <input type="password" class="form-control" id="new_password_confirm" v-model="company.new_password_confirm" />
                      <div class="form-text text-error">{{ errors[0] }}</div>
                    </div>
                  </ValidationProvider>
                  <div class="form-row justify-content-md-center">
                    <div class="col-md-6">
                      <button v-on:click="handleSubmit(reset)" type="button" class="btn blue-btn btn-block mb-3">新しいパスワードを保存する</button>
                    </div>
                  </div>
                </ValidationObserver>
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
      company: {
        new_password: "",
        new_password_confirm: "",
        token: "",
        errors: null
      },
      resetable: false,
      reset_success: true
    };
  },
  computed: {
    ...mapGetters(["errors"])
  },

  mounted() {
    this.$store.commit("setErrors", {});
    this.$store.commit("setTemplates", { breadcrumb: false, footerFixed: true });
    this.company.token = this.$route.params.token;
    this.verify();
  },
  methods: {
    ...mapActions("company", ["verifyResetPassword", "sendResetPassword"]),
    async reset() {
      let _self = this;
      this.sendResetPassword(_self.company).then(
        () => {
          _self.$store.commit("logout");
          _self.$router.push({
            name: "company.reset.success"
          });
        },
        error => {
          _self.company.errors = _self.errors;
          _self.reset_success = false;
        }
      );
    },
    verify() {
      let _self = this;
      _self.verifyResetPassword(_self.company.token).then(
        () => {
          _self.resetable = true;
        },
        error => {
          if (_self.errors.messages == "404") {
            _self.$router.push("/404");
          } else {
            _self.company.errors = _self.errors;
          }
        }
      );
    }
  }
};
</script>
