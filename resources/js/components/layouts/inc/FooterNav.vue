<template>
  <section class="footer bg-light mt-0 pb-5">
    <div class="position-relative">
      <svg class="footer-shape" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="100%" height="85px">
        <path fill-rule="evenodd" fill="rgb(255, 255, 255)" d="M-0.000,-0.001 L1923.000,-0.001 L1923.000,84.999 C1608.914,41.669 1279.532,19.653 962.500,19.000 C635.773,18.326 323.692,40.344 -0.000,84.999 C-0.000,-83.334 -0.000,168.332 -0.000,-0.001 Z"></path>
      </svg>
    </div>
    <div class="container pt-5">
      <div class="row mt-5">
        <div class="col-lg-3 col-md-6">
          <div class="footer-link">
            <h5 class="text-dark mb-4">DX人材の方</h5>
            <ul class="list-unstyled">
              <li><a href="/job-list" title="求人を見る">求人を見る</a></li>
              <li><a href="/web-resume" title="WEBレジュメ">WEBレジュメ</a></li>
              <li><a href="#!" title="気になる">気になる</a></li>
            </ul>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 mt-4 mt-md-0">
          <div class="footer-link">
            <h5 class="text-dark mb-4">DX人材をお探しの方</h5>
            <ul class="list-unstyled">
              <li><a href="/company" title="企業情報">企業情報</a></li>
              <li><a href="/company/register" title="求人登録">求人登録</a></li>
              <li><a href="/application-history" title="応募者データ管理">応募者データ管理</a></li>
              <li><a href="/resume-registration" title="求人データ管理">求人データ管理</a></li>
            </ul>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 mt-4 mt-md-0">
          <div class="footer-link">
            <h5 class="text-dark mb-4">DXコンテンツ</h5>
            <ul class="list-unstyled">
              <li><a target="_blank" href="//blog.primedx.jp/" title="Prime DXブログ">Prime DXブログ</a></li>
              <li><router-link :to="{name: 'user.useful-content'}" title="お役立ちコンテンツ">お役立ちコンテンツ</router-link></li>
              
            </ul>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 mt-5">
          <a href="/contact" class="btn yellow-btn btn-md btn-255">お問い合わせ</a>
        </div>
      </div>
    </div>
  </section>
</template>
<script>
export default {
  name: "FooterNav",
};
</script>
