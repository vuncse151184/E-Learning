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
                <ValidationObserver v-slot="{ invalid, handleSubmit }" tag="form" class="mt-4">
                  <div class="form-row mb-3">
                    <ValidationProvider mode="lazy" name="メールアドレス" v-slot="{ errors }" rules="required|email" slim>
                      <div class="form-group col-12">
                        <label class="label" for="charge_person_email">メールアドレス</label>
                        <input type="email" class="form-control" id="charge_person_email" v-model="company.charge_person_email" />
                        <small class="form-text text-error" v-if="company.errors && company.errors.messages">{{ company.errors.messages[0] }}</small>
                        <small class="form-text text-error" v-else>{{ errors[0] }}</small>
                      </div>
                    </ValidationProvider>
                    <ValidationProvider mode="lazy" name="パスワード" v-slot="{ errors }" rules="required" slim>
                      <div class="form-group col-12">
                        <label class="label" for="password">パスワード</label>
                        <input type="password" class="form-control" id="password" v-model="company.password" />
                        <small class="form-text text-error">{{ errors[0] }}</small>
                      </div>
                    </ValidationProvider>
                  </div>
                  <div class="form-row justify-content-md-center">
                    <div class="col-md-6">
                      <button type="button" title="ログイン" @click="handleSubmit(login)" class="btn blue-btn btn-block mb-3" v-bind:class="invalid">
                        ログイン
                      </button>
                      <div class="ml-md-3 mt-3 mt-md-0 forgot-pass text-center">
                        <a href="/company/forgot-password" title="パスワードを忘れた方はこちら">パスワードを忘れた方はこちら</a>
                        <p class="mt-1">新規登録する方は <a href="/company/register" title="こちら">こちら</a></p>
                      </div>
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
        charge_person_email: "",
        password: "",
        errors: null
      }
    };
  },
  computed: {
    ...mapGetters(["errors"])
  },
  created() {
    this.$store.commit("setTemplates", { breadcrumb: true, footerFixed: true, menu_title: "ログイン" });
  },
  mounted() {
    this.$store.commit("setErrors", {});
  },
  methods: {
    ...mapActions("company", ["sendLoginRequest"]),
    async login() {
      let _self = this;
      _self.$_loadingIcon("show");
      _self.sendLoginRequest(_self.company).then(
        () => {
          _self.setTimeout();
          _self.$router.push({ name: "company.dashboard" });
        },
        error => {
          _self.setTimeout();
          _self.company.errors = _self.errors;
        }
      );
    },
    async setTimeout(timer = 0) {
      return setTimeout(() => {
        this.$_loadingIcon("hide");
      }, timer);
    }
  }
};
</script>
