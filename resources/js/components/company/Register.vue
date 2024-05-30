<template>
  <section class="space-ptb mb-5">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-12">
          <div class="login-register">
            <div class="section-title">
              <h4 class="text-center">新規登録</h4>
            </div>
            <div class="tab-content">
              <div class="tab-pane active">
                <!-- Form -->
                <ValidationObserver tag="form" class="mt-4" v-slot="{ handleSubmit }">
                  <!-- Form Block -->
                  <div class="form-row mb-5 frm-block">
                    <!-- Form group -->
                    <ValidationProvider mode="lazy" name="企業名" v-slot="{ errors }" rules="required|max:100" slim>
                      <div class="form-group col-md-12 mb-5">
                        <label for="company_name">企業名 <span class="red-required">必須</span></label>
                        <input type="text" class="form-control" id="company_name" v-model="company.company_name" />
                        <div class="form-text text-error">{{ errors[0] }}</div>
                      </div>
                    </ValidationProvider>
                    <!-- End Form group -->

                    <!-- Form group -->
                    <ValidationProvider mode="lazy" name="ご担当者氏名" v-slot="{ errors }" rules="required|max:100" slim>
                      <div class="form-group col-md-6 mb-5">
                        <label for="charge_person_name">ご担当者氏名 <span class="red-required">必須</span></label>
                        <input type="text" class="form-control" id="charge_person_name" v-model="company.charge_person_name" />
                        <div class="form-text text-error">{{ errors[0] }}</div>
                      </div>
                    </ValidationProvider>
                    <!-- End Form group -->

                    <!-- Form group -->
                    <ValidationProvider mode="lazy" name="ご担当者氏名 ふりがな" v-slot="{ errors }" rules="required|furigana|max:100" slim>
                      <div class="form-group col-md-6 mb-5">
                        <label for="charge_person_furigana">ご担当者氏名 ふりがな <span class="red-required">必須</span></label>
                        <input type="text" class="form-control" id="charge_person_furigana" v-model="company.charge_person_furigana" />
                        <div class="form-text text-error">{{ errors[0] }}</div>
                      </div>
                    </ValidationProvider>
                    <!-- End Form group -->

                    <!-- Form group -->
                    <ValidationProvider mode="lazy" name="ご担当者部署" v-slot="{ errors }" rules="required|max:100" slim>
                      <div class="form-group col-md-6 mb-5">
                        <label for="charge_person">ご担当者部署 <span class="red-required">必須</span></label>
                        <input type="text" class="form-control" id="charge_person" v-model="company.charge_person" />
                        <div class="form-text text-error">{{ errors[0] }}</div>
                      </div>
                    </ValidationProvider>
                    <!-- End Form group -->

                    <!-- Form group -->
                    <ValidationProvider mode="lazy" name="ご担当者電話番号" v-slot="{ errors }" rules="required|max:20|phone_number" slim>
                      <div class="form-group col-md-6 mb-5">
                        <label for="charge_person_phone">ご担当者電話番号 <span class="red-required">必須</span></label>
                        <input type="text" class="form-control" id="charge_person_phone" v-model="company.charge_person_phone" />
                        <div class="form-text text-error">{{ errors[0] }}</div>
                      </div>
                    </ValidationProvider>
                    <!-- End Form group -->

                    <!-- Form group -->
                    <ValidationProvider mode="lazy" name="ご担当者メールアドレス" v-slot="{ errors }" rules="required|email" slim>
                      <div class="form-group col-md-12 mb-5">
                        <label for="charge_person_email">メールアドレス <span class="red-required">必須</span></label>
                        <input type="email" class="form-control" id="charge_person_email" v-model="company.charge_person_email" />
                        <div class="form-text text-error" v-if="company.errors && company.errors.charge_person_email.length && errors.length == 0">{{ company.errors.charge_person_email[0] }}</div>
                        <div class="form-text text-error" v-else-if="errors.length">{{ errors[0] }}</div>
                      </div>
                    </ValidationProvider>
                    <!-- End Form group -->

                    <!-- Form group -->
                    <ValidationProvider mode="lazy" name="パスワード" v-slot="{ errors }" rules="required|minmax:8,20" vid="password" slim>
                      <div class="form-group col-md-6 mb-4">
                        <label for="password">パスワード <span class="red-required">必須</span></label>
                        <input type="password" class="form-control" id="password" v-model="company.password" autocomplete="off" />
                        <div class="form-text text-error">{{ errors[0] }}</div>
                      </div>
                    </ValidationProvider>
                    <!-- End Form group -->

                    <!-- Form group -->
                    <ValidationProvider mode="lazy" name="パスワード（確認用）" v-slot="{ errors }" rules="required|password_confirmed:password" slim>
                      <div class="form-group col-md-6 mb-4">
                        <label for="password_confirmation">パスワード（確認用） <span class="red-required">必須</span></label>
                        <input type="password" class="form-control" id="password_confirmation" v-model="company.password_confirmation" autocomplete="off" />
                        <div class="form-text text-error">{{ errors[0] }}</div>
                      </div>
                    </ValidationProvider>
                    <!-- End Form group -->
                  </div>
                  <!-- End Form Block -->
                  <div class="form-row justify-content-md-center">
                    <div class="col-md-06">
                      <p class="mt-1">※ <a href="/handling-of-personal-information" target="_blank" title="個人情報取り扱い">個人情報取り扱い</a>、<a href="/terms-of-service" target="_blank">利用規約</a>について同意の上、送信内容を確認してください。</p>
                      <button type="button" @click="handleSubmit(register)" class="btn blue-btn btn-block mb-3">
                        以上の内容で登録する
                      </button>
                    </div>
                  </div>
                </ValidationObserver>
                <!-- End Form -->
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
        company_name: "",
        charge_person_name: "",
        charge_person_furigana: "",
        charge_person: "",
        charge_person_phone: "",
        charge_person_email: "",
        password: "",
        password_confirmation: "",
        logo: "",
        url: "",
        postal_code: "",
        address: "",
        building_name: "",
        founded_date: "",
        capital: "",
        leader_name: "",
        number_of_employees: 0,
        sales: 0,
        company_introduction: "",
        errors: null
      }
    };
  },
  computed: {
    ...mapGetters(["errors"])
  },

  mounted() {
    this.$store.commit("setErrors", {});
    this.$store.commit("setTemplates", { breadcrumb: true, menu_title: "新規登録"});
  },
  methods: {
    ...mapActions("company", ["sendRegisterRequest"]),
    async register() {
      let _self = this;
      _self.sendRegisterRequest(_self.company).then(
        () => {
          localStorage.setItem("registered", 1);
          _self.$router.push({ name: "company.register.success" });
        },
        error => {
          _self.company.errors = _self.errors;
        }
      );
    }
  }
};
</script>
