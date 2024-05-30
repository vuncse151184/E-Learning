<template>
  <section class="job-tab">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="sticky-top secondary-menu-sticky-top">
            <div class="secondary-menu">
              <ul>
                <li><router-link :to="{ name: 'company.dashboard' }" router-link-active title="アカウント情報" exact>アカウント情報 </router-link></li>
                <li><router-link :to="{ name: 'company.edit' }" router-link-active title="企業情報" exact>企業情報</router-link></li>
                <li><router-link :to="{ path: '/company/job' }" router-link-active title="求人データ管理">求人データ管理 </router-link></li>
                <li><router-link :to="{ name: 'company.applications.data.management' }" router-link-active title="応募者データ管理" exact>応募者データ管理 </router-link></li>
                <li><router-link :to="{ name: 'company.logout' }">ログアウト</router-link></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: "DashboardNav"
};
</script>
