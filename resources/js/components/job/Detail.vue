<template>
  <div>
    <search-bar ref="search-bar" v-model="search_options" @searchbar-click="onClickSearchJobs"></search-bar>
    <section v-if="!notFound" class="space-ptb">
      <div class="container">
        <div class="row mb-5" v-if="!loading">
          <div class="col-lg-8">
            <div class="job-detail job-detail-bdr">
              <div class="mb-4">
                <img class="img-fluid" onerror="this.src='/assets/img/job-detail.png'" :src="job.images ? job.images : '/assets/img/job-detail.png'" :alt="job.job_title" />
              </div>
              <h5 class="mb-3 mb-md-4" v-html="job.job_title"></h5>
              <p v-html="job.recruitment_overview"></p>
            </div>
            <div class="job-detail">
              <h5 class="mb-3 mb-md-4">職種</h5>
              <p v-html="job.category ? job.category.name : ''"></p>
            </div>
            <hr />
            <div class="job-detail">
              <h5 class="mb-3 mb-md-4">仕事内容</h5>
              <p>{{ job.work_content }}</p>
            </div>
            <hr />
            <div class="job-detail">
              <h5 class="mb-3 mb-md-4">働き方</h5>
              <p v-html="job.style ? job.style.name : ''"></p>
            </div>
            <template v-if="job.skill_experience">
              <hr />
              <div class="job-detail">
                <h5 class="mb-3 mb-md-4">得られるスキル</h5>
                <p>{{ job.skill_experience }}</p>
              </div>
            </template>
            <template v-if="job.attraction">
              <hr />
              <div class="job-detail">
                <h5 class="mb-3 mb-md-4">魅力</h5>
                <p>{{ job.attraction }}</p>
              </div>
            </template>
            <hr />
            <div class="job-detail">
              <h5 class="mb-3 mb-md-4">給与・報酬</h5>
              <p>{{ job.salary_system ? job.salary_system.name : "" }}/{{ job.salary_from }}円～{{ job.salary_to }}円</p>
            </div>
            <hr />
            <div class="job-detail">
              <h5 class="mb-3 mb-md-4">勤務地</h5>
              <p>{{ getWorkLocationName(job.work_location) }}</p>
            </div>
            <template v-if="job.requirement_skill">
              <hr />
              <div class="job-detail">
                <h5 class="mb-3 mb-md-4">必要なスキル・経験</h5>
                <p>{{ job.requirement_skill }}</p>
              </div>
            </template>
            <hr />
            <div class="col-md-12 mt-5">
              <a
                class="btn yellow-btn"
                :class="{ job_applied: job.applied }"
                v-on="!job.applied ? { click: clickApply } : null"
                :key="buttonKey"
                ref="apply-button"
                href="javascript:void(0)"
                :title="job.applied ? 'エントリー済み' : 'この仕事をエントリーする'"
                v-html="job.applied ? 'エントリー済み' : 'この仕事をエントリーする'"
                v-if="mode == 'public'"
              >
              </a>
              <button class="job-list-favourite my-0 ml-2" v-on:click="like(job.id)" v-if="mode == 'public'">
                <i :class="'fas fa-heart' + (job.liked ? ' text-danger' : '')"></i>
              </button>
            </div>
          </div>
          <!--=================================
              sidebar -->
          <div class="col-lg-4 mt-4 mt-lg-0">
            <div class="sidebar mb-0">
              <h5 class="job-side-title">おすすめ求人</h5>

              <div class="job-side-detail" v-for="(recommend, key) in job.recommended">
                <div class="mb-2">
                  <img class="img-fluid" onerror="this.src='/assets/img/job-detail.png'" :src="recommend.images ? recommend.images : '/assets/img/job-detail.png'" :alt="recommend.job_title" />
                </div>
                <p>
                  <router-link :to="{ name: 'job.details', params: { id: recommend.id } }" :title="recommend.job_title">{{ recommend.job_title }}</router-link>
                </p>
              </div>
            </div>
          </div>
          <!--=================================
              sidebar -->
        </div>
        <p class="col-12 text-center" v-else>読み込み中...</p>
      </div>
    </section>
    <PageNotFound v-else />
    <div v-if="user" class="modal fade" ref="not-finish-model" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header p-4">
            <h5 class="mb-0 text-center">この仕事をエントリーする</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true"><i class="fas fa-times"></i></span>
            </button>
          </div>
          <div class="modal-body">
            <div class="text-center">
              <div class="tab-content">
                <div class="tab-pane active" id="candidate" role="tabpanel">
                  <h6 class="font-weight-normal mt-3 mb-5">Webレジュメもしくは履歴書・職務経歴書の登録がされていません。<br />求人案件に応募するためには、少なくともどちらか一方の登録が必要です。</h6>
                  <form class="mt-4">
                    <div class="form-row justify-content-md-center">
                      <div class="col-md-12">
                        <button @click="goWebResum" data-dismiss="modal" class="btn blue-btn mb-3" title="WEBレジュメ">WEBレジュメ</button>
                        <button @click="goResumeRegistration" class="btn blue-btn mb-3" data-dismiss="modal" title="レジュメ登録">レジュメ登録</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div v-if="user" class="modal fade" ref="apply-mothods-model" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header p-4">
            <h5 class="mb-0 text-center">この仕事をエントリーする</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true"><i class="fas fa-times"></i></span>
            </button>
          </div>
          <div class="modal-body">
            <div class="text-center row justify-content-center">
              <div class="tab-content col-md-8">
                <ValidationObserver ref="options-validation">
                  <ValidationProvider mode="eager" name="履歴書" v-slot="{ errors }" rules="required" slim>
                    <h6 class="font-weight-normal mt-3 mb-3">この求人に応募する際に使用する履歴書を選択してください。</h6>
                    <small class="form-text text-error" v-if="errors[0]">{{ errors[0] }}</small>
                    <form>
                      <div class="col-md-6 text-left">
                        <!-- Form group -->
                        <div class="form-group">
                          <div class="custom-control custom-checkbox mb-2">
                            <input :disabled="!user.finish_register" type="checkbox" class="custom-control-input" id="web_resume" :value="1" v-model="applyOptions" />
                            <label class="custom-control-label" for="web_resume">Webレジュメ</label>
                          </div>
                          <div class="custom-control custom-checkbox">
                            <input :disabled="!user.curriculum_vitae && !user.resume" type="checkbox" class="custom-control-input" id="cv_resume" :value="2" v-model="applyOptions" />
                            <label class="custom-control-label" for="cv_resume">履歴書・職務経歴書登録</label>
                          </div>
                        </div>
                        <!-- End Form group -->
                      </div>
                      <div class="form-row justify-content-md-center">
                        <div class="col-md-12">
                          <a class="btn blue-btn mb-3" v-on:click="validateOptions" title="次へ">次へ</a>
                          <a class="btn trans-btn mb-3" data-dismiss="modal" title="キャンセル">キャンセル</a>
                        </div>
                      </div>
                    </form>
                  </ValidationProvider>
                </ValidationObserver>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div v-if="user" class="modal fade" ref="confirm-model" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header p-4">
            <h5 class="mb-0 text-center">エントリーフォーム</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true"><i class="fas fa-times"></i></span>
            </button>
          </div>
          <!-- Modal Body -->
          <div class="modal-body">
            <WebResume v-if="applyOptions.indexOf(1) >= 0 && turnonWebResume" :view-mode="true" />
            <template v-if="applyOptions.indexOf(2) >= 0">
              <h4 class="m-3">履歴書・職務経歴書登録</h4>
              <section class="job-lst-cont m-3" style="margin-bottom: 0px;">
                <div class="form-row mb-5 frm-dashboard-block resum-registration">
                  <div class="form-group col-md-12 mb-2">
                    <label class="mb-2 upload-title" for="school">履歴書</label>
                    <a target="_blank" :href="user.resume_src"><p class="text-underline" v-html="user.resume"></p></a>
                  </div>
                  <div class="form-group col-md-12 mb-2">
                    <label class="mb-2 upload-title" for="school">職務経歴書</label>
                    <a target="_blank" :href="user.curriculum_vitae_src"><p class="text-underline" v-html="user.curriculum_vitae"></p></a>
                  </div>
                </div>
              </section>
            </template>
            <div class="form-row justify-content-md-center">
              <div class="col-md-12 text-center">
                <a class="btn gray-btn mb-3" v-on:click="clickApply" data-dismiss="modal" title="戻る">戻る</a>
                <a class="btn yellow-btn mb-3" v-on:click="onFinishApply" data-dismiss="modal" title="エントリーする">エントリーする</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" ref="success-model" id="exampleModalCenter" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header p-4">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true"><i class="fas fa-times"></i></span>
            </button>
          </div>
          <div class="modal-body">
            <div class="text-center row justify-content-center">
              <div class="tab-content col-md-8">
                <h6 class="font-weight-normal my-5">応募が完了しました。<br />企業からの連絡をお待ちください。</h6>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <DialogLogin v-if="!isLogin" />
    <Feature />
    <footer-nav />
  </div>
</template>
<script>
import SearchBar from "./SearchBar";
import select2 from "../Select2";
import Feature from "./Feature";
import PageNotFound from "./../pages/404";
import { mapGetters, mapActions } from "vuex";
import WebResume from "./../user/WebResume";
import FooterNav from "../layouts/inc/FooterNav";
import DialogLogin from "./../../modals/DialogLogin";

export default {
  data() {
    return {
      enpoint: "job",
      job: {},
      mode: "public",
      user: null,
      search_options: this.$parent.search_options,
      render: 1,
      loading: true,
      notFound: false,
      applyOptions: [],
      turnonWebResume: false,
      buttonKey: 1
    };
  },
  computed: {
    ...mapGetters("user", ["isLogin", "userData"])
  },
  watch: {
    $route: "getJobDetail"
  },
  async created() {
    this.user = this.userData;
    if (this.$route.query.mode && this.$route.query.mode == "preview") {
      this.mode = "preview";
    }
    this.getJobDetail();
    this.axiosConfig();
  },
  mounted() {
    this.$_loadingIcon("show");
  },
  methods: {
    ...mapActions("user", ["getUserData"]),
    async getJobDetail() {
      this.$_loadingIcon("show");
      this.loading = true;
      this.$_scrollTop();
      const _params = {
        mode: this.mode
      };
      let query = "?";
      for (let i in this.$router.currentRoute.query) {
        query += query != "?" ? "&" : "";
        query += i + "=" + encodeURIComponent(this.$router.currentRoute.query[i]);
      }
      if (this.userData) {
        _params.user_id = this.userData.id;
      }
      await axios.get("/job/detail/" + this.$router.currentRoute.params.id + query, { params: _params }).then(
        res => {
          this.job = res.data;
          if (this.job.category) {
            this.search_options.job_category = "" + this.job.category.id;
          }
          if (this.job.style) {
            this.search_options.work_style = "" + this.job.style.id;
          }
          this.loading = false;
          this.notFound = false;
          this.$_loadingIcon("hide");
        },
        error => {
          this.loading = false;
          if (error.response.status == 404) {
            // this.$router.push("/404");
            this.notFound = true;
          }
          this.$_loadingIcon("hide");
        }
      );
    },
    async validateOptions() {
      const valid = await this.$refs["options-validation"].validate();
      if (valid) {
        await $(this.$refs["apply-mothods-model"]).modal("hide");
        $(this.$refs["confirm-model"]).modal("show");
        this.turnonWebResume = false;
        if (this.applyOptions.indexOf(1) >= 0) {
          this.turnonWebResume = true;
        }
      }
    },
    onClickSearchJobs() {
      this.$router.push({ name: "job.list", query: this.search_options });
    },
    clickApply() {
      if (this.mode == "preview") return;
      if (!this.userData) {
        let params = {
          title: "ログイン",
          onPopup: res => {
            this.user = res.data.payload;
            this.getJobDetail();
            return setTimeout(() => {
              this.buttonKey++;
              this.showPopup();
            }, 1000);
          }
        };
        this.$modal.dialogLogin(params);
      } else {
        this.showPopup();
      }
    },
    async showPopup() {
      if (this.job.applied) {
        return $(this.$refs["success-model"]).modal("show");
      }
      if (this.userData && !this.userData.finish_register && !this.userData.curriculum_vitae && !this.userData.resume) {
        return $(this.$refs["not-finish-model"]).modal("show");
      }
      return $(this.$refs["apply-mothods-model"]).modal("show");
    },
    goResumeRegistration() {
      const _this = this;
      this.handleResumeRegistration().then(function() {
        _this.$_scrollTop();
      });
    },
    async handleResumeRegistration() {
      await this.$router.push({ name: "user.resume-registration" });
    },
    goWebResum() {
      const _this = this;
      this.handleGoWebResume().then(function() {
        _this.$_scrollTop();
      });
    },
    async handleGoWebResume() {
      await this.$router.push({ name: "user.web-resume" });
    },
    async onFinishApply() {
      this.$_loadingIcon("show");
      let _this = this;
      const _params = {
        methods: this.applyOptions
      };
      if (this.userData) {
        _params.user_id = this.userData.id;
      }
      await axios
        .post(this.enpoint + "/apply/" + this.job.id, _params)
        .then(
          res => {
            setTimeout(() => {
              _this.$_loadingIcon("hide");
              _this.job.applied = true;
              $(_this.$refs["success-model"]).modal("show");
            }, 0);
          },
          error => {
            this.$_loadingIcon("hide");
          }
        )
        .catch(error => {
          _this.$_loadingIcon("hide");
        });
    },
    axiosConfig() {
      axios.interceptors.request.use(function(config) {
        config.dontRedirectToLogin = true;
        return config;
      });
    },
    getWorkLocationName(id) {
      let name = "";
      switch (parseInt(id)) {
        case 1:
          name = "企業情報に登録している住所と同一";
          break;
        case 2:
          name = "在宅・リモート";
          break;
        case 3:
          name = "別の住所を記載する ";
          break;
        default:
          break;
      }
      return name;
    },
    async like(job_id) {
      if (!this.userData) {
        let params = {
          title: "ログイン",
          onPopup: res => {
            this.user = res.data.payload;
            this.getJobDetail();
            return setTimeout(() => {
              this.actionLike(job_id);
            }, 1000);
          }
        };
        this.$modal.dialogLogin(params);
      } else {
        this.actionLike(job_id);
      }
    },
    async actionLike(job_id) {
      let _this = this;
      const _params = {};
      if (this.userData) {
        _params.user_id = this.userData.id;
      }
      await axios.post(this.enpoint + "/like/" + job_id, _params).then(
        res => {
          _this.job.liked = res.data;
        },
        error => {}
      );
    }
  },
  components: {
    SearchBar,
    select2,
    Feature,
    PageNotFound,
    WebResume,
    DialogLogin,
    FooterNav
  }
};
</script>
