<template>
  <div class="card">
    <div class="card-header">
      <!-- Form -->
      <form class="col-md-12 form-inline job-seeker-frm">
        <!-- Form Group -->
        <div class="form-group row col-md-3 status-input">
          <label for="status" class="col-md-6 col-form-label">ステイタス</label>
          <div class="col-md-6">
            <select2 id="status" class="form-control select2" v-model="searchForm.status">
              <option value="" selected="selected">すべて</option>
              <option :value="i" v-for="(s, i) in kStatuses" :key="i">{{ s }}</option>
            </select2>
          </div>
        </div>
        <!-- End Form Group -->

        <!-- Form Group -->
        <div class="form-group row col-md-7 date-input">
          <label for="created_date" class="col-md-3 col-form-label">作成日</label>
          <div class="col-md-9 row">
            <div class="input-group date col-md-5" id="created_date_from" data-target-input="nearest">
              <date-picker v-model="searchForm.from" name="created_at_f" :config="datepickerConfig" ref="date-picker-f" :placeholder="today"></date-picker>
              <div class="input-group-append" v-on:click="$refs['date-picker-f'].dp.show()" style="cursor:pointer">
                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
              </div>
            </div>
            <span class="col-md-1 separate-icon">~</span>
            <div class="input-group date col-md-5" id="created_date_to" data-target-input="nearest">
              <date-picker v-model="searchForm.to" name="created_at_t" :config="datepickerConfig" ref="date-picker-t" :placeholder="today"></date-picker>
              <div class="input-group-append" v-on:click="$refs['date-picker-t'].dp.show()" style="cursor:pointer">
                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
              </div>
            </div>
          </div>
        </div>
        <!-- End Form Group -->

        <!-- Form Group -->
        <div class="form-group row col-md-2 search-input">
          <div class="col-md-12">
            <div class="input-group" style="width: 100%;">
              <input v-model="searchForm.keywords" type="text" name="table_search" class="form-control float-right" placeholder="Search" />
              <div class="input-group-append">
                <button @click="onclickSearch" type="button" class="btn btn-default" style="min-width: 50px;"><i class="fas fa-search"></i></button>
              </div>
            </div>
          </div>
        </div>
        <!-- End Form Group -->
      </form>
      <!-- Form -->
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive">
      <table class="table table-hover text-nowrap job-seeker-tbl">
        <thead>
          <tr>
            <th>ID</th>
            <th>求人タイトル</th>
            <th>会社名</th>
            <th>作成日</th>
            <th>ステータス</th>
            <th>アクション</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(job, index) in admin.jobs" :key="index">
            <td>{{ job.id }}</td>
            <td>
              <a href="javascript:void(0);" @click="goView(job.id)" :title="job.job_title">{{ job.job_title_sub }}</a>
            </td>
            <td>
              <a href="javascript:void(0);" @click="goCompany(job.company.id)" :title="job.company.company_name">{{ job.company.company_name }}</a>
            </td>
            <td>{{ job.created_at }}</td>
            <!-- <td>{{ job.expried_at }}</td> -->
            <td>{{ kStatuses[job.public] }}</td>
            <td>
              <button class="active-btn" @click="goEdit(job.id)"><i class="fas fa-pencil-alt"></i></button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- /.card-body -->

    <div class="card-footer" v-if="options.page_count > 1">
      <!-- Pagination -->
      <div class="pagination-block">
        <v-pagination v-model="options.page" :page-count="options.page_count" @change="pageChangeHandler"></v-pagination>
      </div>
      <!-- End Pagination -->
    </div>
  </div>
  <!-- /.card -->
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import select2 from "../../Select2";
import vPagination from "../../Pagination_admin";
import datePicker from "vue-bootstrap-datetimepicker";
import moment from "moment";

export default {
  components: {
    select2,
    datePicker,
    vPagination
  },
  data() {
    const kDateFormat = "YYYY/MM/DD";
    const kStatuses = { "1":"審査中", "2":"募集中", "3":"募集停止中" };
    var fromDate = ""; //moment().startOf("month").format(kDateFormat);
    var toDate = ""; //moment().format(kDateFormat);

    return {
      kDateFormat: kDateFormat,
      today: moment().format(kDateFormat),
      searchForm: {
        keywords: "",
        status: "",
        from: fromDate,
        to: toDate
      },
      datepickerConfig: {
        format: kDateFormat,
        useCurrent: false,
        locale: "ja"
      },
      kStatuses: kStatuses,
      admin: {
        jobs: [],
        errors: null
      },
      options: {
        page: 1,
        page_count: 1,
        limit: 1,
        sort: "created_at",
        order: "desc"
      }
    };
  },
  watch: {
    /*
    searchForm: {
      handler: function(val, oldVal) {
        if (val.status || val.keywords.length >= 3 || val.keywords.length == 0) {
          this.loadListManagementJobs();
        }
      },
      deep: true
    }
    // */
  },
  computed: {
    ...mapGetters(["errors", "settings"]),
    ...mapGetters("admin", ["isLogin", "adminData"])
  },
  created() {
    this.$store.commit("admin/updateTabbar", { showTabbar: false });
    this.$store.commit("admin/updatePageheader", { hasSubtitle: false, hasBreadcrumb: false });
    this.options.limit = this.settings.perpage;

    this.loadListManagementJobs();
  },
  mounted() {
    this.$store.commit("setErrors", {});
  },
  methods: {
    ...mapActions("admin", ["getListManagementJobs"]),
    ///
    onclickSearch() {
      this.loadListManagementJobs();
    },
    loadListManagementJobs() {
      let _self = this;
      _self.options.filter = _self.searchForm.status;
      _self.options.from_date = _self.searchForm.from;
      _self.options.to_date = _self.searchForm.to;
      _self.options.keywords = _self.searchForm.keywords;
      _self.getListManagementJobs({ params: _self.options }).then(response => {
        _self.admin.jobs = response.data.items;
        _self.options.page = response.data.page;
        _self.options.page_count = response.data.page_count;
      });
    },
    pageChangeHandler() {
      this.loadListManagementJobs();
    },
    goView(id) {
      this.$router.push({ name: "admin.job.view", params: { id: id } });
    },
    goEdit(id) {
      this.$router.push({ name: "admin.job.edit", params: { id: id } });
    },
    goCompany(id) {
      this.$router.push({ name: "admin.company.detail", params: { id: id } });
    },
  }
};
</script>
