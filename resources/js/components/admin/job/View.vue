<template>
  <!-- Tab Content -->
  <div class="bg_container tab-content">
    <!-- Tab 01: Checking Tab -->
    <div class="tab-pane active" id="checking" role="tabpanel" aria-labelledby="checking-tab">
      <form class="user-data-frm form_comp" role="form">
        <!-- Form status-->
        <div class="row form_status">
          <!-- col 04 -->
          <div class="col-sm-6 col-md-4">
            <div class="form-group">
              <p class="frm-show-data">{{ jobInfo.job_status_name }}</p>
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
                  <p class="frm-show-data">{{ jobInfo.id }}</p>
                </div>
              </div>
              <!-- End Col 06 -->

              <!-- Col 06 -->
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="created_date">作成日</label>
                  <p class="frm-show-data">{{ jobInfo.created_at_formated_date }}</p>
                </div>
              </div>
              <!-- End Col 06 -->

              <!-- Col 12 -->
              <div class="col-12">
                <div class="form-group">
                  <label for="namecompany">求人タイトル</label>
                  <p class="frm-show-data">{{ jobInfo.job_title }}</p>
                </div>
              </div>
              <!-- End Col 12 -->

              <!-- Col 06 -->
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="perchar">募集職種</label>
                  <div class="input-group">
                    <p class="frm-show-data">{{ jobInfo.job_category_name }}</p>
                    <div class="input-group-append">
                      <div class="input-group-text"><i class="fa fa-user-tie"></i></div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- End Col 06 -->

              <!-- Col 12 -->
              <div class="col-12">
                <div class="form-group">
                  <label for="recruitment_overview">募集概要</label>
                  <textarea disabled class="form-control" id="recruitment_overview" rows="7" placeholder="" v-model="jobInfo.recruitment_overview"></textarea>
                </div>
              </div>
              <!-- End Col 12 -->

              <!-- Col 12 -->
              <div class="col-12">
                <div class="form-group">
                  <label for="">掲載写真</label>
                  <div class="row col-sm-5">
                    <label for="posphoto">
                      <summary>
                        <img :src="jobInfo.images" alt="up img" class="figure-img img-fluid rounded" />
                      </summary>
                    </label>
                  </div>
                </div>
              </div>
              <!-- End Col 12 -->

              <!-- Col 06 -->
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="perchar">働き方</label>
                  <div class="input-group">
                    <p class="frm-show-data">{{ jobInfo.work_style_name }}</p>
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
                  <label for="work_content">何をやるのか（業務内容）</label>
                  <textarea disabled class="form-control" id="work_content" rows="7" placeholder="" v-model="jobInfo.work_content"></textarea>
                </div>
              </div>
              <!-- End Col 12 -->

              <!-- Col 12 -->
              <div class="col-12">
                <div class="form-group">
                  <label for="skill_experience">仕事で得られるスキル・経験とは？（得られるスキル）</label>
                  <textarea disabled class="form-control" id="skill_experience" rows="7" placeholder="" v-model="jobInfo.skill_experience"></textarea>
                </div>
              </div>
              <!-- End Col 12 -->

              <!-- Col 12 -->
              <div class="col-12">
                <div class="form-group">
                  <label for="attraction">仕事のやりがい・魅力は？（魅力）</label>
                  <textarea disabled class="form-control" id="attraction" rows="7" placeholder="" v-model="jobInfo.attraction"></textarea>
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
                        <p class="frm-show-data">{{ jobInfo.salary_system_name }}</p>
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
                      <p class="frm-show-data">{{ jobInfo.salary_from }}</p>
                    </div>
                    <label for="salar_one" class="col-1 col-form-label">円</label>
                    <label class="col-sm-2 col-form-label text-center"><b>〜</b></label>
                    <div class="col-10 col-sm-4">
                      <p class="frm-show-data">{{ jobInfo.salary_to }}</p>
                    </div>
                    <label for="salar_two" class="col-1 col-form-label">円</label>
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
                    <div class="form-check form-check-block mb-2">
                      <input
                        class="form-check-input"
                        type="radio"
                        disabled
                        name="work_location"
                        v-bind:value="1"
                        id="old_location"
                        :checked="jobInfo.work_location == 1"
                        v-model="jobInfo.work_location"
                      />
                      <label class="form-check-label ml-2" for="old_location">企業情報に登録している住所と同一</label>
                    </div>
                    <div class="form-check form-check-block mb-2">
                      <input
                        class="form-check-input"
                        type="radio"
                        disabled
                        name="work_location"
                        v-bind:value="2"
                        id="home_location"
                        :checked="jobInfo.work_location == 2"
                        v-model="jobInfo.work_location"
                      />
                      <label class="form-check-label ml-2" for="home_location">在宅・リモート</label>
                    </div>
                    <div class="form-check form-check-block mb-2">
                      <input
                        class="form-check-input"
                        type="radio"
                        disabled
                        name="work_location"
                        v-bind:value="3"
                        id="another_location"
                        :checked="jobInfo.work_location == 3"
                        v-model="jobInfo.work_location"
                      />
                      <label class="form-check-label ml-2" for="another_location">別の住所を記載する</label>
                    </div>
                  </div>
                  <div v-if="jobInfo.work_location == 3">
                    <!-- Form group -->
                    <label for="address">別の住所</label>
                    <textarea v-model="jobInfo.address" disabled class="form-control" rows="4" id="address"></textarea>
                    <!-- End Form group -->
                  </div>
                </div>
              </div>
              <!-- End Col 12 -->

              <!-- Col 12 -->
              <div class="col-12">
                <div class="form-group ">
                  <label for="employees_number">採用人数</label>
                  <div class="row">
                    <div class="row col-sm-7 status-input">
                      <div class="col-12 col-sm-5">
                        <p class="frm-show-data">{{ jobInfo.employees_number_text }}</p>
                      </div>
                      <label for="employees_number" class="col-1 col-form-label">人</label>
                    </div>
                  </div>
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
                        <p class="frm-show-data">{{ jobInfo.working_start_at_text }}</p>
                      </div>
                      <label class="col-2 col-sm-1 col-form-label text-center"><b>〜</b></label>
                      <div class="col-12 col-sm-2">
                        <p class="frm-show-data">{{ jobInfo.working_end_at_text }}</p>
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
                  <label for="requirement_skill">必要なスキル・経験</label>
                  <textarea class="form-control" disabled id="requirement_skill" rows="7" placeholder="" v-model="jobInfo.requirement_skill"></textarea>
                </div>
              </div>
              <!-- End Col 12 -->

              <!-- Col 12 -->
              <div class="col-12">
                <div class="form-group">
                  <label for="holiday_vacation">休日・休暇</label>
                  <textarea disabled class="form-control" id="holiday_vacation" rows="7" placeholder="" v-model="jobInfo.holiday_vacation"></textarea>
                </div>
              </div>
              <!-- End Col 12 -->
            </div>
            <!-- End Row -->
          </div>
          <!-- /.card-body -->
        </div>
        <!-- End General Form -->
      </form>
    </div>
    <!-- End Tab 01: Checking Tab -->

    <!-- Tab 02: Edit Tab -->
    <div class="tab-pane" id="edit" role="tabpanel" aria-labelledby="edit-tab"></div>
    <!-- End Tab 02: Edit Tab -->

    <!-- Tab 03: Note Tab -->
    <div class="tab-pane" id="note" role="tabpanel" aria-labelledby="note-tab"></div>
    <!-- End Tab 03: Note Tab -->
  </div>
  <!-- End Tab Content -->
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import select2 from "../../Select2";
import datePicker from "vue-bootstrap-datetimepicker";
export default {
  components: {
    select2,
    datePicker
  },
  data() {
    return {
      jobInfo: {}
    };
  },
  computed: {
    ...mapGetters("admin", ["isLogin", "adminData"])
  },
  created() {
    let jobId = this.$router.currentRoute.params.id;
    this.$store.commit("admin/updateTabbar", { jobId: jobId, showTabbar: true });
  },
  mounted() {
    this.loadJobDetail();
  },
  methods: {
    ...mapActions("admin", ["jobDetailByID"]),
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
      _self.jobInfo = payload;
      _self.jobInfo.job_status_name = payload.job_status ? payload.job_status.name : null;
      _self.jobInfo.job_category_name = payload.job_category ? payload.job_category.name : null;
      _self.jobInfo.work_style_name = payload.work_style ? payload.work_style.name : null;
      _self.jobInfo.salary_system_name = payload.salary_system ? payload.salary_system.name : null;
      _self.jobInfo.employees_number_text = payload.employees_number ? payload.employees_number.text : null;
      _self.jobInfo.working_start_at_text = payload.working_start_at ? payload.working_start_at.text : null;
      _self.jobInfo.working_end_at_text = payload.working_end_at ? payload.working_end_at.text : null;
    }
  }
};
</script>
