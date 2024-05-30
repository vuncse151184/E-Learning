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
                <ValidationObserver tag="form" class="mt-4" v-slot="{ handleSubmit }">
                  <ValidationProvider name="メールアドレス" v-slot="{ errors }" rules="required|email" vid="email" slim>
                    <div class="form-row mb-3">
                      <div class="form-group col-12">
                        <label for="charge_person_email">メールアドレス</label>
                        <input type="email" :error-messages="errors" class="form-control" id="charge_person_email" v-model="company.charge_person_email" />
                        <div class="form-text text-error" v-if="company.errors && company.errors.charge_person_email && errors.length == 0">{{ company.errors.charge_person_email[0] }}</div>
                        <div class="form-text text-error" v-else-if="company.errors && company.errors.messages.charge_person_email && errors.length == 0">
                          {{ company.errors.messages.charge_person_email }}
                        </div>
                        <div class="form-text text-error" v-else>{{ errors[0] }}</div>
                      </div>
                    </div>
                  </ValidationProvider>
                  <div class="form-row justify-content-md-center">
                    <div class="col-md-6">
                      <button v-on:click="handleSubmit(forgot)" type="button" class="btn blue-btn btn-block mb-3">パスワード再送</button>
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
        charge_person_email_confirm: "",
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
    ...mapActions("company", ["sendPasswordReissue"]),
    async forgot() {
      let _self = this;
      _self.sendPasswordReissue(_self.company).then(
        () => {
          _self.$router.push({ name: "company.forgot.success" });
        },
        error => {
          _self.company.errors = _self.errors;
        }
      );
    }
  }
};
</script>
