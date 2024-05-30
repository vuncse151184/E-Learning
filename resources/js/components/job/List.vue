<template>
  <div>
    <search-bar ref="search-bar" v-model="search_options" @searchbar-click="onClickSearchJob"></search-bar>
    <!--=================================
    job-grid -->
    <section class="space-ptb">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <!--=================================
            right-sidebar -->
            <div class="row mb-4">
              <div class="col-12">
                <h6 class="mb-0">
                  <span class="text-primary">{{ jobs.total ? jobs.total : 0 }}</span> 件中{{ jobs.from ? jobs.from : 0 }}-{{ jobs.to ? jobs.to : 0 }}件を表示
                </h6>
              </div>
            </div>
            <div class="row job-item-wrap">
              <!-- Job Item -->
              <div class="col-md-6 job-item" v-for="(job, key) in jobs.data" v-bind:key="key">
                <div class="job-list job-grid">
                  <div class="job-list-logo">
                    <a :href="'/job/' + job.id" :title="job.job_title">
                      <img class="img-fluid" onerror="this.src='/assets/img/test-img-476x476.png'" :src="job.images ? job.images : '/assets/img/test-img-476x476.png'" :alt="job.job_title" />
                    </a>
                  </div>
                  <div class="job-list-details">
                    <div class="job-list-info">
                      <div class="job-list-title">
                        <h5>
                          <router-link :to="{ name: 'job.details', params: { id: job.id } }" :title="job.job_title" v-html="job.job_title"></router-link>
                        </h5>
                        <p v-html="job.recruitment_overview"></p>
                      </div>
                      <div class="job-list-option">
                        <ul class="list-unstyled job-tag-lst">
                          <li>
                            <router-link :to="{ name: 'job.list', query: { job_category: job.category.id } }" class="job-tag">
                              <i class="fas fa-folder pr-1"></i>
                              {{ job.category ? job.category.name : "" }}
                            </router-link>
                          </li>
                          <li>
                            <router-link :to="{ name: 'job.list', query: { work_style: job.category.id } }" class="job-tag">
                              <i class="fas fa-clock pr-1"></i>
                              {{ job.style ? job.style.name : "" }}
                            </router-link>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="job-list-favourite-time">
                    <a class="job-list-favourite order-2" v-on:click="like(job.id, key)" href="javascript:void(0)">
                      <i :class="'fas fa-heart' + (job.liked ? ' text-danger' : '')"></i>
                    </a>
                  </div>
                </div>
              </div>
              <!-- End Job Item -->
            </div>
            <div class="row">
              <div class="col-12 text-center mt-4">
                <p v-if="!jobs.data" class="col-12 text-center">読み込み中...</p>
                <p v-else-if="!jobs.data.length" class="col-12 text-center" v-html="trans.get('messages.M130')"></p>
                <v-pagination v-else-if="jobs.last_page > 1" v-model="jobs.current_page" :page-count="jobs.last_page" @change="pageChangeHandler"></v-pagination>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <Feature />
    <footer-nav />
    <DialogLogin v-if="!isLogin" />
  </div>
</template>
<script>
import { mapGetters, mapActions } from "vuex";
import vPagination from "../Pagination";
import SearchBar from "./SearchBar";
import select2 from "../Select2";
import Feature from "./Feature";
import FooterNav from "../layouts/inc/FooterNav";
import DialogLogin from "./../../modals/DialogLogin";
export default {
  data() {
    return {
      enpoint: "job",
      jobs: {},
      search_options: {
        keyword: "",
        work_style: "",
        job_category: ""
      },
      render: 1
    };
  },
  watch: {
    $route: "searchJob"
  },
  computed: {
    ...mapGetters("user", ["isLogin", "userData"])
  },
  created() {
    this.axiosConfig();
  },
  mounted() {
    this.$store.commit("setErrors", {});
    this.searchJob();
  },
  methods: {
    pageChangeHandler(e) {
      this.jobs.job_list = [];
      this.searchJob();
    },
    async like(job_id, job_key) {
      if (!this.userData) {
        let params = {
          title: "ログイン",
          onPopup: res => {
            return setTimeout(() => {
              this.actionLike(job_id, job_key);
            }, 500);
          }
        };
        this.$modal.dialogLogin(params);
      } else {
        this.actionLike(job_id, job_key);
      }
    },
    async actionLike(job_id, job_key) {
      let _this = this;
      await axios.post(this.enpoint + "/like/" + job_id).then(
        res => {
          if (_this.jobs && _this.jobs.data) {
            _this.jobs.data[job_key].liked = res.data;
          } else {
            _this.searchJob();
          }
        },
        error => {}
      );
    },
    onClickSearchJob() {
      this.jobs.current_page = 1;
      let queries = {};
      for (let i in this.search_options) {
        if (this.search_options[i]) {
          queries[i] = this.search_options[i];
        }
      }
      let currentRouteName = this.$router.currentRoute.name;
      let currentQueries = this.$router.currentRoute.query;
      let isReplaceRoute = currentQueries.keyword == queries.keyword && currentQueries.job_category == queries.job_category && currentQueries.work_style == queries.work_style;
      if (isReplaceRoute) {
        return this.searchJob();
      }
      this.$router.push({ name: currentRouteName, query: queries }).catch(() => {});
    },
    getSearchOptions() {
      this.search_options.job_category = this.$route.query.job_category ? this.$route.query.job_category : "";
      this.search_options.work_style = this.$route.query.work_style ? this.$route.query.work_style : "";
      this.search_options.keyword = this.$route.query.keyword ? this.$route.query.keyword : "";
    },
    async searchJob() {
      this.$_loadingIcon("show");
      this.getSearchOptions();
      let url =
        this.enpoint +
        "?page=" +
        (this.jobs.current_page ? this.jobs.current_page : 1) +
        (this.search_options.keyword ? "&keyword=" + encodeURIComponent(this.search_options.keyword) : "") +
        (this.search_options.work_style ? "&work_style=" + this.search_options.work_style : "") +
        (this.search_options.job_category ? "&job_category=" + this.search_options.job_category : "");
      this.jobs = {};
      await axios.get(url).then(
        res => {
          this.jobs = res.data;
          this.$_loadingIcon("hide");
        },
        error => {
          console.log(error.response.data);
          this.$_loadingIcon("hide");
        }
      );
    },
    showLoginDialog(redirecUrl, callback) {
      const params = {
        title: "ログイン",
        redirecUrl: redirecUrl
      };
      if (callback) {
        params.callback = callback;
      }
      this.$modal.dialogLogin(params);
    },
    axiosConfig() {
      axios.interceptors.request.use(function(config) {
        config.dontRedirectToLogin = true;
        return config;
      });
    }
  },
  components: {
    vPagination,
    SearchBar,
    select2,
    Feature,
    DialogLogin,
    FooterNav
  }
};
</script>
