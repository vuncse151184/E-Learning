<template>
  <section class="job-lst-cont">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="section-title-02 mb-4">
            <h4>応募履歴の管理</h4>
          </div>
          <div class="form-row mb-5 frm-dashboard-block">
            <div class="user-dashboard-table table-responsive">
              <table class="table table-bordered manage-candidates-top mb-0">
                <thead class="bg-light">
                  <tr class="text-center">
                    <th scope="col">応募日</th>
                    <th scope="col">求人案件名</th>
                    <th scope="col">応募状況</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="text-center" v-for="(job, index) in user.jobs" :key="index">
                    <td>{{ job.histories.application_date }}</td>
                    <td class="text-left">
                      <a href="javascript:void(0);" @click.once="goDetail(job.id)">{{ job.job_title }}</a>
                    </td>
                    <td v-bind:status-id="job.histories.status_id">{{ job.histories.status_name }}</td>
                  </tr>
                </tbody>
              </table>
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
      }
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
  },
  methods: {
    ...mapActions("user", ["getApplicationHistoriesByUser"]),
    loadJobsByUser() {
      let _self = this;
      _self.getApplicationHistoriesByUser(_self.options).then(response => {
        _self.user.jobs = response.data.items;
        _self.options.page = response.data.page;
        _self.options.page_count = response.data.page_count;
      });
    },
    pageChangeHandler() {
      this.loadJobsByUser();
    },
    goDetail(id) {
      this.$router.push({ name: "job.details", params: { id: id } });
    }
  }
};
</script>
