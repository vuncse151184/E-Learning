<template>
  <section class="space-ptb mb-5">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-xl-8 col-lg-10 col-md-12">
          <div class="login-register">
            <div class="section-title">
              <h4 class="text-center">パスワードを忘れた場合</h4>
              <p class="text-center mt-2">パスワードをお忘れでログインができない場合は、メールアドレスを入力してください。</p>
            </div>
            <div class="tab-content">
              <div class="tab-pane active">
                <form class="mt-4">
                  <ValidationObserver v-slot="{ handleSubmit }">
                    <div class="form-row mb-3">
                      <div class="form-group col-12">
                        <ValidationProvider name="メールアドレス" v-slot="{ errors }" rules="required|email" slim>
                          <label for="email">メールアドレス</label>
                          <input type="text" class="form-control" id="email" v-model="user.email" />
                          <small id="emailHelp" class="form-text text-error" v-if="errors.length == 0 && user.errors && user.errors.email">{{ user.errors.email[0] }}</small>
                          <small id="emailHelp" class="form-text text-error" v-else-if="errors.length == 0 && user.errors && user.errors.messages.email">{{ user.errors.messages.email }}</small>
                          <small id="emailHelp" class="form-text text-error" v-else>{{ errors[0] }}</small>
                        </ValidationProvider>
                      </div>
                    </div>
                    <div class="form-row justify-content-md-center">
                      <div class="col-md-6">
                        <button v-on:click="handleSubmit(forgot)" type="button" class="btn yellow-btn btn-block mb-3" title="パスワード再送">パスワード再送</button>
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
        email: "",
        errors: null
      }
    };
  },
  computed: {
    ...mapGetters(["errors"])
  },
  mounted() {
    this.$store.commit("setErrors", {});
    this.$store.commit("setTemplates", { breadcrumb: false, footerFixed: true });
  },
  methods: {
    ...mapActions("user", ["sendPasswordReissue"]),
    async forgot() {
      let _self = this;
      _self.sendPasswordReissue(_self.user).then(
        () => {
          _self.$router.push({ name: "user.forgot.success" });
        },
        error => {
          _self.user.errors = _self.errors;
        }
      );
    }
  }
};
</script>
