<template>
  <footer class="main-footer">
    <div class="float-right d-sm-block">
      © Copyright 2020 <a href="https://primestyle.co.jp/" title="Primegroup" target="_blank">Primegroup</a>. All Rights Reserved
    </div>
  </footer>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
export default {
  name: "Footer",
  computed: {
    ...mapGetters("admin", ["isLogin"])
  }
};
</script>
