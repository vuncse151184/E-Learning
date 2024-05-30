<template>
  <header class="header">
    <nav class="navbar navbar-static-top navbar-expand-lg header-sticky head-nav">
      <div class="container-fluid">
        <button id="nav-icon4" type="button" class="navbar-toggler" data-toggle="collapse" data-target=".navbar-collapse">
          <span></span>
          <span></span>
          <span></span>
        </button>
        <a class="navbar-brand logo" href="/company" title="PrimeDX">
          <img class="img-fluid" src="/assets/img/logo.png" alt="PrimeDX" />
        </a>
        <div class="navbar-collapse collapse justify-content-start">
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
          </ul>
        </div>
        <div class="add-listing">
          <a class="btn btn-md white-btn" href="/" title="DX人材の方はこちら">DX人材の方はこちら</a>
          <a class="btn btn-md yellow-btn" href="/company/register" title="企業登録はこちら">企業登録はこちら</a>
          <div class="login d-inline-block mr-4">
            <a href="/company/login" class="nav-link">ログイン</a>
          </div>
        </div>
      </div>
    </nav>
  </header>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
export default {
  name: "Header",
  computed: {
    ...mapGetters("user", ["isLogin"])
  }
};
</script>
