<template>
  <section class="job-lst-cont">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <ValidationObserver ref="observer" v-slot="{ handleSubmit }" tag="form">
            <div class="user-dashboard-info-box mb-0">
              <div class="form-row">
                <ValidationProvider mode="lazy" name="現在のパスワード" v-slot="{ errors }" rules="required" slim>
                  <div class="form-group col-md-6">
                    <label for="current_password">現在のパスワード <span class="red-required">必須</span></label>
                    <input type="password" class="form-control" id="current_password" v-model="company.current_password" autocomplete="off" />
                    <small class="form-text text-error" v-if="company.errors && company.errors.messages && company.errors.messages.current_password">{{
                      company.errors.messages.current_password
                    }}</small>
                    <small class="form-text text-error" v-else-if="errors.length">{{ errors[0] }}</small>
                  </div>
                </ValidationProvider>
              </div>
              <div class="form-row">
                <ValidationProvider mode="lazy" name="新しいメールアドレス" v-slot="{ errors }" rules="required|email" vid="new_email" slim>
                  <div class="form-group col-md-6">
                    <label for="new_email">新しいメールアドレス <span class="red-required">必須</span></label>
                    <input type="text" class="form-control" placeholder v-model="company.new_email" />
                    <small class="form-text text-error" v-if="company.errors && company.errors.messages && company.errors.messages.new_email">{{ company.errors.messages.new_email }}</small>
                    <small class="form-text text-error" v-else-if="errors.length">{{ errors[0] }}</small>
                  </div>
                </ValidationProvider>
                <ValidationProvider mode="lazy" name="新しいメールアドレス（確認用）" v-slot="{ errors }" rules="required|confirmed_new_email:new_email" slim>
                  <div class="form-group col-md-6">
                    <label for="new_email_confirm">新しいメールアドレス（確認用） <span class="red-required">必須</span></label>
                    <input type="text" class="form-control" placeholder v-model="company.new_email_confirm" />
                    <small class="form-text text-error" v-if="errors.length">{{ errors[0] }}</small>
                  </div>
                </ValidationProvider>
              </div>
            </div>
            <div class="col-md-12 my-5 mx-auto text-center">
              <button type="button" @click="handleSubmit(changeEmail)" class="btn blue-btn btn-lg">
                上記内容で登録する
              </button>
            </div>
          </ValidationObserver>
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
        current_password: "",
        new_email: "",
        new_email_confirm: "",
        errors: null
      }
    };
  },
  computed: {
    ...mapGetters(["errors"]),
    ...mapGetters("company", ["companyData"])
  },
  created() {
    this.$store.commit("setTemplates", { breadcrumb: false, menu_title: document.title });
  },
  mounted() {
    this.$store.commit("setErrors", {});
  },
  methods: {
    ...mapActions("company", ["sendAccountInfoUpdateEmail"]),
    async changeEmail() {
      let _self = this;
      const valid = await _self.$refs.observer.validate();
      if (valid) {
        _self.sendAccountInfoUpdateEmail(_self.company).then(
          () => {
            _self.showModal();
            _self.company.errors = null;
          },
          error => {
            _self.company.errors = _self.errors;
          }
        );
      }
    },
    showModal() {
      const params = {
        title: "確認",
        text: "正常に更新されました。"
      };
      this.$modal.show(params);
    }
  }
};
</script>
