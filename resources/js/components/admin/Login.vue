<template>
  <ValidationObserver v-slot="{ invalid, handleSubmit }" tag="form" class="form-login">
    <img class="mb-4" src="/assets/img/login-logo.png" alt="" />
    <h3>ログイン</h3>
    <ValidationProvider mode="lazy" name="メールアドレス" v-slot="{ errors }" rules="required|email" slim>
      <div class="row mb-4">
        <label for="inputEmail">メールアドレス</label>
        <input type="email" id="inputEmail" class="form-control mb-1" required="" autofocus="" v-model="admin.email" />
        <small class="form-text text-danger" v-if="admin.errors && admin.errors.messages">{{ admin.errors.messages[0] }}</small>
        <small class="form-text text-danger" v-else>{{ errors[0] }}</small>
      </div>
    </ValidationProvider>
    <ValidationProvider mode="lazy" name="パスワード" v-slot="{ errors }" rules="required" slim>
      <div class="row mb-4">
        <label for="inputPassword">パスワード</label>
        <input type="password" id="inputPassword" class="form-control mb-1" required="" v-model="admin.password" />
        <small class="form-text text-danger">{{ errors[0] }}</small>
      </div>
    </ValidationProvider>
    <button type="button" title="ログイン" @click="handleSubmit(login)" class="btn blue-btn btn-block mb-3" v-bind:class="invalid">
      ログイン
    </button>
    <router-link :to="{ name: 'admin.forgot.password' }" title="パスワードを忘れた方はこちら">パスワードを忘れた方はこちら</router-link>
  </ValidationObserver>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
export default {
  beforeCreate() {},
  data() {
    return {
      admin: {
        email: "",
        password: "",
        errors: null
      }
    };
  },
  computed: {
    ...mapGetters(["errors"])
  },
  created() {
    this.$store.commit("setTemplates", { breadcrumb: true, menu_title: document.title });
  },
  mounted() {
    this.$store.commit("setErrors", {});
  },
  methods: {
    ...mapActions("admin", ["sendLoginRequest"]),
    async login() {
      let _self = this;
      _self.sendLoginRequest(_self.admin).then(
        () => {
          _self.$router.push({ name: "admin.dashboard" });
        },
        error => {
          _self.admin.errors = _self.errors;
        }
      );
    }
  }
};
</script>
