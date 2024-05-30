<template>
  <footer class="footer custom-footer" :class="[!$store.getters.templates.footerFixed ? 'mt-0 pt-0' : 'fixed-footer']">
    <div class="footer-bottom bg-dark">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <div class="d-flex justify-content-md-start justify-content-sm-center">
              <ul class="list-unstyled d-flex mb-0">
                <li><a href="/terms-of-service" title="利用規約">利用規約</a></li>
                <li><a href="/privacy-policy" title="プライバシーポリシー">プライバシーポリシー</a></li>
                <li><a href="/contact" title="お問い合わせ">お問い合わせ</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md-6 text-center text-md-right mt-4 mt-md-0">
            <p class="mb-0 copy-right">
              ©Copyright <span id="copyright">2020 </span><a href="https://primestyle.co.jp" title="Primegroup" target="_blank"> Primegroup </a>. All Rights Reserved
            </p>
          </div>
        </div>
      </div>
    </div>
  </footer>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
export default {
  name: "FooterTop",
  computed: {
    ...mapGetters("user", ["isLogin"])
  }
};
</script>
