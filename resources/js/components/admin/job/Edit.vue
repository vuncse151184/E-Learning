<template>
  <!-- Tab Content -->
  <div class="bg_container tab-content">
    <!-- Tab 02: Edit Tab -->
    <div class="tab-pane active" id="edit" role="tabpanel" aria-labelledby="edit-tab">
      <v-alert v-if="page_alert" ref="page-alert" :type="page_alert.type" :messages="page_alert.message" autoscroll dismissible autofade :delay="500000"></v-alert>
      <form class="user-data-frm form_comp" role="form" ref="job-detail-form">
        <ValidationObserver ref="observer" v-slot="{ handleSubmit }">
          <!-- Form status-->
          <div class="row form_status">
            <!-- col 04 -->
            <div class="col-sm-6 col-md-5">
              <div class="form-group">
                <select2 class="form-control select2" name="public" v-model="job.public">
                  <option :value="i" v-for="(s, i) in status" :key="i">{{ s }}</option>
                </select2>
              </div>
            </div>
            <div class="col-sm-12 col-md-7 text-right">
              <div class="form-group">
                <button class="btn blue-btn mgr-15" type="button" @click="handleSubmit(beforeChange)">編集を保存</button>
                <button class="btn trans-btn" type="button" @click="resetForm">リセット</button>
              </div>
            </div>
            <!-- End col 04 -->
          </div>
          <!-- End Form status-->

          <!-- General Form -->
          <div class="card card-warning">
            <div class="card-body">
              <!-- Row -->
              <div class="row">
                <!-- Col 06 -->
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="id">ID</label>
                    <p class="frm-show-data">{{ job.id }}</p>
                  </div>
                </div>
                <!-- End Col 06 -->

                <!-- Col 06 -->
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="created_date">作成日</label>
                    <div class="input-group date" id="created_date" data-target-input="nearest">
                      <p class="frm-show-data">{{ job.created_at_formated_date }}</p>
                      <div class="input-group-append" data-target="#created_date" data-toggle="datetimepicker" v-on:click="$refs['date-picker-created-at'].dp.show()">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                      </div>
                    </div>
                    <small class="form-text text-danger" v-if="errors[0]">{{ errors[0] }}</small>
                  </div>
                </div>
                <!-- End Col 06 -->

                <!-- Col 06 -->
                <!-- <div class="col-sm-6">
                <div class="form-group">
                  <label for="created_date_two">有効期限</label>
                  <div class="input-group date" id="created_date_two" data-target-input="nearest">
                    <input type="text" class="form-control datetimepicker-input" data-target="#created_date_two" placeholder="" />
                    <div class="input-group-append" data-target="#created_date_two" data-toggle="datetimepicker">
                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                  </div>
                </div>
              </div> -->
                <!-- End Col 06 -->

                <!-- Col 12 -->
                <div class="col-12">
                  <ValidationProvider mode="eager" name="求人タイトル" v-slot="{ errors }" rules="required|max:100" slim>
                    <div class="form-group">
                      <label for="job_title">求人タイトル</label>
                      <div class="input-group">
                        <input id="job_title" type="text" class="form-control" placeholder="" name="job_title" v-model="job.job_title" />
                        <div class="input-group-append">
                          <div class="input-group-text"><i class="fa fa-archway"></i></div>
                        </div>
                      </div>
                      <small class="form-text text-danger">{{ errors[0] }}</small>
                    </div>
                  </ValidationProvider>
                </div>
                <!-- End Col 12 -->

                <!-- Col 06 -->
                <div class="col-sm-6">
                  <ValidationProvider mode="eager" name="募集職種" v-slot="{ errors }" rules="required" slim>
                    <div class="form-group">
                      <label for="job_category">募集職種</label>
                      <div class="input-group">
                        <select2 class="form-control select2" name="job_category" v-model="job.job_category">
                          <option :value="option.id" v-for="(option, i) in lst_job_category" :key="i">{{ option.name }}</option>
                        </select2>
                        <div class="input-group-append">
                          <div class="input-group-text"><i class="fa fa-user-tie"></i></div>
                        </div>
                      </div>
                      <small class="form-text text-danger">{{ errors[0] }}</small>
                    </div>
                  </ValidationProvider>
                </div>
                <!-- End Col 06 -->

                <!-- Col 12 -->
                <div class="col-12">
                  <div class="form-group">
                    <ValidationProvider mode="eager" name="募集概要" v-slot="{ errors }" rules="required|max:200" slim>
                      <label for="recruitment_overview">募集概要</label>
                      <textarea class="form-control" id="recruitment_overview" name="recruitment_overview" rows="7" placeholder="" v-model="job.recruitment_overview"></textarea>
                      <small class="form-text text-danger">{{ errors[0] }}</small>
                    </ValidationProvider>
                  </div>
                </div>
                <!-- End Col 12 -->

                <!-- Col 12 -->
                <div class="col-12">
                  <div class="form-group">
                    <ValidationProvider mode="eager" name="掲載写真" ref="provider" :rules="`mimes:image/*|ext:jpg,png,gif`" slim>
                      <label for="posphoto">掲載写真</label>
                      <div class="row col-sm-5">
                        <input type="file" accept="image/*" ref="fileInput" class="custom-file-input" id="posphoto" hidden="" @change="onFileChange" />
                        <summary>
                          <img :src="job.images" @click="$refs.fileInput.click()" class="figure-img img-fluid rounded" />
                        </summary>
                      </div>
                    </ValidationProvider>
                  </div>
                </div>
                <!-- End Col 12 -->

                <!-- Col 06 -->
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="perchar">働き方</label>
                    <div class="input-group">
                      <select2 class="form-control select2" name="work_style" v-model="job.work_style">
                        <option :value="option.id" v-for="(option, i) in lst_work_style" :key="i">{{ option.name }}</option>
                      </select2>
                      <div class="input-group-append">
                        <div class="input-group-text"><i class="fa fa-briefcase"></i></div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End Col 06 -->

                <!-- Col 12 -->
                <div class="col-12">
                  <div class="form-group">
                    <ValidationProvider name="業務内容" v-slot="{ errors }" rules="required|max:200" slim>
                      <label for="work_content"> 何をやるのか（業務内容）</label>
                      <textarea class="form-control" id="work_content" name="work_content" rows="7" placeholder="" v-model="job.work_content"></textarea>
                      <small class="form-text text-danger">{{ errors[0] }}</small>
                    </ValidationProvider>
                  </div>
                </div>
                <!-- End Col 12 -->

                <!-- Col 12 -->
                <div class="col-12">
                  <div class="form-group">
                    <ValidationProvider mode="eager" name="得られるスキル" v-slot="{ errors }" rules="required|max:200" slim>
                      <label for="skill_experience">仕事で得られるスキル・経験とは？（得られるスキル）</label>
                      <textarea class="form-control" id="skill_experience" name="skill_experience" rows="7" placeholder="" v-model="job.skill_experience"></textarea>
                      <small class="form-text text-danger">{{ errors[0] }}</small>
                    </ValidationProvider>
                  </div>
                </div>
                <!-- End Col 12 -->

                <!-- Col 12 -->
                <div class="col-12">
                  <div class="form-group">
                    <ValidationProvider mode="eager" name="魅力" v-slot="{ errors }" rules="required|max:200" slim>
                      <label for="attraction">仕事のやりがい・魅力は？（魅力）</label>
                      <textarea class="form-control" id="attraction" name="attraction" rows="7" placeholder="" v-model="job.attraction"></textarea>
                      <small class="form-text text-danger">{{ errors[0] }}</small>
                    </ValidationProvider>
                  </div>
                </div>
                <!-- End Col 12 -->

                <!-- Col 12 -->
                <div class="col-12">
                  <h6>雇用形態</h6>
                  <div class="form-group ml-2">
                    <!-- col 06 -->
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="salary_system">給与体系</label>
                        <div class="input-group">
                          <select2 class="form-control select2" name="salary_system" v-model="job.salary_system">
                            <option :value="option.id" v-for="(option, i) in lst_salary_system" :key="i">{{ option.name }}</option>
                          </select2>
                          <div class="input-group-append">
                            <div class="input-group-text"><i class="fa fa-window-maximize"></i></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End col 06 -->
                    <div class="col-sm-6"></div>
                    <!-- col 06 -->
                    <div class="row col-md-6 status-input">
                      <div class="col-10 col-sm-4">
                        <input id="salary_from" name="salary_from" type="text" class="form-control" placeholder="" v-model="job.salary_from" />
                      </div>
                      <label for="salary_from" class="col-1 col-form-label">円</label>
                      <label class="col-sm-2 col-form-label text-center"><b>〜</b></label>
                      <div class="col-10 col-sm-4">
                        <input id="salary_to" name="salary_to" type="text" class="form-control" placeholder="" v-model="job.salary_to" />
                      </div>
                      <label for="salary_to" class="col-1 col-form-label">円</label>
                    </div>
                    <!-- End col 06 -->
                  </div>
                </div>
                <!-- Col 12 -->

                <!-- Col 12 -->
                <div class="col-12">
                  <div class="form-group col-md-6 mb-3 ml-2">
                    <label for="">勤務地</label>
                    <div class="radio-lst">
                      <ValidationProvider vid="work_location" slim>
                        <div class="form-check form-check-block mb-2">
                          <input class="form-check-input" type="radio" name="work_location" v-bind:value="1" id="old_location" :checked="job.work_location == 1" v-model="job.work_location" />
                          <label class="form-check-label ml-2" for="old_location">企業情報に登録している住所と同一</label>
                        </div>
                      </ValidationProvider>
                      <div class="form-check form-check-block mb-2">
                        <input class="form-check-input" type="radio" name="work_location" v-bind:value="2" id="home_location" :checked="job.work_location == 2" v-model="job.work_location" />
                        <label class="form-check-label ml-2" for="home_location">在宅・リモート</label>
                      </div>
                      <div class="form-check form-check-block mb-2">
                        <input class="form-check-input" type="radio" name="work_location" v-bind:value="3" id="another_location" :checked="job.work_location == 3" v-model="job.work_location" />
                        <label class="form-check-label ml-2" for="another_location">別の住所を記載する</label>
                      </div>
                    </div>
                    <div v-if="job.work_location == kWorkLocationTypes.Another">
                      <!-- Form group -->
                      <ValidationProvider mode="eager" name="別の住所" v-slot="{ errors }" :rules="{ my_required_if: { target: 'work_location', values: kWorkLocationTypes.Another } }" slim>
                        <label for="another_address">別の住所</label>
                        <textarea v-model="job.address" :disabled="job.work_location != kWorkLocationTypes.Another" class="form-control" rows="4" id="another_address"></textarea>
                        <small class="form-text text-danger">{{ errors[0] }}</small>
                      </ValidationProvider>
                      <!-- End Form group -->
                    </div>
                  </div>
                </div>
                <!-- End Col 12 -->

                <!-- Col 12 -->
                <div class="col-12">
                  <div class="form-group">
                    <ValidationProvider mode="eager" name="採用人数" v-slot="{ errors }" rules="must_entered|min_value:0" slim>
                      <label for="employees_number">採用人数</label>
                      <div class="row">
                        <div class="row col-sm-7 status-input">
                          <div class="col-12 col-sm-5">
                            <!-- <select2 class="form-control select2" name="employees_number" v-model="job.employees_number">
                              <option :value="option" v-for="(option, i) in lst_employees_number" :key="i">{{ option }}</option>
                            </select2> -->
                            <input v-model="job.employees_number" type="text" class="form-control" id="employees_number" placeholder=""/>
                          </div>
                          <label for="employees_number" class="col-1 col-form-label">人</label>
                        </div>
                        <small class="form-text text-danger">{{ errors[0] }}</small>
                      </div>
                    </ValidationProvider>
                  </div>
                </div>
                <!-- Col 12 -->

                <!-- Col 12 -->
                <div class="col-12">
                  <div class="form-group">
                    <label for="">労働時間</label>
                    <div class="row">
                      <!-- col 06 -->
                      <div class="row col-sm-7 status-input">
                        <div class="col-12 col-sm-2">
                          <!-- <select2 class="form-control select2" name="working_start_at" v-model="job.working_start_at">
                            <option :value="option" v-for="(option, i) in lst_working_start_at" :key="i">{{ option }}</option>
                          </select2> -->
                          <input @change="onchangeInput(kInput.WorkingStartAt)" :value="job.working_start_at" type="text" class="form-control" id="working_start_at" placeholder=""/>
                        </div>
                        <label class="col-2 col-sm-1 col-form-label text-center"><b>〜</b></label>
                        <div class="col-12 col-sm-2">
                          <input @change="onchangeInput(kInput.WorkingEndAt)" :value="job.working_end_at" type="text" class="form-control" id="working_end_at" placeholder=""/>
                          <!-- <select2 class="form-control select2" name="working_end_at" v-model="job.working_end_at">
                            <option :value="option" v-for="(option, i) in lst_working_end_at" :key="i">{{ option }}</option>
                          </select2> -->
                        </div>
                      </div>
                      <!-- End col 06 -->
                    </div>
                  </div>
                </div>
                <!-- Col 12 -->

                <!-- Col 12 -->
                <div class="col-12">
                  <div class="form-group">
                    <ValidationProvider mode="eager" name="必要なスキル・経験" v-slot="{ errors }" rules="required|max:200" slim>
                      <label for="requirement_skill">必要なスキル・経験</label>
                      <textarea class="form-control" id="requirement_skill" name="requirement_skill" rows="7" placeholder="" v-model="job.requirement_skill"></textarea>
                      <small class="form-text text-danger">{{ errors[0] }}</small>
                    </ValidationProvider>
                  </div>
                </div>
                <!-- End Col 12 -->

                <!-- Col 12 -->
                <div class="col-12">
                  <ValidationProvider mode="eager" name="休日・休暇" v-slot="{ errors }" rules="max:100" slim>
                    <div class="form-group">
                      <label for="holiday_vacation">休日・休暇</label>
                      <textarea class="form-control" id="holiday_vacation" name="holiday_vacation" rows="7" placeholder="" v-model="job.holiday_vacation"></textarea>
                      <small class="form-text text-danger">{{ errors[0] }}</small>
                    </div>
                  </ValidationProvider>
                </div>
                <!-- End Col 12 -->
              </div>
              <!-- End Row -->
            </div>
            <!-- /.card-body -->
          </div>
          <!-- End General Form -->

          <div class="custom_btn text-center">
            <button type="button" class="btn blue-btn" @click="handleSubmit(beforeChange)">編集を保存</button>
            <button type="button" class="btn trans-btn" @click="resetForm">リセット</button>
          </div>
        </ValidationObserver>
      </form>
    </div>
    <!-- End Tab 02: Edit Tab -->
  </div>
  <!-- End Tab Content -->
</template>

<script>
import { mapGetters, mapActions, mapMutations } from "vuex";
import select2 from "../../Select2";
import datePicker from "vue-bootstrap-datetimepicker";
import vAlert from "../../Alert";
export default {
  components: {
    select2,
    datePicker,
    vAlert
  },
  data() {
    const dateFormat = "YYYY/MM/DD";
    const kDefaultImg = "/assets/img/posted-photo-plus.png";
    const kWorkLocationTypes = { Same: "1", Remote: "2", Another: "3" };
    const kInput = { WorkingStartAt: 'working_start_at', WorkingEndAt: 'working_end_at' };

    return {
      job: {},
      selectedFile: "",
      status: {},
      page_alert: null,
      lst_job_category: {},
      lst_work_style: {},
      lst_salary_system: {},
      lst_employees_number: {},
      lst_working_start_at: {},
      lst_working_end_at: {},
      kInput: kInput,
      kWorkLocationTypes: kWorkLocationTypes,
      datepickerConfig: {
        format: dateFormat,
        useCurrent: false,
        locale: "ja"
      }
    };
  },
  computed: {
    ...mapGetters(["errors", "settings"]),
    ...mapGetters("admin", ["isLogin", "adminData"])
  },
  created() {
    let jobId = this.$router.currentRoute.params.id;
    this.$store.commit("admin/updateTabbar", { jobId: jobId, showTabbar: true });
    this.$store.commit("admin/updatePageheader", { hasSubtitle: false, hasBreadcrumb: true });
  },
  mounted() {
    this.status = this.settings.job_status;
    this.loadInitData();
    this.loadJobDetail();
  },
  methods: {
    ...mapActions("admin", ["jobDetailByID", "sendInitDataRequest"]),
    ///
    onchangeInput(fieldName) {
      var val = $(event.target).val().split(':');
      var hh = 9, mm = 0;

      if (val && val.length >= 2) {
        hh = parseInt(val[0]); mm = parseInt(val[1]);
      }
      else if (val && val.length == 1) {
        hh = parseInt(val[0]);
      }
      var validHour = (!isNaN(hh) && hh >=0 && hh <= 23);
      var validMinute = (!isNaN(mm) && mm >=0 && mm <= 59);
      var res = "";

      if (validHour) {
        res += this.padZero(hh, 2) + ":";
      }
      else {
        res += "00:";
      }

      if (validMinute) {
        res += this.padZero(mm, 2);
      }
      else {
        res += "00";
      }
      $(event.target).val(res);
      
      if (fieldName == this.kInput.WorkingStartAt) {
        this.job.working_start_at = res;
      }
      else if (fieldName == this.kInput.WorkingEndAt) {
        this.job.working_end_at = res;
      }
    },
    padZero(num, size) {
      num = num.toString();
      while (num.length < size) num = "0" + num;
      return num;
    },
    async loadInitData() {
      let _self = this;
      _self.sendInitDataRequest().then(
        res => {
          _self.lst_job_category = res.data.konst.lst_job_category;
          _self.lst_work_style = res.data.konst.lst_work_style;
          _self.lst_salary_system = res.data.konst.lst_salary_system;
          _self.lst_employees_number = res.data.konst.lst_employees_number;
          _self.lst_working_start_at = res.data.konst.lst_working_start_at;
          _self.lst_working_end_at = res.data.konst.lst_working_end_at;
        },
        error => {}
      );
    },
    async onFileChange({ target: { files } }) {
      let _self = this;
      const valid = await _self.$refs.provider.validate(files[0]);
      if (!valid) {
      } else {
        const file = files[0];
        if (file && file != "undefined") {
          _self.job.images = URL.createObjectURL(file);
          _self.selectedFile = file;
        } else {
          _self.job.images = "/assets/img/posted-photo-plus.png";
          _self.selectedFile = null;
        }
      }
    },
    async loadJobDetail() {
      let _self = this;
      let jobId = this.$router.currentRoute.params.id;
      _self.jobDetailByID({ id: jobId }).then(
        res => {
          _self.fillData(res.data.payload);
        },
        error => {
          _self.$router.push({ name: "admin.job.index" });
        }
      );
    },
    fillData(payload) {
      let _self = this;
      _self.job = payload;
      _self.job.public           = payload.job_status ? payload.job_status.id : null;
      _self.job.job_category     = payload.job_category ? payload.job_category.id : null;
      _self.job.work_style       = payload.work_style ? payload.work_style.id : null;
      _self.job.salary_system    = payload.salary_system ? payload.salary_system.id : null;
      _self.job.employees_number = payload.employees_number ? payload.employees_number.text : null;
      _self.job.working_start_at = payload.working_start_at ? payload.working_start_at.text : null;
      _self.job.working_end_at   = payload.working_end_at ? payload.working_end_at.text : null;
    },
    async beforeChange() {
      let _self = this;
      _self.page_alert = null;
      const valid = await _self.$refs.observer.validate();
      if (valid) {
        _self.showDialogConfirm();
      }
    },
    resetForm() {
      window.location.reload(); return;
    },
    showDialogConfirm() {
      const params = {
        title: "確認",
        text: "更新しますか？",
        onConfirm: () => {
          return this.updateJobInfo();
        }
      };
      this.$modal.dialogConfirm(params);
    },
    updateJobInfo() {
      let _self = this;
      const formData = new FormData();
      formData.append("job", JSON.stringify(_self.job));
      formData.append("id", _self.$route.params.id);
      formData.append("image", _self.selectedFile);
      formData.append("_method", "POST"); // ADD THIS LINE
      const config = {
        headers: {
          "content-type": "multipart/form-data"
        }
      };
      axios.post("administrator/job/update/" + _self.$route.params.id, formData, config).then(
        res => {
          _self.fillData(res.data.payload);
          _self.page_alert = {
            type: "success",
            message: _self.trans.get("messages.M120")
          };
        },
        error => {
          _self.page_alert = {
            type: "danger",
            message: _self.errors
          };
        }
      );
    }
  }
};
</script>
