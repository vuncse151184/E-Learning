<template>
  <section class="job-tab">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="sticky-top secondary-menu-sticky-top">
            <div class="secondary-menu">
              <ul>
                <li>
                  <router-link :to="{ name: 'user.myaccount' }" router-link-active title="アカウント情報">アカウント情報</router-link>
                </li>
                <li>
                  <router-link :to="{ name: 'user.web-resume' }" router-link-active title="WEBレジュメ">WEBレジュメ</router-link>
                </li>
                <li>
                  <router-link :to="{ name: 'user.resume-registration' }" router-link-active title="履歴書・職務経歴書">履歴書・職務経歴書</router-link>
                </li>
                <li>
                  <router-link :to="{ name: 'user.application-history' }" router-link-active title="応募履歴の管理">応募履歴の管理</router-link>
                </li>
                <li>
                  <router-link :to="{ name: 'user.job-list-like' }" router-link-active title="気になる">気になる</router-link>
                </li>
                <li>
                  <router-link :to="{ name: 'user.useful-content' }" router-link-active title="Wordpress">お役立ちコンテンツ</router-link>
                </li>
                <li v-if="userData.social_account && !userData.social_account.password_created">
                  <router-link :to="{ name: 'user.create_password' }" router-link-active title="パスワードの作成">パスワードの作成</router-link>
                </li>
                <li v-else>
                  <router-link :to="{ name: 'user.change_password' }" router-link-active title="パスワード変更">パスワード変更</router-link>
                </li>
                <li>
                  <router-link :to="{ name: 'user.logout' }">ログアウト</router-link>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
export default {
  name: "DashboardNav",
  computed: {
    ...mapGetters("user", ["userData"])
  }
};
</script>
