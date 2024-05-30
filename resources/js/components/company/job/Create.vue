<template>
  <section class="job-create-cont">
    <div class="container">
      <v-alert v-if="pageAlert" ref="page-alert" :type="pageAlert.type" :messages="pageAlert.message" autoscroll dismissible></v-alert>
      <div class="row">
        <div class="col-md-12">
          <ValidationObserver ref="form-job">
            <form class="mt-4">
              <!-- Form Row -->
              <div class="form-row">
                <!-- Form group -->
                <ValidationProvider mode="eager" name="求人タイトル" v-slot="{ errors }" rules="must_entered|range_length:100" slim>
                  <div class="form-group col-md-12">
                    <label for="job_title">求人タイトル<span class="red-required">必須</span></label>
                    <input v-model="formJob.job_title" type="text" class="form-control" id="job_title" placeholder="" />
                    <small class="form-text text-error">{{ errors[0] }}</small>
                  </div>
                </ValidationProvider>
                <!-- End Form group -->
              </div>
              <!-- End Form Row -->

              <!-- Form Row -->
              <div class="form-row">
                <!-- Form group -->
                <ValidationProvider mode="eager" name="募集職種" v-slot="{ errors }" rules="must_selected" slim>
                  <div class="form-group col-md-6 mb-5 select-border">
                    <label for="recruitment_type">募集職種<span class="red-required">必須</span></label>
                    <select2 class="form-control" v-model="formJob.job_category">
                      <option v-for="(v, k) in konst.lst_job_category" v-bind:value="v.id" v-bind:key="k">{{ v.name }}</option>
                    </select2>
                    <small class="form-text text-error">{{ errors[0] }}</small>
                  </div>
                </ValidationProvider>
                <!-- End Form group -->
              </div>
              <!-- End Form Row -->

              <!-- Form Row -->
              <div class="form-row">
                <!-- Form group -->
                <ValidationProvider mode="eager" name="募集概要" v-slot="{ errors }" rules="must_entered|range_length:200" slim>
                  <div class="form-group col-md-12">
                    <label for="recruitment_summary">募集概要<span class="red-required">必須</span></label>
                    <textarea v-model="formJob.recruitment_overview" class="form-control" rows="4" id="recruitment_summary" placeholder=""></textarea>
                    <small class="float-right">200文字まで</small>
                    <small class="form-text text-error">{{ errors[0] }}</small>
                  </div>
                </ValidationProvider>
                <!-- End Form group -->
              </div>
              <!-- End Form Row -->

              <!-- Form Row -->
              <div class="form-row">
                <!-- Form group -->
                <ValidationProvider mode="eager" name="掲載写真" :rules="kRulesAddFile" v-slot="{ errors, validate }" slim>
                  <div class="form-group col-md-12 mb-5">
                    <label class="mb-0" for="posted_photo">掲載写真</label>
                    <div class="cover-photo-contact">
                      <div class="upload-file upload-photo">
                        <div class="custom-file m-0">
                          <input @change="validate" type="file" class="custom-file-input" id="up_file" />
                          <label class="custom-file-label" for="up_file">
                            <img id="preview_add_file" :src="_imageJob" alt="" />
                          </label>
                        </div>
                        <span>※PNG、JPEG、GIFのいずれかをご使用いただけます。<br />（推奨サイズ：縦200px、横200px以上、2MB以下）</span>
                      </div>
                    </div>
                    <small class="form-text text-error">{{ errors[0] }}</small>
                  </div>
                </ValidationProvider>
                <!-- End Form group -->
              </div>
              <!-- End Form Row -->

              <!-- Form Row -->
              <div class="form-row">
                <!-- Form group -->
                <ValidationProvider mode="eager" name="働き方" v-slot="{ errors }" rules="must_selected" slim>
                  <div class="form-group col-md-6 mb-5 select-border">
                    <label for="how_to_work">働き方<span class="red-required">必須</span></label>
                    <select2 class="form-control" v-model="formJob.work_style">
                      <option value="" v-bind:selected="formJob.work_style === ''">選択してください</option>
                      <option v-for="(v, k) in konst.lst_work_style" v-bind:value="v.id" v-bind:key="k">{{ v.name }}</option>
                    </select2>
                    <small class="form-text text-error">{{ errors[0] }}</small>
                  </div>
                </ValidationProvider>
                <!-- End Form group -->
              </div>
              <!-- End Form Row -->

              <!-- Form Row -->
              <div class="form-row">
                <!-- Form group -->
                <ValidationProvider mode="eager" name="仕事内容" v-slot="{ errors }" rules="must_entered|range_length:200" slim>
                  <div class="form-group col-md-12 mb-4">
                    <label for="business_cont">何をやるのか（仕事内容）<span class="red-required">必須</span></label>
                    <textarea v-model="formJob.work_content" class="form-control" rows="4" id="business_cont" placeholder=""></textarea>
                    <small class="float-right">200文字まで</small>
                    <small class="form-text text-error">{{ errors[0] }}</small>
                  </div>
                </ValidationProvider>
                <!-- End Form group -->
              </div>
              <!-- End Form Row -->

              <!-- Form Row -->
              <div class="form-row">
                <!-- Form group -->
                <ValidationProvider mode="eager" name="得られるスキル" v-slot="{ errors }" rules="must_entered|range_length:500" slim>
                  <div class="form-group col-md-12 mb-4">
                    <label for="essential_requirement">仕事で得られるスキル・経験とは？（得られるスキル）<span class="red-required">必須</span></label>
                    <textarea v-model="formJob.skill_experience" class="form-control" rows="4" id="essential_requirement" placeholder=""></textarea>
                    <small class="float-right">500文字まで</small>
                    <small class="form-text text-error">{{ errors[0] }}</small>
                  </div>
                </ValidationProvider>
                <!-- End Form group -->
              </div>
              <!-- End Form Row -->

              <!-- Form Row -->
              <div class="form-row">
                <!-- Form group -->
                <ValidationProvider mode="eager" name="魅力" v-slot="{ errors }" rules="must_entered|range_length:500" slim>
                  <div class="form-group col-md-12 mb-4">
                    <label for="essential_requirement">仕事のやりがい・魅力は？（魅力）<span class="red-required">必須</span></label>
                    <textarea v-model="formJob.attraction" class="form-control" rows="4" id="essential_requirement" placeholder=""></textarea>
                    <small class="float-right">500文字まで</small>
                    <small class="form-text text-error">{{ errors[0] }}</small>
                  </div>
                </ValidationProvider>
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
                <ValidationProvider mode="eager" name="給与体系" v-slot="{ errors }" rules="must_selected" slim>
                  <div class="form-group col-md-6 mb-5 ml-4 select-border">
                    <label for="sector">給与体系<span class="red-required">必須</span></label>
                    <select2 class="form-control" v-model="formJob.salary_system">
                      <option value="" v-bind:selected="formJob.salary_system == ''">選択してください</option>
                      <option v-for="(v, k) in konst.lst_salary_system" v-bind:value="v.id" v-bind:key="k">{{ v.name }}</option>
                    </select2>
                    <small class="form-text text-error">{{ errors[0] }}</small>
                  </div>
                </ValidationProvider>
                <!-- End Form group -->
              </div>
              <!-- End Form Row -->

              <!-- Form Row -->
              <div class="form-row">
                <!-- Form group -->
                <ValidationObserver v-slot="{ errors }" slim>
                  <div class="form-group col-lg-6 ml-4">
                    <label>給与額<span class="red-required">必須</span></label>
                    <div class="form-inline frm-inline">
                      <ValidationProvider vid="salary_from" mode="eager" name="給与額" rules="must_entered|min_value:0" slim>
                        <input v-model="formJob.salary_from" type="text" class="form-control col-md-4" id="postal_code_01" placeholder="" />
                      </ValidationProvider>
                      <label class="ml-2">円</label>
                      <span class="col-md-2 text-center">〜</span>
                      <ValidationProvider vid="salary_to" mode="eager" name="給与額" rules="must_entered|min_value:0" slim>
                        <input v-model="formJob.salary_to" type="text" class="form-control col-md-4" id="postal_code_02" placeholder="" />
                      </ValidationProvider>
                      <label class="ml-2">円</label>
                    </div>
                    <small v-if="errors.salary_from && errors.salary_from.length > 0" class="form-text text-error">{{ errors.salary_from[0] }}</small>
                    <small v-else-if="errors.salary_to && errors.salary_to.length > 0" class="form-text text-error">{{ errors.salary_to[0] }}</small>
                  </div>
                </ValidationObserver>
                <!-- End Form group -->
              </div>
              <!-- End Form Row -->

              <!-- Form Row -->
              <div class="form-row">
                <!-- Form group -->
                <div class="form-group col-md-6 mb-2">
                  <label for="work-location">勤務地<span class="red-required">必須</span></label>
                </div>
                <!-- End Form group -->
              </div>
              <!-- End Form Row -->

              <!-- Form Row -->
              <div class="form-row">
                <!-- Form group -->
                <div class="form-group col-md-6 mb-3 ml-4">
                  <div class="radio-lst">
                    <ValidationProvider vid="work_location" rules="" v-slot="" slim>
                      <div class="form-check form-check-block">
                        <input v-model="formJob.work_location" value="1" class="form-check-input" type="radio" name="location" id="old_location" checked />
                        <label class="form-check-label" for="old_location" v-html="getTextWorkLocation('1')"></label>
                      </div>
                    </ValidationProvider>
                    <div class="form-check form-check-block">
                      <input v-model="formJob.work_location" value="2" class="form-check-input" type="radio" name="location" id="home_location" />
                      <label class="form-check-label" for="home_location" v-html="getTextWorkLocation('2')"></label>
                    </div>
                    <div class="form-check form-check-block">
                      <input v-model="formJob.work_location" value="3" class="form-check-input" type="radio" name="location" id="another_location" />
                      <label class="form-check-label" for="another_location" v-html="getTextWorkLocation('3')"></label>
                    </div>
                  </div>
                </div>
                <!-- End Form group -->
              </div>
              <!-- End Form Row -->

              <!-- Form Row -->
              <div class="form-row">
                <!-- Form group -->
                <ValidationProvider mode="eager" name="別の住所" v-slot="{ errors }" :rules="{ my_required_if: { target: 'work_location', values: kWorkLocationTypes.Another } }" slim>
                  <div class="form-group col-md-11 mb-5 ml-4">
                    <label for="another_address">別の住所</label>
                    <textarea v-model="formJob.address" :disabled="formJob.work_location != kWorkLocationTypes.Another" class="form-control" rows="4" id="another_address"></textarea>
                    <small class="form-text text-error">{{ errors[0] }}</small>
                  </div>
                </ValidationProvider>
                <!-- End Form group -->
              </div>
              <!-- End Form Row -->

              <!-- Form Row -->
              <div class="form-row">
                <!-- Form group -->
                <ValidationProvider mode="eager" name="必要なスキル・経験" v-slot="{ errors }" rules="must_entered|range_length:200" slim>
                  <div class="form-group col-md-12 mb-3">
                    <label for="required_skill">必要なスキル・経験<span class="red-required">必須</span></label>
                    <textarea v-model="formJob.requirement_skill" class="form-control" rows="4" id="required_skill" placeholder=""></textarea>
                    <small class="float-right">200文字まで</small>
                    <small class="form-text text-error">{{ errors[0] }}</small>
                  </div>
                </ValidationProvider>
                <!-- End Form group -->
              </div>
              <!-- End Form Row -->

              <!-- Form Row -->
              <div class="form-row">
                <!-- Form group -->
                <ValidationProvider mode="eager" name="採用人数" v-slot="{ errors }" rules="must_entered|min_value:0" slim>
                  <div class="form-group col-md-6 mb-5 select-border">
                    <label for="sector">採用人数<span class="red-required">必須</span></label>
                    <div class="form-inline frm-inline">
                      <!--<div class="col-md-5 row">
                         <select2 class="form-control" v-model="formJob.employees_number">
                          <option v-for="(v, k) in konst.lst_employees_number" v-bind:value="v" v-bind:key="k"
                                  v-bind:selected="v == formJob.employees_number">{{ v }}</option>
                        </select2> 
                      </div>-->
                      <input v-model="formJob.employees_number" type="text" class="form-control" id="employees_number" placeholder="" />
                      <label class="ml-2">人</label>
                    </div>
                    <small class="form-text text-error">{{ errors[0] }}</small>
                  </div>
                </ValidationProvider>
                <!-- End Form group -->
              </div>
              <!-- End Form Row -->

              <!-- Form Row -->
              <div class="form-row">
                <!-- Form group -->
                <div class="form-group col-lg-6 mb-5 select-border">
                  <label>労働時間</label>
                  <div class="form-inline frm-inline">
                    <!-- <div class="col-md-5 row">
                      <select2 class="form-control" v-model="formJob.working_start_at">
                        <option v-for="(v, k) in konst.lst_working_start_at" v-bind:value="v" v-bind:key="k"
                                v-bind:selected="v == formJob.working_start_at">{{ v }}</option>
                      </select2>
                    </div> -->
                    <input @change="onchangeInput(kInput.WorkingStartAt)" :value="formJob.working_start_at" type="text" class="form-control col-md-4" id="working_start_at" placeholder="" />
                    <span class="col-md-2 text-center">〜</span>
                    <input @change="onchangeInput(kInput.WorkingEndAt)" :value="formJob.working_end_at" type="text" class="form-control col-md-4" id="working_end_at" placeholder="" />
                    <!-- <div class="col-md-5 row">
                      <select2 class="form-control" v-model="formJob.working_end_at">
                        <option v-for="(v, k) in konst.lst_working_end_at" v-bind:value="v" v-bind:key="k"
                                v-bind:selected="v == formJob.working_end_at">{{ v }}</option>
                      </select2>
                    </div> -->
                  </div>
                </div>
                <!-- End Form group -->
              </div>
              <!-- End Form Row -->

              <!-- Form Row -->
              <div class="form-row">
                <!-- Form group -->
                <ValidationProvider mode="eager" name="休日・休暇" v-slot="{ errors }" rules="range_length:100" slim>
                  <div class="form-group col-md-12 mb-2">
                    <label for="holiday">休日・休暇</label>
                    <textarea v-model="formJob.holiday_vacation" class="form-control" rows="4" id="holiday" placeholder=""></textarea>
                    <small class="float-right">100文字まで</small>
                    <small class="form-text text-error">{{ errors[0] }}</small>
                  </div>
                </ValidationProvider>
                <!-- End Form group -->
              </div>
              <!-- End Form Row -->

              <!-- Button Block-->
              <div class="col-md-12 my-5 mx-auto text-center full-btn-block block-three-btn">
                <a v-on:click="onclickAddJob" v-if="formJob.public == kPublic.Draft" href="javascript:void(0)" class="btn blue-btn btn-lg m-0" title="求人情報を確認">求人情報を確認</a>
                <a v-on:click="onclickSaveDraft" v-if="formJob.public == kPublic.Draft" href="javascript:void(0)" class="btn trans-btn btn-lg m-0" title="下書きを保存">下書きを保存</a>
                <a v-on:click="onclickPreview" v-if="_canShowBtnPreview" href="javascript:void(0)" class="btn bluelight-btn btn-lg m-0" title="プレビュー">プレビュー</a>
                <a v-on:click="onclickPreview" v-else href="javascript:void(0)" class="btn gray-btn btn-lg m-0 disabled" title="プレビュー">プレビュー</a>
              </div>
              <!-- End Button Block-->
            </form>
          </ValidationObserver>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
var md5 = require("md5");
import { mapGetters, mapActions } from "vuex";
import select2 from "./../../Select2";
import vAlert from "../../Alert";

export default {
  components: {
    select2,
    vAlert
  },
  data() {
    const kDefaultImg = "/assets/img/posted-photo-plus.png";
    const kPublic = { Default: 0, Draft: 0, ByCompany: 1, ByAdmin: 2, Stop: 3 };
    const kWorkLocationTypes = { Same: "1", Remote: "2", Another: "3" };
    var kWorkLocationTexts = {};
    kWorkLocationTexts[kWorkLocationTypes.Same] = "企業情報に登録している住所と同一";
    kWorkLocationTexts[kWorkLocationTypes.Remote] = "在宅・リモート";
    kWorkLocationTexts[kWorkLocationTypes.Another] = "別の住所を記載する";
    Object.freeze(kWorkLocationTexts);

    const kRulesAddFile = {
      my_image: { completion: this.completeAddFile },
      my_ext: { extensions: ["png", "gif", "jpg", "jpeg"], completion: this.completeAddFile },
      min_dimensions: { width: 200, height: 200, completion: this.completeAddFile }
    };
    const kInput = { WorkingStartAt: "working_start_at", WorkingEndAt: "working_end_ata" };

    var initFormJob = {
      public: 0,
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
      kInput: kInput,
      kPublic: kPublic,
      kRulesAddFile: kRulesAddFile,
      konst: {},
      kWorkLocationTypes: kWorkLocationTypes,
      kWorkLocationTexts: kWorkLocationTexts,
      kDefaultImg: kDefaultImg,
      /** Variables */
      pageAlert: null,
      shouldPostImage: false,
      formJob: initFormJob
    };
  },
  computed: {
    ...mapGetters("company", ["companyData"]),
    ///
    _canShowBtnPreview: function() {
      var allowPreview = this.formJob.id && this.formJob.public == this.kPublic.Draft && this.companyData.id;
      return allowPreview;
    },
    _imageJob: {
      get: function() {
        if (this.formJob.images) {
          return this.formJob.images;
        }
        return this.kDefaultImg;
      },
      set: function(newValue) {
        this.formJob.images = newValue;
      }
    }
  },
  created() {
    var _this = this;
    this.reqInitData(function(error) {
      if (!error) {
        var jobId = _this.$router.currentRoute.params.id;

        if (jobId) {
          _this.reqGetJob(jobId);
        }
      }
    });
  },
  mounted() {},
  methods: {
    ...mapActions("company", ["sendGetAJobRequest", "sendInitDataRequest", "sendStoreJobRequest", "sendUpdateJobRequest"]),
    ///
    onchangeInput(fieldName) {
      var val = $(event.target)
        .val()
        .split(":");
      var hh = 9,
        mm = 0;

      if (val && val.length >= 2) {
        hh = parseInt(val[0]);
        mm = parseInt(val[1]);
      } else if (val && val.length == 1) {
        hh = parseInt(val[0]);
      }
      var validHour = !isNaN(hh) && hh >= 0 && hh <= 23;
      var validMinute = !isNaN(mm) && mm >= 0 && mm <= 59;
      var res = "";

      if (validHour) {
        res += this.padZero(hh, 2) + ":";
      } else {
        res += "00:";
      }

      if (validMinute) {
        res += this.padZero(mm, 2);
      } else {
        res += "00";
      }
      $(event.target).val(res);
      console.log(res);

      if (fieldName == this.kInput.WorkingStartAt) {
        this.formJob.working_start_at = res;
      } else if (fieldName == this.kInput.WorkingEndAt) {
        this.formJob.working_end_at = res;
      }
    },
    padZero(num, size) {
      num = num.toString();
      while (num.length < size) num = "0" + num;
      return num;
    },
    onclickPreview() {
      var allowPreview = this.formJob.id && this.formJob.public == this.kPublic.Draft && this.companyData.id;

      if (allowPreview) {
        let routeData = this.$router.resolve({
          name: "job.details",
          params: { id: this.formJob.id },
          query: { mode: "preview", company_id: this.companyData.id, token: md5(this.formJob.id + "preview" + this.companyData.id) }
        });
        window.open(routeData.href, "_blank");
      } else {
        this.alertCannotPreview({ job_id: this.formJob.id, public_type: this.formJob.public, company_id: this.companyData.id });
      }
    },
    /**
     * @param Object data     Format : {job_id, public_type, company_id}
     */
    alertCannotPreview(data) {
      const params = {
        title: "プレビュー出来ません。",
        text: ""
      };
      if (!data.job_id) {
        params.text = this.trans.get("messages.M141");
      } else if (data.public_type != this.kPublic.Draft) {
        params.text = "ジョブの公開ステータスが無効です";
      } else if (data.company_id) {
        params.text = "あなたの会社が見つかりません";
      }
      this.$modal.show(params);
    },
    getTextWorkLocation(type) {
      if (type in this.kWorkLocationTexts) {
        return this.kWorkLocationTexts[type];
      }

      return "";
    },
    reqGetJob(jobId) {
      this.sendGetAJobRequest({ id: jobId }).then(
        resp => {
          let payload = resp.data.payload;
          this.formJob = payload.job;
        },
        error => {}
      );
    },
    setPageAlert(type, message) {
      this.pageAlert = { type: type, message: message };
    },
    completeAddFile(event, ruleName, result) {
      if (event.target && event.target.files) {
        if (result) {
          this.shouldPostImage = true;
          var URL = window.URL || window.webkitURL;
          this.formJob.images = URL.createObjectURL(event.target.files[0]);
        } else {
          this.shouldPostImage = false;
          this.formJob.images = this.kDefaultImg;
          $(event.target).val("");
        }
      }
    },
    clearAlert() {
      this.pageAlert = null;
    },
    async onclickSaveDraft() {
      this.clearAlert();
      const valid = await this.$refs["form-job"].validate();

      if (valid) {
        if (this.formJob.id > 0) {
          this.reqUpdateJob(true);
        } else {
          this.reqStoreJob();
        }

        return;
      }
      this.scrollToError();
    },
    async onclickAddJob() {
      this.clearAlert();
      const valid = await this.$refs["form-job"].validate();

      if (valid) {
        const params = {
          title: "確認",
          text: "この求人情報は管理者による審査を経て、オンラインで公開されます。審査後は、この求人情報は編集することができません。この求人情報を申請しますか？",
          txtOk: "確認",
          txtCancel: "キャンセル",
          hasHeader: true,
          onConfirm: () => {
            if (this.formJob.id > 0) {
              this.reqUpdateJob();
            } else {
              this.reqStoreJob(true);
            }
          }
        };
        this.$modal.dialogConfirm(params);

        return;
      }
      this.scrollToError();
    },
    /** Note: `data2Send` will be modified */
    verifyBeforeStoreJob(data2Send, forcePublicByCompany = false) {
      if (this.formJob.work_location != this.kWorkLocationTypes.Another) {
        data2Send.address = "";
      }
      data2Send.shouldPostImageData = this.shouldPostImage;
      data2Send.public = this.kPublic.Draft;

      if (forcePublicByCompany) {
        data2Send.public = this.kPublic.ByCompany;
      }

      return data2Send;
    },
    /** Note: `data2Send` will be modified */
    verifyBeforeUpdateJob(data2Send, forcePublicDraft = false) {
      if (this.formJob.work_location != this.kWorkLocationTypes.Another) {
        data2Send.address = "";
      }
      data2Send.shouldPostImageData = this.shouldPostImage;
      data2Send.public = this.kPublic.ByCompany;

      if (forcePublicDraft) {
        data2Send.public = this.kPublic.Draft;
      }

      return data2Send;
    },
    reqUpdateJob(forcePublicDraft = false) {
      var data2Send = JSON.parse(JSON.stringify(this.formJob)); // clone data
      data2Send = this.verifyBeforeUpdateJob(data2Send, forcePublicDraft);

      this.sendUpdateJobRequest(data2Send).then(
        resp => {
          let data = resp.data;

          if (data.status == "error") {
            this.setPageAlert(vAlert.Type.Danger, data.messages);
            return;
          }
          this.formJob = data.payload.job;

          if (this.formJob.public != this.kPublic.Draft) {
            this.$_scrollTop();
            this.$router.replace({
              name: "company.job.show",
              params: { id: this.formJob.id, message: { type: vAlert.Type.Success, content: data.messages } }
            });
          } else {
            this.setPageAlert(vAlert.Type.Success, data.messages);
          }
        },
        error => {}
      );
    },
    reqStoreJob(forcePublicByCompany = false) {
      var data2Send = JSON.parse(JSON.stringify(this.formJob)); // clone data
      data2Send = this.verifyBeforeStoreJob(data2Send, forcePublicByCompany);

      this.sendStoreJobRequest(data2Send).then(
        resp => {
          let data = resp.data;

          if (data.status == "error") {
            this.setPageAlert(vAlert.Type.Danger, data.messages);
            return;
          }
          this.formJob = data.payload.job;

          if (this.formJob.public != this.kPublic.Draft) {
            this.$_scrollTop();
            this.$router.replace({ name: "company.job.show", params: { id: this.formJob.id } });
          } else {
            this.setPageAlert(vAlert.Type.Success, data.messages);
          }
        },
        error => {}
      );
    },
    scrollToError() {
      var list = $("small.form-text.text-error");

      for (var i = 0; i < list.length; ++i) {
        if ($(list[i]).text()) {
          const closestElement = $(list[i]).closest("div");
          const location = closestElement.offset().top - 100;
          this.scrollToLocacion(location);
          break;
        }
      }
    },
    scrollToLocacion(location) {
      $("html").animate(
        {
          scrollTop: location
        },
        500
      );
    },
    initFormData() {
      this.formJob.job_category = this.konst.lst_job_category[0].id;
      this.formJob.work_location = "1";
      this.formJob.employees_number = ""; //this.konst.lst_employees_number[1];
      this.formJob.working_start_at = this.konst.lst_working_start_at[1];
      this.formJob.working_end_at = this.konst.lst_working_end_at[1];
      this.formJob.images = this.kDefaultImg;
      this.formJob.public = 0;
    },
    /**
     * @param `completion` Call back after receive response */
    reqInitData(completion) {
      this.sendInitDataRequest().then(
        resp => {
          this.konst = resp.data.konst;
          this.initFormData();
          completion(null);
        },
        error => {
          completion(error);
        }
      );
    }
  }
};
</script>
