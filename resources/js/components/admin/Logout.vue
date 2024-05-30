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
    ...mapGetters("admin", ["isLogin"])
  },
  methods: {
    ...mapActions("admin", ["sendLogoutRequest"]),
    async logout() {
      this.sendLogoutRequest();
      setTimeout(this.onLogout.bind(null, "/administrator"), 1000);
    },
    onLogout(url) {
      return (window.location.href = url ? url : "/");
    }
  }
};
</script>
