<template>
  <aside class="col-sm-12 col-md-4 col-lg-3 aside-block">
    <div class="menu-block">
      <div class="aside-title">メニュー</div>
      <ul class="list">
        <li>
          <router-link :class="{ active: this.$route.name == 'company.account.info' }" :to="{ name: 'company.account.info' }" title="アカウント情報">アカウント情報</router-link>
        </li>
        <li>
          <router-link :class="{ active: this.$route.name == 'company.info' }" :to="{ name: 'company.info' }" title="企業情報">企業情報</router-link>
        </li>
        <li>
          <a title="求人データ管理" data-toggle="collapse" href="#collapseSub" class="row-click collapsed">求人データ管理</a>
          <ul class="sub collapse" id="collapseSub">
            <li>
              <a href="#!" title="text">text</a>
            </li>
            <li>
              <a href="#!" title="text2">text2</a>
            </li>
          </ul>
        </li>
        <li>
          <a href="#!" title="応募者データ管理">応募者データ管理</a>
        </li>
        <li>
          <a href="#!" title="ログアウト">ログアウト</a>
        </li>
      </ul>
      <div class="btn-contact">
        <a href="!#" title="お問い合わせはこちら">お問い合わせはこちら</a>
      </div>
    </div>
    <!-- end menu-block -->
    <div class="blog-block">
      <a href="./blog" title="記事">記事</a>
      <p>新着情報新着情報新着情報新着情報新着新着情報新着情報新着情報新着</p>
    </div>
    <!-- End blog-block -->
    <div class="blog-block">
      <a href="./blog" title="記事">記事</a>
      <p>新着情報新着情報新着情報新着情報新着新着情報新着情報新着情報新着</p>
    </div>
    <!-- End blog-block -->
  </aside>
</template>

<script>
export default {
  name: "Left"
};
</script>
