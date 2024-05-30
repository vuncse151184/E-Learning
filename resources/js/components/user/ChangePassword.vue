<template>
  <section class="job-lst-cont">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="section-title-02 mb-4">
            <h4>パスワード変更</h4>
          </div>
          <ValidationObserver v-slot="{ handleSubmit }">
            <div class="form-row mb-5 frm-dashboard-block">
              <!-- Form group -->
              <ValidationProvider name="現在のパスワード" v-slot="{ errors }" rules="required" slim>
                <div class="form-group col-md-12 mb-4">
                  <label for="current_password">現在のパスワード<span class="red-required">必須</span></label>
                  <input type="password" class="form-control" id="current_password" v-model="user.current_password" />
                  <small id="current_password_Help" class="form-text text-error" v-if="user.errors && user.errors.messages.current_password">{{ user.errors.messages.current_password }}</small>
                  <small id="current_password_Help" class="form-text text-error" v-else>{{ errors[0] }}</small>
                </div>
              </ValidationProvider>
              <!-- End Form group -->

              <!-- Form group -->
              <ValidationProvider name="新しいパスワード" v-slot="{ errors }" rules="required|minmax:8,20" vid="new_password" slim>
                <div class="form-group col-md-12 mb-4">
                  <label for="new_password">新しいパスワード<span class="red-required">必須</span></label>
                  <input type="password" class="form-control" id="new_password" v-model="user.new_password" />
                  <small id="current_password_Help" class="form-text text-error" v-if="user.errors && user.errors.messages.new_password">{{ user.errors.messages.new_password }}</small>
                  <small id="new_password_Help" class="form-text text-error" v-else>{{ errors[0] }}</small>
                </div>
              </ValidationProvider>
              <!-- End Form group -->

              <!-- Form group -->
              <ValidationProvider name="新しいパスワード(確認用)" v-slot="{ errors }" rules="required|confirmed_new_password:new_password" slim>
                <div class="form-group col-md-12">
                  <label for="new_password_confirmation">新しいパスワード(確認用)<span class="red-required">必須</span></label>
                  <input type="password" class="form-control" id="new_password_confirmation" v-model="user.new_password_confirmation" />
                  <small id="new_password_confirmation_Help" class="form-text text-error">{{ errors[0] }}</small>
                </div>
              </ValidationProvider>
              <!-- End Form group -->
            </div>
            <div class="col-md-3 my-5 mx-auto">
              <button v-on:click="handleSubmit(changePassword)" type="button" class="btn yellow-btn btn-block" title="変更する">変更する</button>
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
      user: {
        current_password: "",
        new_password: "",
        new_password_confirmation: "",
        uid: "",
        errors: null
      }
    };
  },
  computed: {
    ...mapGetters(["errors"]),
    ...mapGetters("user", ["isLogin", "userData"])
  },
  mounted() {
    this.$store.commit("setErrors", {});
    if (this.userData.social_account && !this.userData.social_account.password_created) {
      this.$router.push({ name: "user.create_password" });
    }
  },
  methods: {
    ...mapActions("user", ["sendChangePassword"]),
    async changePassword() {
      let _self = this;
      _self.sendChangePassword(_self.user).then(
        () => {
          _self.$store.commit("logout");
          localStorage.removeItem("authToken");
          localStorage.setItem("changed", 1);
          _self.$router.push({ name: "user.change_password.success" });
        },
        error => {
          _self.user.errors = _self.errors;
        }
      );
    }
  }
};
</script>
