<template>
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-4">
        <div class="title-block" :class="hasBreadcrumb ? 'col-sm-7 col-md-8' : 'col-md-12'">
          <h1 class="main-title" v-html="title"></h1>
          <!--<h5 class="main-sub-title" v-if="subTitle">{{ subTitle }} <span v-if="username">{{ username }}</span></h5>-->
          <!--<h5 v-if="hasSubtitle" class="main-sub-title">案件情報</h5>-->
        </div>
        <div v-if="hasBreadcrumb" class="col-sm-5 col-md-4">
          <ol class="breadcrumb float-sm-right">
            <!--<li class="breadcrumb-item">
              <a href="#!">求職者データ管理</a>
            </li>
            <li class="breadcrumb-item active">アカウント情報</li>-->
          </ol>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import { mapGetters, mapActions } from "vuex";


export default {
  name: "Pageheader",
  data() {
    return {
      title: '',
      username:'',
      subTitle:'',
      breadcrum: '',
      /** Constants */
      /** Variables */
    };
  },
  created() {
    this.setTitle(this.$router.currentRoute.name);
  },
  watch: {
    $route(to, from) {
      this.setTitle(to.name);
    }
  },
  computed: {
    ...mapGetters("admin", ["isLogin", "cfgPageheader"]),
    ///
    hasSubtitle: function() {
      return this.cfgPageheader.hasSubtitle;
    },
    hasBreadcrumb: function() {
      return this.cfgPageheader.hasBreadcrumb;
    }
  },
  methods: {
    setTitle(routeName) {
      switch (routeName) {
        case 'admin.dashboard':
          this.title = '求職者データ管理';
          break;
        case 'admin.user.detail':
          this.title = '求職者データ管理';
          break;
        case 'admin.dashboard_company':
          this.title = '求人企業データ管理';
          break;
        case 'admin.company.detail':
          this.title = '求人企業データ管理';
          break;
        default:
          this.title = '求人案件管理';
          break;
      }
    }
  },
};
</script>
