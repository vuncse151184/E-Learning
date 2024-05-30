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
    ...mapGetters("company", ["isLogin"])
  },
  methods: {
    ...mapActions("company", ["sendLogoutRequest"]),
    async logout() {
      this.sendLogoutRequest();
      setTimeout(this.onLogout.bind(null, "/company"), 1000);
    },
    onLogout(url) {
      return (window.location.href = url ? url : "/");
    }
  }
};
</script>
