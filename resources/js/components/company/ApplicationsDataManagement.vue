<template>
  <section class="job-lst-cont">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="user-dashboard-info-box mb-0">
            <!-- Applicant Top -->
            <div class="applicant-top">
              <div class="row">
                <div class="search col-md-6">
                  <i class="fas fa-search"></i>
                  <input class="form-control" type="text" placeholder="検索する" v-model="keywords" />
                </div>

                <div class="form-group select-border col-md-4 form-inline">
                  <label class="justify-content-start mr-2">表示</label>
                  <div class="short-by">
                    <select2 class="form-control" v-model="filter">
                      <option value="" selected="selected">すべて</option>
                      <option :value="index" v-for="(status, index) in application_status" :key="index">{{ status }}</option>
                    </select2>
                  </div>
                </div>
              </div>
            </div>
            <!-- End Applicant Top -->
            <!-- Tab Wrapper -->
            <div class="tab-wrapper" v-if="company.jobs.length">
              <!-- Table Wrapper -->
              <div class="table-responsive pb-4 mb-0">
                <table class="table applicant-tbl mb-0">
                  <colgroup>
                    <col width="15%" />
                    <col width="25%" />
                    <col width="30%" />
                    <col width="15%" />
                    <col width="15%" />
                  </colgroup>
                  <thead>
                    <tr>
                      <th>応募日</th>
                      <th>求職者</th>
                      <th>求人案件名</th>
                      <th>進歩状況</th>
                      <th>ダウンロード</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr class="applicant-list" v-for="(item, k) in company.jobs" :key="k">
                      <td>{{ item.application_date }}</td>
                      <td>
                        <figure class="applicant-pic">
                          <img :src="item.user.logo_src" :alt="item.user.complete_name" />
                          <figcaption>
                            <h5>{{ item.user.name }}</h5>
                            <p>{{ item.user.furigana }}</p>
                          </figcaption>
                        </figure>
                      </td>
                      <td>
                        <a class="applicant-link" href="javascript:void(0);" @click.once="goDetail(item.job.id)" :title="item.job.job_title">{{ item.job.job_title }}</a>
                      </td>
                      <td>
                        <div class="form-group select-border applicant-select">
                          <select2 class="form-control basic-select" v-model="item.status" @update="onChangeFilter(`[${item.job.id},${item.user.id},${item.status}]`)">
                            <option value="" disabled>意思確認中</option>
                            <option :value="index" v-for="(status, index) in application_status" :key="index">{{ status }}</option>
                          </select2>
                        </div>
                      </td>
                      <td>
                        <button class="applicant-btn" @click="entryForm(item)" :class="{ 'app-disable': !item.allows.view }">
                          <i class="fas fa-eye"></i>
                        </button>
                        <button class="applicant-btn" @click.once="download(item)" :key="buttonKey" :disabled="btnDisable" v-if="item.allows.download">
                          <i class="fa fa-download" aria-hidden="true"></i>
                        </button>
                        <button class="applicant-btn app-disable" v-else>
                          <i class="fa fa-download" aria-hidden="true"></i>
                        </button>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="row" v-if="options.page_count > 1">
                <div class="col-12 text-center mt-4">
                  <v-pagination v-model="options.page" :page-count="options.page_count" @change="pageChangeHandler"></v-pagination>
                </div>
              </div>
              <!-- End Table Wrapper -->
            </div>
            <!-- End Tab Wrapper -->
            <p v-else>現在、応募はありません。</p>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import select2 from "./../Select2";
import vPagination from "./../Pagination_admin";
export default {
  components: {
    select2,
    vPagination
  },
  data() {
    return {
      filter: "",
      keywords: "",
      company: {
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
      application_status: [],
      data_update: "",
      buttonKey: 1,
      btnDisable: false
    };
  },
  computed: {
    ...mapGetters(["errors", "settings"]),
    ...mapGetters("company", ["companyData"])
  },
  created() {
    this.$store.commit("setTemplates", {
      breadcrumb: false,
      menu_title: document.title
    });
    this.loadJobsByCompany();
    this.options.limit = this.settings.perpage;
  },
  mounted() {
    this.$store.commit("setErrors", {});
    this.$store.commit("setTemplates", { footerFixed: true });
    this.application_status = this.settings.application_status;
  },
  watch: {
    keywords: function(newVal) {
      if (newVal.length || newVal.length == 0) {
        this.searchKeyword();
      }
    },
    filter: function(filterValue) {
      this.loadJobsByCompany();
    }
  },
  methods: {
    ...mapActions("company", ["getApplicationsData", "changeApplicationStatus", "sendApplicationDownload"]),
    loadJobsByCompany() {
      let _self = this;
      _self.options.filter = _self.filter;
      _self.options.search = _self.keywords;
      _self.getApplicationsData({ params: _self.options }).then(response => {
        _self.company.jobs = response.data.items;
        _self.options.page = response.data.page;
        _self.options.page_count = response.data.page_count;
      });
    },
    pageChangeHandler() {
      this.loadJobsByCompany();
    },
    searchKeyword() {
      this.loadJobsByCompany();
    },
    onChangeFilter(data_update) {
      this.data_update = data_update;
      this.showDialogConfirm();
    },
    showDialogConfirm() {
      const params = {
        title: "確認",
        text: "進歩状況を更新しますか？",
        onConfirm: () => {
          return this.changeStatus();
        },
        onHide: () => {
          return this.loadJobsByCompany();
        }
      };
      this.$modal.dialogConfirm(params);
    },
    changeStatus() {
      let _self = this;
      let _options = JSON.parse(this.data_update);
      _self.changeApplicationStatus(_options).then(res => {
        _self.loadJobsByCompany();
      });
    },
    goDetail(id) {
      let routeData = this.$router.resolve({ name: "job.details", params: { id: id } });
      window.open(routeData.href, "_blank");
    },
    entryForm(obj) {
      let params = {
        title: "エントリーフォーム",
        user: obj.user
      };
      this.$modal.dialogEntryForm(params);
    },
    download(obj) {
      let _self = this;
      const params = {
        id: obj.user.id,
        application_date: obj.application_date
      };
      _self
        .sendApplicationDownload({ params })
        .then(response => {
          _self.forceFileDownload(response);
          _self.setTimeout(1000);
        })
        .catch(function() {
          _self.setTimeout();
        });
    },
    async setTimeout(timer = 0) {
      return setTimeout(() => {
        this.buttonKey++;
        this.btnDisable = false;
      }, timer);
    },
    forceFileDownload(response) {
      let filename = "";
      let disposition = response.headers["content-disposition"];
      if (disposition && disposition.indexOf("attachment") !== -1) {
        let filenameRegex = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/,
          matches = filenameRegex.exec(disposition);
        if (matches != null && matches[1]) {
          filename = matches[1].replace(/['"]/g, "");
        }
      }
      const link = document.createElement("a");
      link.href = "/downloads/" + filename;
      link.download = filename;
      link.target = "_blank";
      link.setAttribute("type", "hidden");
      document.body.appendChild(link);
      link.click();
      link.remove();
    }
  }
};
</script>
