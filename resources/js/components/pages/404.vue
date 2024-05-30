<template>
  <section class="space-ptb mb-5">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-xl-8 col-lg-10 col-md-12">
          <div class="login-register">
            <div class="section-title">
              <h4 class="text-center"></h4>
              <p class="text-center mt-2">404 | Not Found</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
<script>
export default {
  created() {
    this.$store.commit("setTemplates", { breadcrumb: false});
  }
};
</script>
