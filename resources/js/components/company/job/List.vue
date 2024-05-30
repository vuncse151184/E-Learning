<template>
  <section v-if="hasNoJob" class="job-list-cont">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <form class="mt-4">
            <!-- Button Block-->
            <div class="col-md-12 my-5 mx-auto">
              <p class="mb-5">求人情報はありません。</p>
              <a class="btn blue-btn btn-lg" v-on:click="onclickAddJob" href="javascript:void(0)" title="新しい求人を追加"><i class="fas fa-plus"></i> 新しい求人を追加</a>
            </div>
            <!-- End Button Block-->
          </form>
        </div>
      </div>
    </div>
  </section>
  <section v-else class="job-lst-cont">
    <div class="container">
      <v-alert v-if="pageAlert" ref="page-alert" :type="pageAlert.type" :messages="pageAlert.message" autoscroll dismissible></v-alert>
      <div class="row">
        <div class="col-md-12">
          <div class="user-dashboard-info-box mb-0">
            <!-- Tab Wrapper -->
            <div class="tab-wrapper">

              <!-- Tab List -->
              <div class="browse-job d-flex border-0">
                <ul class="nav nav-tabs d-flex" id="myTab" role="tablist">
                  <li class="nav-item">
                    <a @click="onclickFilter(kPublic.ByAdmin)"    class="nav-link" id="tab-01" data-toggle="tab" href="#" role="tab" aria-controls="recruit" aria-selected="true">募集中(<span>{{numByAdmin}}</span>)</a>
                  </li>
                  <li class="nav-item">
                    <a @click="onclickFilter(kPublic.ByCompany)"  class="nav-link" id="tab-02" data-toggle="tab" href="#" role="tab" aria-controls="review" aria-selected="false">審査中(<span>{{numByCompany}}</span>)</a>
                  </li>
                  <li class="nav-item">
                    <a @click="onclickFilter(kPublic.Draft)"      class="nav-link active" id="tab-03" data-toggle="tab" href="#" role="tab" aria-controls="draft" aria-selected="false">下書き(<span>{{numDraft}}</span>)</a>
                  </li>
                  <li class="nav-item">
                    <a @click="onclickFilter(kPublic.Stop)"       class="nav-link" id="tab-04" data-toggle="tab" href="#" role="tab" aria-controls="profile" aria-selected="false">募集停止中(<span>{{numStop}}</span>)</a>
                  </li>
                </ul>
              </div>
              <!-- End Tab List -->

              <!-- Tab Content -->
              <div class="tab-content" id="myTabContent">
                <!-- <div class="tab-pane fade show" id="recruit" role="tabpanel" aria-labelledby="tab-01">
                  <h4>This is Tab Recruit - 募集中</h4>
                </div>
                <div class="tab-pane fade show" id="review" role="tabpanel" aria-labelledby="tab-02">
                  <h4>This is Tab Review - 審査中</h4>
                </div>
                <div class="tab-pane fade show" id="draft" role="tabpanel" aria-labelledby="tab-03">
                  <h4>This is Tab Draft - 下書き</h4>
                </div> -->
                <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="tab-04">
                  <!-- Table Wrapper -->
                  <div class="table-responsive pb-4 mb-0">
                    <table class="table job-data-tbl mb-0">
                      <thead>
                        <tr>
                          <th></th>
                          <th class="text-left">求人タイトル</th>
                          <th class="text-center">PV数</th>
                          <th class="action text-center">候補者</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="(item, k) in _jobs" v-bind:key="k" class="candidates-list">
                          <td class="img-data">
                            <div class="thumb-img">
                              <img class="img-fluid" :src="getJobImage(item)" alt="">
                            </div>
                          </td>
                          <td class="title">
                            <div class="candidate-list-details">
                              <div class="candidate-list-info">
                                <div class="candidate-list-title">
                                  <h5 class="mb-0">
                                    <router-link :to="{name: 'company.job.show', params: {id: item.id}}" v-html="item.job_title"></router-link>
                                  </h5>
                                </div>
                                <div class="candidate-info">
                                  <!-- <span class="candidate-id">ID123abc45</span> -->
                                  <span class="candidate-date">{{formatDate(item.created_at)}}</span>
                                </div>
                                <div class="candidate-info">
                                  <a v-on:click="onclickCopy(item.id)" href="javascript:void(0)">
                                    <span class="candidate-id bluelight-text">コピーする <i class="far fa-clone"></i></span>
                                  </a>
                                  
                                </div>
                              </div>
                            </div>
                          </td>
                          <td class="candidate-list-favourite-time text-center">{{item.count_views}} pv</td>
                          <td class="candidate-alternate">
                            <p><span @click="onclickAppList(item.id)" class="bluelight-text">{{countCandidate(item.id)}}</span>人<br>ブックマークされた数({{countLike(item.id)}})</p>
                          </td>
                          <td class="candidate-list-favourite-time text-center">
                            <button v-if="canShowDetail(item)" @click="onclickShowDetail(item)" class="applicant-btn" ><i class="fas fa-eye"></i></button>
                            <button v-else class="applicant-btn app-disable"><i class="fas fa-eye"></i></button>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <!-- End Table Wrapper -->
                  <div class="pagination-block" v-if="jobsPagination && jobsPagination.total > 1">
                    <div class="col-12 text-center mt-4">
                      <v-pagination  v-model="jobsPagination.current_page" 
                      :page-count="jobsPagination.last_page" @change="onchangePage"
                      :classes="paginationClasses" :labels="paginationLabels"></v-pagination>
                    </div>
                  </div>
                  <!-- Button Block-->
                  <div class="col-md-12 my-3 mx-auto">
                    <a class="btn blue-btn btn-lg" v-on:click="onclickAddJob" href="javascript:void(0)" title="新しい求人を追加"><i class="fas fa-plus"></i> 新しい求人を追加</a>
                  </div>
                  <!-- End Button Block-->
                </div>
              </div>
              <!-- End Tab Content -->
            </div>
            <!-- End Tab Wrapper -->
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import vPagination from "../../Pagination_admin";
import moment from "moment";
import vAlert from "../../Alert";


export default {
  components: {
    vPagination, vAlert
  },
  data() {
    const kDefaultImage = "/assets/img/job-data-img.png";
    const kDateFormat = "YYYY/MM/DD";
    const kPublic = { Default: 0, Draft: 0, ByCompany: 1, ByAdmin: 2, Stop: 3 };

    return {
      /** Constant */
      kPublic: kPublic,
      kDateFormat: kDateFormat,
      kDefaultImage : kDefaultImage,
      kFinishRegister: {OK: 1, NG: 0},
      paginationLabels : {
        first: '<a href="#!" class="page-link"><i class="fas fa-fast-backward"></i></a>',
        prev: '<a href="#!" class="page-link"><i class="fas fa-angle-double-left"></i></a>',
        next: '<a href="#!" class="page-link"><i class="fas fa-angle-double-right"></i></a>',
        last: '<a href="#!" class="page-link"><i class="fas fa-fast-forward"></i></a>'
      },
      paginationClasses : {
        ul: "pagination",
      },
      /** Variables */
      /// Data statistic by public type
      numDraft: 0,
      numByAdmin: 0,
      numByCompany: 0,
      numStop: 0,
      /// Error for alert
      pageAlert: null,
      /// Number of likes of jobs
      likes: [],
      /// Number of candidates of jobs
      candidates: [],
      /// For control click paging
      publicType: kPublic.Default,
      queueSearchJob: [],
      timeoutSearchJob: null,
      /// Pagination of list jobs
      jobsPagination: null
    };
  },
  computed: {
    ...mapGetters("company", ["companyData"]),
    ///
    _jobs: function() {
      if (this.jobsPagination && this.jobsPagination.data) {
        return this.jobsPagination.data;
      }
      return []
    },
    hasJob: function () {
      if (this.numDraft || this.numByCompany || this.numByAdmin || this.numStop) {
        return true;
      }
      return false;
    },
    hasNoJob: function () {
      return !this.hasJob;
    }
  },
  created() {
  },
  mounted() {
    this.$store.commit("setTemplates", { footerFixed: true });
    this.reqStatisticByPublic({});
    var data2Send = { public_type: this.kPublic.Default, current_page: 1 };
    this.reqSearchJob(data2Send);
  },
  methods: {
    ...mapActions("company", ["sendSearchJobRequest", "sendStatisticByPublicRequest", "sendCopyJobRequest", "sendGetJobsRequest"]),
    ///
    canShowDetail: function(job) {
      return job.public == this.kPublic.ByAdmin;
    },
    onclickShowDetail(job) {
      let routeData = this.$router.resolve({name: 'job.details', params:{id: job.id}, });
      window.open(routeData.href, '_blank');
    },
    onclickFilter(publicType) {
      this.publicType = publicType;
      var data2Send = { public_type: publicType, current_page: 1 };
      this.reqSearchJob(data2Send);
    },
    setPageAlert(type, message) {
      this.pageAlert = { type: type, message: message };
    },
    clearAlert() {
      this.pageAlert = null;
    },
    onclickCopy(jobId) {
      this.clearAlert();
      const params = {
        title: "", text: "複製しますか？",
        txtOk: "確認", txtCancel: "キャンセル", hasHeader: false,
        onConfirm: () => {
          var data2Send = {id: jobId};
          this.sendCopyJobRequest(data2Send).then(
            (resp) => {
              let data = resp.data;
              
              if (data.status == 'error') {
                this.setPageAlert(vAlert.Type.Danger, data.messages);
                return;
              }
              let newJob = data.payload.job;
              this.$router.push({ name: 'company.job.edit', params:{id: newJob.id} });
            },
            error => {
            }
          );
        }
      };
      this.$modal.dialogConfirm(params);
    },
    countLike(jobId) {
      if (jobId in this.likes) {
        if (this.likes[jobId]) {
          return this.likes[jobId].length;
        }
      }
      return 0;
    },
    countCandidate(jobId) {
      if (jobId in this.candidates) {
        if (this.candidates[jobId]) {
          return this.candidates[jobId].length;
        }
      }
      return 0;
    },
    formatDate(dateStr) {
        return moment(dateStr).format(this.kDateFormat);
    },
    onclickAppList(jobId) {
      const params = {
        job_id: jobId
      };
      this.$modal.dialogAppList(params);
    },
    onshowConfirmUpdateCompanyInfo() {
      const params = {
        title: "", text: "求人情報を入力する前に、企業情報を登録する必要があります。",
        txtOk: "企業情報を登録", txtCancel: "キャンセル", hasHeader: false,
        onConfirm: () => {
          this.$router.push({ name: 'company.edit' });
        }
      };
      this.$modal.dialogConfirm(params);
    },
    onchangePage() {
      clearTimeout(this.timeoutSearchJob);
      var data2Send = { public_type: this.publicType, current_page: this.jobsPagination.current_page };
      this.queueSearchJob.push(data2Send);
      this.timeoutSearchJob = setTimeout(() => {
        var data2Send = this.queueSearchJob.pop();
        this.queueSearchJob = [];
        
        if(data2Send) {
          this.reqSearchJob(data2Send);
        }
      }, 250);
    },
    reqStatisticByPublic(data2Send) {
      this.sendStatisticByPublicRequest(data2Send).then(
        (resp) => {
          let data = resp.data;
          this.numByAdmin = data.num_by_admin;
          this.numByCompany = data.num_by_company;
          this.numDraft = data.num_draft;
          this.numStop = data.num_stop;
        },
        error => {
        }
      );
    },
    reqListJobs(data2Send) {
      this.sendGetJobsRequest(data2Send).then(
        (resp) => {
          if(this.queueSearchJob.length == 0) {
            this.jobsPagination = resp.data.pagination;
            this.candidates = resp.data.candidates;
            this.likes = resp.data.likes;
          }
        },
        error => {
        }
      );
    },
    /** 
     * data2Send = { public_type: kPublic.XXXX, current_page: Int }
    */
    reqSearchJob(data2Send) {
      this.sendSearchJobRequest(data2Send).then(
        (resp) => {
          this.jobsPagination = resp.data.pagination;
          this.candidates = resp.data.candidates;
          this.likes = resp.data.likes;
          this.$_scrollTop();
        },
        error => {
        }
      );
    },
    /** Get job.images from a Job */
    getJobImage(job) {
      if (job.images) {
        return job.images;
      }
      return this.kDefaultImage;
    },
    onclickAddJob() {
      if (this.companyData.finish_register == this.kFinishRegister.OK) {
        this.$router.push({ name: "company.job.create" });
      }
      else {
        this.onshowConfirmUpdateCompanyInfo();
      }
    }
  },
};

</script>
