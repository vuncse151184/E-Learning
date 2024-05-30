<template>
  <header class="header custom-header custom-header-contact">
    <nav class="navbar navbar-static-top navbar-expand-lg navbar-light header-sticky shadow-sm">
      <div class="container-fluid p-0">
        <button id="nav-icon4" type="button" class="navbar-toggler" data-toggle="collapse" data-target=".navbar-collapse">
          <span></span>
          <span></span>
          <span></span>
        </button>
        <a class="navbar-brand" href="/">
          <Logo :image="settings.logo_top_src" add-class="img-fluid" />
        </a>
        <div class="navbar-collapse collapse justify-content-center">
          <ul class="nav navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="/job-list">求人を見る</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="DXコンテンツ">
                DXコンテンツ <i class="fas fa-chevron-down fa-xs"></i>
              </a>
              <ul class="dropdown-menu">
                <li>
                  <a target="_blank" class="dropdown-item" href="//blog.primedx.jp/" title="Prime DXブログ">Prime DXブログ</a>
                </li>
                <li>
                  <router-link :to="{name: 'user.useful-content'}" title="お役立ちコンテンツ" class="dropdown-item">お役立ちコンテンツ</router-link>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="/company">
                <button type="button" class="btn white-btn btn-sm border-info text-blue font-weight-normal">DX人材を探す方はこちら</button>
              </a>
            </li>
            <li class="nav-item" v-if="!isLogin">
              <a href="/register">
                <button type="button" class="btn orange-btn btn-sm border-warning font-weight-normal">無料登録はこちら</button>
              </a>
            </li>
            <li class="nav-item" v-if="!isLogin">
              <a href="/login" class="nav-link">ログイン</a>
            </li>
            <li class="nav-item" v-else>
              <a href="/my-account" class="nav-link">マイページ</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import Logo from "../../Thumbnail";
export default {
  name: "HeaderTop",
  components: { Logo },
  computed: {
    ...mapGetters(["settings"]),
    ...mapGetters("user", ["isLogin"])
  }
};
</script>
