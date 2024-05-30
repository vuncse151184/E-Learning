<template>
  <section class="space-ptb mb-5">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-xl-8 col-lg-10 col-md-12">
          <div class="login-register">
            <div class="section-title">
              <h4 class="text-center">パスワードを忘れた場合</h4>
              <p class="text-center mt-2 text-error" v-if="!resetable && user.errors && user.errors.messages">{{ user.errors.messages[0] }}</p>
              <p class="text-center mt-2 text-error" v-else-if="!reset_success && user.errors && user.errors.messages">{{ user.errors.messages[0] }}</p>
              <p class="text-center mt-2" v-else>パスワードをお忘れでログインができない場合は、メールアドレスを入力してください。</p>
            </div>
            <div class="tab-content" v-if="resetable && reset_success">
              <div class="tab-pane active">
                <form class="mt-4">
                  <ValidationObserver v-slot="{ handleSubmit }">
                    <div class="form-row mb-3">
                      <ValidationProvider name="新しいパスワード" v-slot="{ errors }" rules="required|minmax:8,20" vid="new_password" slim>
                        <div class="form-group col-12">
                          <label for="new_password">新しいパスワード</label>
                          <input type="password" class="form-control" v-model="user.new_password" autocomplete="off" />
                          <small id="emailHelp" class="form-text text-error">{{ errors[0] }}</small>
                        </div>
                      </ValidationProvider>
                      <ValidationProvider name="新しいパスワード(確認用)" v-slot="{ errors }" rules="required|confirmed_new_password:new_password" slim>
                        <div class="form-group col-12">
                          <label for="new_password_confirm">新しいパスワード(確認用)</label>
                          <input type="password" class="form-control" v-model="user.new_password_confirm" autocomplete="off" />
                          <small id="emailHelp" class="form-text text-error">{{ errors[0] }}</small>
                        </div>
                      </ValidationProvider>
                    </div>
                    <div class="form-row justify-content-md-center">
                      <div class="col-md-6">
                        <button v-on:click="handleSubmit(reset)" type="button" class="btn yellow-btn btn-block mb-3">新しいパスワードを保存する</button>
                      </div>
                    </div>
                  </ValidationObserver>
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
    return {
      user: {
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
    this.user.token = this.$route.params.token;
    this.verifyBeforeReset();
  },
  methods: {
    ...mapActions("user", ["verifyBeforeResetPassword", "sendResetPassword"]),
    async reset() {
      let _self = this;
      this.sendResetPassword(_self.user).then(
        () => {
          _self.$store.commit("logout");
          _self.$router.push({
            name: "user.reset.success"
          });
        },
        error => {
          _self.user.errors = _self.errors;
          _self.reset_success = false;
        }
      );
    },
    verifyBeforeReset() {
      let _self = this;
      _self.verifyBeforeResetPassword(_self.user.token).then(
        () => {
          _self.resetable = true;
        },
        error => {
          if (_self.errors.messages == "404") {
            _self.$router.push("/404");
          } else {
            _self.user.errors = _self.errors;
          }
        }
      );
    }
  }
};
</script>
