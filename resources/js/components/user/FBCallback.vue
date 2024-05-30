<template>
  <div></div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import routes from "../../routes";
export default {
  data() {
    return {
      user: {
        email: "",
        token: "",
        errors: null
      }
    };
  },
  computed: {
    ...mapGetters(["errors"]),
    ...mapGetters("user", ["userData"])
  },
  created() {
    this.$store.commit("setTemplates", { breadcrumb: false, menu_title: document.title });
  },
  mounted() {
    this.$store.commit("setErrors", {});
    this.user.email = this.$router.currentRoute.query.email;
    this.user.token = this.$router.currentRoute.query.token;
    this.fBCallback();
  },
  methods: {
    ...mapActions("user", ["sendCallbackRequest"]),
    async fBCallback() {
      let _self = this;
      _self.sendCallbackRequest(_self.user).then(
        () => {
          _self.$router.push({ name: "user.myaccount" });
        },
        error => {
          _self.user.errors = _self.errors;
        }
      );
    }
  }
};
</script>
