<template>
  <div></div>
</template>
<script>
import { mapGetters, mapActions } from "vuex";
export default {
  mounted() {
    this.logout();
  },
  computed: {
    ...mapGetters("user", ["isLogin"])
  },
  methods: {
    ...mapActions("user", ["sendLogoutRequest"]),
    async logout() {
      this.sendLogoutRequest();
      setTimeout(this.onLogout.bind(null, "/"), 1000);
    },
    onLogout(url) {
      return (window.location.href = url ? url : "/");
    }
  }
};
</script>
