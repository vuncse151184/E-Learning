<template>
  <div>Job Note</div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";


export default {
  components: {
  },
  data() {
    return {
      /** Constant */
      /** Variables */
    };
  },
  computed: {
    ...mapGetters("admin", ["isLogin", "adminData"]),
    ///
    
  },
  created() {
    let jobId = this.$router.currentRoute.params.id;
    this.$store.commit('admin/updateTabbar', { jobId: jobId, showTabbar: true });
  },
  mounted() {
  },
  methods: {
  },
};

</script>
