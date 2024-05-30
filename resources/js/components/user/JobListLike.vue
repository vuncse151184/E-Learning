<template>
  <section class="job-lst-cont">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="section-title-02 mb-4">
            <h4>気になる</h4>
          </div>
          <div class="form-row mb-5 frm-dashboard-block">
            <div class="col-12" v-for="(job, index) in user.jobs" :key="index">
              <div class="job-list">
                <div class="job-list-details">
                  <a href="javascript:void(0);" @click.once="goDetail(job.id)">{{ job.job_title }}</a>
                </div>
                <div class="job-list-favourite-time">
                  <a class="job-list-favourite order-2 mb-0" href="javascript:void(0)"><i class="fas fa-heart" :class="`${liked ? 'text-danger' : ''}`" @click="disLikeJob(job.likes)"></i></a>
                </div>
              </div>
            </div>
          </div>
          <div class="row" v-if="options.page_count > 1">
            <div class="col-12 text-center mt-4">
              <v-pagination v-model="options.page" :page-count="options.page_count" @change="pageChangeHandler"></v-pagination>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import vPagination from "../Pagination";
export default {
  components: {
    vPagination
  },
  data() {
    return {
      user: {
        jobs: [],
        errors: null
      },
      options: {
        page: 1,
        page_count: 1,
        limit: 1,
        sort: "updated_at",
        order: "desc"
      },
      liked: true
    };
  },
  computed: {
    ...mapGetters(["errors", "settings"]),
    ...mapGetters("user", ["userData"])
  },
  created() {
    this.$store.commit("setTemplates", { breadcrumb: false, footerFixed: true, menu_title: document.title });
    this.loadJobsByUser();
    this.options.limit = this.settings.perpage;
  },
  mounted() {
    this.$store.commit("setErrors", {});
    this.liked = true;
  },
  methods: {
    ...mapActions("user", ["getJobsLikedByUser", "sendDisLikeJob"]),
    loadJobsByUser() {
      let _self = this;
      _self.getJobsLikedByUser(_self.options).then(response => {
        _self.user.jobs = response.data.items;
        _self.options.page = response.data.page;
        _self.options.page_count = response.data.page_count;
      });
    },
    pageChangeHandler() {
      let _self = this;
      _self.loadJobsByUser();
    },
    async disLikeJob(data) {
      let _self = this;
      await _self.sendDisLikeJob(data).then(response => {
        _self.loadJobsByUser();
      });
    },
    goDetail(id) {
      this.$router.push({ name: "job.details", params: { id: id } });
    }
  }
};
</script>
