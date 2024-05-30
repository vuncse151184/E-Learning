<template>
  <section class="job-show-cont">
    <div class="container">
      <v-alert v-if="pageAlert" ref="page-alert" :type="pageAlert.type" :messages="pageAlert.message" autoscroll dismissible></v-alert>
      <div class="row">
        <div class="col-md-12">
          <form class="mt-4">
            <!-- Form Row -->
            <div class="form-row">
              <!-- Form group -->
              <div class="form-group col-md-12">
                  <label for="job_title">求人タイトル</label>
                  <p class="frm-show-data">{{job.job_title}}</p>
              </div>
              <!-- End Form group -->
            </div>
            <!-- End Form Row -->

            <!-- Form Row -->
            <div class="form-row">
              <!-- Form group -->
              <div class="form-group col-md-6 mb-5 select-border">
                <label for="recruitment_type">募集職種</label>
                <p class="frm-show-data">{{_jobCategory}}</p>
              </div>
              <!-- End Form group -->
            </div>
            <!-- End Form Row -->

            <!-- Form Row -->
            <div class="form-row">
              <!-- Form group -->
              <div class="form-group col-md-12">
                  <label for="recruitment_summary">募集概要</label>
                  <p class="frm-show-data">{{job.recruitment_overview}}</p>
              </div>
              <!-- End Form group -->
            </div>
            <!-- End Form Row -->

            <!-- Form Row -->
            <div class="form-row">
              <!-- Form group -->
              <div class="form-group col-md-12 mb-4">
                <label class="mb-0" for="posted_photo">掲載写真</label>
                <p class="frm-show-data"><img :src="job.images"></p>
              </div>
              <!-- End Form group -->
            </div>
            <!-- End Form Row -->

            <!-- Form Row -->
            <div class="form-row">
              <!-- Form group -->
              <div class="form-group col-md-6 mb-5 select-border">
                <label for="how_to_work">働き方</label>
                <p class="frm-show-data">{{_workStyle}}</p>
              </div>
              <!-- End Form group -->
            </div>
            <!-- End Form Row -->
            
            <!-- Form Row -->
            <div class="form-row">
              <!-- Form group -->
              <div class="form-group col-md-12 mb-4">
                  <label for="business_cont">何をやるのか（仕事内容）</label>
                  <p class="frm-show-data">{{job.work_content}}</p>
              </div>
              <!-- End Form group -->
            </div>
            <!-- End Form Row -->

            <!-- Form Row -->
            <div class="form-row">
              <!-- Form group -->
              <div class="form-group col-md-12 mb-4">
                  <label for="essential_requirement">仕事で得られるスキル・経験とは？（得られるスキル）</label>
                  <p class="frm-show-data">{{job.skill_experience}}</p>
              </div>
              <!-- End Form group -->
            </div>
            <!-- End Form Row -->

            <!-- Form Row -->
            <div class="form-row">
              <!-- Form group -->
              <div class="form-group col-md-12 mb-5">
                  <label for="essential_requirement">仕事のやりがい・魅力は？（魅力）</label>
                  <p class="frm-show-data">{{job.attraction}}</p>
              </div>
              <!-- End Form group -->
            </div>
            <!-- End Form Row -->

            <!-- Form Row -->
            <div class="form-row">
              <!-- Form group -->
              <div class="form-group col-md-6 mb-2">
                <label for="sector">給与</label>
              </div>
              <!-- End Form group -->
            </div>
            <!-- End Form Row -->

            <!-- Form Row -->
            <div class="form-row">
              <!-- Form group -->
              <div class="form-group col-md-6 mb-4 ml-4 select-border">
                <label for="giving_system">給与体系</label>
                <p class="frm-show-data">{{_salarySystem}}</p>
              </div>
              <!-- End Form group -->
            </div>
            <!-- End Form Row -->

            <!-- Form Row -->
            <div class="form-row">
              <!-- Form group -->
              <div class="form-group col-lg-6 ml-4">
                <label>給与額</label>
                <div class="form-inline frm-inline">
                  <p class="frm-show-data col-md-4">{{job.salary_from}}</p>
                  <label class="ml-2">円</label>
                  <span class="col-md-2 text-center"> 〜 </span>
                  <p class="frm-show-data col-md-4">{{job.salary_to}}</p>
                  <label class="ml-2">円</label>
                </div>
              </div>
              <!-- End Form group -->
            </div>
            <!-- End Form Row -->

            <!-- Form Row -->
            <div class="form-row">
              <!-- Form group -->
              <div class="form-group col-md-6 mb-2">
                <label for="work-location">勤務地</label>
              </div>
              <!-- End Form group -->
            </div>
            <!-- End Form Row -->

            <!-- Form Row -->
            <div v-if="job.work_location != kWorkLocationTypes.Another" class="form-row">
              <!-- Form group -->
              <div class="form-group col-md-6 mb-3 ml-4">
                <p class="frm-show-data no-bdr">{{_workLocation}}</p>
              </div>
            <!-- End Form group -->
            </div>
            <!-- End Form Row -->

            <!-- Form Row -->
            <div v-if="job.work_location == kWorkLocationTypes.Another" class="form-row">
              <!-- Form group -->
              <div class="form-group col-md-11 mb-5 ml-4">
                  <label for="another_address">別の住所</label>
                  <p class="frm-show-data">{{_anotherAddress}}</p>
              </div>
              <!-- End Form group -->
            </div>
            <!-- End Form Row -->

            <!-- Form Row -->
            <div class="form-row">
              <!-- Form group -->
              <div class="form-group col-md-12">
                  <label for="required_skill">必要なスキル・経験</label>
                  <p class="frm-show-data">{{job.requirement_skill}}</p>
              </div>
              <!-- End Form group -->
            </div>
            <!-- End Form Row -->

            <!-- Form Row -->
            <div class="form-row">
              <!-- Form group -->
              <div class="form-group col-md-6 mb-5 select-border">
                <label for="number_of_hires">採用人数</label>
                <div class="form-inline frm-inline">
                  <p class="frm-show-data">{{job.employees_number}}</p>
                  <label class="ml-2">人</label>
                </div>
              </div>
              <!-- End Form group -->
            </div>
            <!-- End Form Row -->

            <!-- Form Row -->
            <div class="form-row">
              <!-- Form group -->
              <div class="form-group col-lg-6 mb-4 select-border">
                <label for="working_time">労働時間</label>
                <div class="form-inline frm-inline">
                  <p class="frm-show-data">{{job.working_start_at}}</p>
                  <span class="col-md-2 text-center"> 〜 </span>
                  <p class="frm-show-data">{{job.working_end_at}}</p>
                </div>
              </div>
              <!-- End Form group -->
            </div>
            <!-- End Form Row -->

            <!-- Form Row -->
            <div class="form-row">
              <!-- Form group -->
              <div class="form-group col-md-12 mb-2">
                  <label for="holiday">休日・休暇</label>
                  <p class="frm-show-data">{{job.holiday_vacation}}</p>
              </div>
              <!-- End Form group -->
            </div>
            <!-- End Form Row -->

            <!-- Button Block-->
            <div v-if="isShowActions" class="col-md-12 my-5 mx-auto left-btn-block">
              <router-link :to="{ name: 'company.job.edit', params: {id:job.id} }" title="情報を編集する" class="btn blue-btn btn-lg m-0">情報を編集する</router-link>
              <a v-on:click="onclickDelete" class="btn trans-btn btn-lg ml-3" href="javascript:void(0)" title="削除する">削除する</a>
            </div>
            <div v-else class="col-md-12 my-5 mx-auto left-btn-block">
              <p class="alert alert-warning">{{trans.get("messages.M136")}}</p>
            </div>
            <!-- End Button Block-->
          </form>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import select2 from "./../../Select2";
import vAlert from "../../Alert";


export default {
  components: {
    select2, vAlert
  },
  data() {
    const kDefaultImg = "/assets/img/posted-photo-plus.png";
    const kPublic = { Default: 0, Draft: 0, ByCompany: 1, ByAdmin: 2, Stop: 3 };
    const kWorkLocationTypes = { Same: "1", Remote: "2", Another: "3" };
    var emptyJob = {
      job_title: "",
      job_category: "",
      recruitment_overview: "",
      work_style: "",
      work_content: "",
      skill_experience: "",
      attraction: "",
      salary_system: "",
      salary_from: "",
      salary_to: "",
      work_location: "",
      address: "",
      requirement_skill: "",
      employees_number: "",
      working_start_at: "",
      working_end_at: "",
      holiday_vacation: "",
      images: kDefaultImg
    };
    
    return {
      /** Constants */
      kPublic: kPublic,
      kWorkLocationTypes: kWorkLocationTypes,
      kDefaultImg: kDefaultImg,
      /** Variables */
      companyAddress: "",
      pageAlert: null,
      options: [],
      job: emptyJob
    };
  },
  computed: {
    ...mapGetters("company", ["companyData"]),
    ///
    isShowActions: function() {
      return !(this.job.public == this.kPublic.ByAdmin || this.job.public == this.kPublic.ByCompany)
    },
    _anotherAddress: function() {
      if (this.job.work_location == this.kWorkLocationTypes.Another) {
        return this.job.address;
      }
      return "";
    },
    _workLocation: function() {
      if (this.job.work_location == this.kWorkLocationTypes.Same) {
        return this.companyAddress;
      }
      else if (this.job.work_location == this.kWorkLocationTypes.Another) {
        return this.job.address;
      }
      else if (this.job.work_location == this.kWorkLocationTypes.Remote) {
        return "在宅・リモート";
      }
      return "";
    },
    _workStyle: function() {
      if (this.job.work_style > 0) {
        return this.options.work_style.name;
      }
      return "";
    },
    _jobCategory: function() {
      if (this.job.job_category > 0) {
        return this.options.job_category.name;
      }
      return "";
    },
    _salarySystem: function() {
      if (this.job.salary_system > 0) {
        return this.options.salary_system.name;
      }
      return "";
    },
    _imageJob: {
      get: function() {
        if (this.formJob.images) {
          return this.formJob.images;
        }
        return this.kDefaultImg;
      },
      set: function(newValue) { this.formJob.images = newValue; }
    }
  },
  async created() {
    await this.reqInitData();
  },
  mounted() {
    if (this.$router.currentRoute.params.message) {
      let message = this.$router.currentRoute.params.message;
      this.setPageAlert(message.type, message.content);
    }
  },
  methods: {
    ...mapActions("company", ["sendGetAJobRequest", "sendDeleteJobRequest"]),
    ///
    clearAlert() {
      this.pageAlert = null;
    },
    setPageAlert(type, message) {
      this.pageAlert = { type: type, message: message };
    },
    onclickDelete() {
      const params = {
        title: "", text: this.trans.get("messages.M133"),
        txtOk: "確認", txtCancel: "キャンセル", hasHeader: false,
        onConfirm: () => {
          this.sendDeleteJobRequest({id: this.job.id}).then(
            (resp) => {
              let data = resp.data;
              
              if (data.status == 'error') {
                this.setPageAlert(vAlert.Type.Danger, data.messages);
                return;
              }
              this.formJob = data.payload.job;
              this.setPageAlert(vAlert.Type.Success, data.messages);
              this.$router.replace({ name: 'company.job.list' });
            },
            error => {
            }
          );
        }
      };
      this.$modal.dialogConfirm(params);
    },
    async reqInitData() {
      let crtRoute = this.$router.currentRoute;
      let jobId = crtRoute.params.id;
      await this.sendGetAJobRequest({id: jobId}).then(
        (resp) => {
          let payload = resp.data.payload;
          this.job = payload.job;
          this.companyAddress = payload.company_address;
          this.options = {
            work_style: payload.opt_work_style,
            salary_system: payload.opt_salary_system,
            job_category: payload.opt_job_category
          };
        },
        error => {
        }
      );
    }
  },
};

</script>
