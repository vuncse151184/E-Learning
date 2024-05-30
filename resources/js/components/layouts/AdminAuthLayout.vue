<template>
  <div><slot /></div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
export default {
  name: "AdminAuthLayout",
  computed: {
    ...mapGetters("admin", ["isLogin", "adminData"])
  }
};
</script>
