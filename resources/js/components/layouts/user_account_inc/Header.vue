<template>
  <header class="header">
    <nav class="navbar navbar-static-top navbar-expand-lg header-sticky head-nav">
      <div class="container-fluid">
        <button id="nav-icon4" type="button" class="navbar-toggler" data-toggle="collapse" data-target=".navbar-collapse">
          <span></span>
          <span></span>
          <span></span>
        </button>
        <a href="/" class="navbar-brand logo" title="PrimeDX">
          <thumbnail :image="settings.logo_src" add-class="img-fluid" />
        </a>
        <div class="navbar-collapse collapse justify-content-end">
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
        <div class="add-listing add-listing-right" v-if="!isLogin">
          <div class="login d-inline-block mr-4">
            <a href="/login" class="nav-link">ログイン</a>
          </div>
        </div>
      </div>
    </nav>
  </header>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import Thumbnail from "../../Thumbnail";
export default {
  name: "Header",
  components: { Thumbnail },
  computed: {
    ...mapGetters(["settings"]),
    ...mapGetters("user", ["isLogin"])
  }
};
</script>
