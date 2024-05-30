<template>
  <section class="space-ptb mb-5">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-xl-8 col-lg-10 col-md-12">
          <div class="login-register">
            <div class="section-title">
              <h4 class="text-center">ログイン</h4>
            </div>
            <div class="tab-content">
              <div class="tab-pane active">
                <ValidationObserver v-slot="{ handleSubmit }" tag="form" class="mt-4">
                  <div class="form-row mb-3">
                    <ValidationProvider mode="lazy" name="メールアドレス" v-slot="{ errors }" rules="required|email" slim>
                      <div class="form-group col-12">
                        <label for="email">メールアドレス</label>
                        <input type="text" class="form-control" id="email" v-model="user.email" />
                        <div id="emailHelp" class="form-text text-error" v-if="user.errors && user.errors.messages">{{ user.errors.messages[0] }}</div>
                        <div id="emailHelp" class="form-text text-error" v-else>{{ errors[0] }}</div>
                      </div>
                    </ValidationProvider>
                    <div class="form-group col-12">
                      <ValidationProvider mode="lazy" name="パスワード" v-slot="{ errors }" rules="required" slim>
                        <label for="password">パスワード</label>
                        <input type="password" class="form-control" id="password" v-model="user.password" />
                        <div id="passwordHelp" class="form-text text-error">{{ errors[0] }}</div>
                      </ValidationProvider>
                    </div>
                  </div>
                  <div class="form-row justify-content-md-center">
                    <div class="col-md-6">
                      <button type="button" title="ログイン" @click="handleSubmit(login)" class="btn yellow-btn btn-block mb-3">
                        ログイン
                      </button>
                      <div class="ml-md-3 mt-3 mt-md-0 forgot-pass text-center">
                        <a href="/forgot-password" class="" title="パスワードを忘れた方はこちら">パスワードを忘れた方はこちら</a>
                        <p class="mt-1">
                          新規登録する方は
                          <a href="/register" class="" title="こちら">こちら</a>
                        </p>
                      </div>
                    </div>
                  </div>
                </ValidationObserver>
              </div>
            </div>
            <div class="mt-4" v-if="settings.social_login">
              <fieldset>
                <legend class="px-2">SNSアカウントでログインする</legend>

                <div class="form-row social-login justify-content-md-center">
                  <div class="col-md-6">
                    <a class="facebook text-center" href="/auth/redirect/facebook" @click="loginFB" title="Facebookでログイン"> <i class="fab fa-facebook-f mr-4"></i>Facebookでログイン</a>
                  </div>
                </div>
              </fieldset>
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
      user: {
        email: "",
        password: "",
        errors: null
      }
    };
  },
  computed: {
    ...mapGetters(["errors", "settings"])
  },
  created() {
    this.$store.commit("setTemplates", { breadcrumb: false, footerFixed: true, main_title: document.title });
  },
  mounted() {
    this.$store.commit("setErrors", {});
  },
  methods: {
    ...mapActions("user", ["sendLoginRequest"]),
    async login() {
      let _self = this;
      _self.$_loadingIcon("show");
      _self.sendLoginRequest(_self.user).then(
        () => {
          _self.setTimeout();
          _self.$router.push({ name: "user.myaccount" });
        },
        error => {
          _self.setTimeout();
          _self.user.errors = _self.errors;
        }
      );
    },
    async setTimeout(timer = 0) {
      return setTimeout(() => {
        this.$_loadingIcon("hide");
      }, timer);
    },
    loginFB() {
      this.$_loadingIcon("show");
    }
  }
};
</script>
