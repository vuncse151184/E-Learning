<template>
  <section class="job-lst-cont">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <ValidationObserver ref="observer" v-slot="{ handleSubmit }" tag="form">
            <div class="user-dashboard-info-box mb-0">
              <div class="form-row">
                <ValidationProvider name="現在のパスワード" v-slot="{ errors }" rules="required" slim>
                  <div class="form-group col-md-6">
                    <label for="password">現在のパスワード<span class="red-required">必須</span></label>
                    <input type="password" class="form-control" id="current_password" v-model="company.current_password" autocomplete="off" />
                    <small class="form-text text-error" v-if="company.errors && company.errors.messages && company.errors.messages.current_password">{{
                      company.errors.messages.current_password
                    }}</small>
                    <small class="form-text text-error" v-else-if="errors.length">{{ errors[0] }}</small>
                  </div>
                </ValidationProvider>
              </div>
              <div class="form-row">
                <ValidationProvider name="新しいパスワード" v-slot="{ errors }" rules="required|minmax:8,20" vid="new_password" slim>
                  <div class="form-group col-md-6">
                    <label for="new_password">新しいパスワード <span class="red-required">必須</span></label>
                    <input type="password" class="form-control" v-model="company.new_password" />
                    <small class="form-text text-error" v-if="company.errors && company.errors.messages && company.errors.messages.new_password">{{ company.errors.messages.new_password }}</small>
                    <small class="form-text text-error" v-else-if="errors.length">{{ errors[0] }}</small>
                  </div>
                </ValidationProvider>
                <ValidationProvider name="新しいパスワード（確認用）" v-slot="{ errors }" rules="required|confirmed_new_password:new_password" slim>
                  <div class="form-group col-md-6">
                    <label for="confirm_new_password">新しいパスワード（確認用） <span class="red-required">必須</span></label>
                    <input type="password" class="form-control" v-model="company.new_password_confirm" />
                    <small class="form-text text-error">{{ errors[0] }}</small>
                  </div>
                </ValidationProvider>
              </div>
            </div>
            <div class="col-md-12 my-5 mx-auto text-center">
              <button type="button" @click="handleSubmit(changePassword)" class="btn blue-btn btn-lg">上記内容で登録する</button>
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
        new_password: "",
        new_password_confirm: "",
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
    ...mapActions("company", ["sendAccountInfoUpdatePassword"]),
    async changePassword() {
      let _self = this;
      const valid = await _self.$refs.observer.validate();
      if (valid) {
        _self.sendAccountInfoUpdatePassword(_self.company).then(
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
