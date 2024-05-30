<template>
  <section class="job-lst-cont" :style="viewMode ? 'margin-bottom: 0;' : ''">
    <div class="container">
      <v-alert v-if="page_alert" ref="page-alert" :type="page_alert.type" :messages="page_alert.message" autoscroll dismissible autofade :delay="500000"></v-alert>
      <div class="row">
        <div class="col-md-12">
          <div class="section-title-02 mb-4">
            <h4>WEBレジュメ</h4>
          </div>
          <div>
            <!-- Form -->
            <form class="mt-4" ref="web-resume-data">
              <!-- Form Block -->
              <ValidationObserver ref="validation-observer">
                <div class="form-row mb-5 frm-block form-web">
                  <ValidationProvider mode="eager" name="氏名" v-slot="{ errors }" rules="required|range_length:100" slim>
                    <!-- Form group -->
                    <div class="form-group col-md-6 mb-5">
                      <label for="username">氏名 <span v-if="!viewMode" class="red-required">必須</span></label>
                      <p v-if="viewMode"  class="frm-show-data">{{ user.name }}</p>
                      <input v-else type="text" class="form-control" id="username" name="name" placeholder="" v-model="user.new_name" />
                      <small class="form-text text-error" v-if="formError.name && !errors.length">{{ formError.name[0] }}</small>
                      <small class="form-text text-error" v-else-if="errors[0]">{{ errors[0] }}</small>
                    </div>
                  </ValidationProvider>
                  <!-- End Form group -->

                  <!-- Form group -->
                  <ValidationProvider mode="eager" name="氏名ふりがな" v-slot="{ errors }" rules="required|furigana|range_length:100 " slim>
                    <div class="form-group col-md-6 mb-5">
                      <label for="furigana_name">ふりがな <span v-if="!viewMode" class="red-required">必須</span></label>
                      <p v-if="viewMode" class="frm-show-data">{{ user.furigana }}</p>
                      <input v-else type="text" class="form-control" name="furigana" id="furigana_name" placeholder="" v-model="user.new_furigana" />
                      <!-- <small class="form-text text-error" v-if="validationFuriganaName"> name must be furigana</small> -->
                      <small class="form-text text-error" v-if="formError.furigana && !errors.length">{{ formError.furigana[0] }}</small>
                      <small class="form-text text-error" v-else-if="errors[0]">{{ errors[0] }}</small>
                    </div>
                  </ValidationProvider>
                  <!-- End Form group -->

                  <!-- Form group -->
                  <ValidationProvider mode="eager" name="メールアドレス" v-slot="{ errors }" rules="required|email" slim>
                    <div class="form-group col-md-6 mb-5">
                      <label for="email">メールアドレス <span v-if="!viewMode" class="red-required">必須</span></label>
                      <p v-if="viewMode" class="frm-show-data">{{ user.email }}</p>
                      <input v-else type="text" class="form-control" name="email" id="email" placeholder="" v-model="user.new_email" />
                      <small class="form-text text-error" v-if="formError.email && !errors.length">{{ formError.email[0] }}</small>
                      <small class="form-text text-error" v-else-if="errors[0]">{{ errors[0] }}</small>
                    </div>
                  </ValidationProvider>
                  <!-- End Form group -->

                  <!-- Form group -->
                  <ValidationProvider mode="eager" name="電話番号" v-slot="{ errors }" rules="required|range_length:20|phone_number" slim>
                    <div class="form-group col-md-6 mb-5">
                      <label for="phone_num">電話番号 <span v-if="!viewMode" class="red-required">必須</span></label>
                      <p v-if="viewMode" class="frm-show-data">{{ user.phone_number }}</p>
                      <input v-else type="text" class="form-control" name="phone_number" id="phone_num" placeholder="" v-model="user.new_phone_number" />
                      <small class="form-text text-error" v-if="formError.phone_number && !errors.length">{{ formError.phone_number[0] }}</small>
                      <small class="form-text text-error" v-else-if="errors[0]">{{ errors[0] }}</small>
                    </div>
                  </ValidationProvider>
                  <!-- End Form group -->

                  <!-- Form group -->
                  <ValidationProvider mode="eager" name="性別" v-slot="{ errors }" rules="required" slim>
                    <div class="form-group col-md-6 mb-5">
                      <label>性別 <span v-if="!viewMode" class="red-required">必須</span></label>
                      <p v-if="viewMode" class="frm-show-data">{{ user.gender == 1 ? '男性' : (user.gender == 2 ? '女性' : '') }}</p>
                      <div v-else class="radio-lst">
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="gender" id="male" placeholder="" :checked="user.gender == 1" v-model="user.new_gender" value="1" />
                          <label class="form-check-label" for="male">男性</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="gender" id="female" placeholder="" :checked="user.gender == 2" v-model="user.new_gender" value="2" />
                          <label class="form-check-label" for="female">女性</label>
                        </div>
                      </div>
                      <small class="form-text text-error" v-if="formError.gender && !errors.length">{{ formError.gender[0] }}</small>
                      <small class="form-text text-error" v-else-if="errors[0]">{{ errors[0] }}</small>
                    </div>
                  </ValidationProvider>
                  <!-- End Form group -->

                  <!-- Form group -->
                  <ValidationProvider mode="eager" ref="birthday-validation" name="生年月日" v-slot="{ errors }" rules="required|date_format|date" slim>
                    <div class="form-group col-md-6 mb-5">
                      <label for="birthday">生年月日 <span v-if="!viewMode" class="red-required">必須</span></label>
                      <p v-if="viewMode" class="frm-show-data">{{ user.birthday }}</p>
                      <div v-else class="input-group date" data-target-input="nearest">
                        <date-picker v-model="user.new_birthday" name="birthday" :config="datepickerConfig" ref="date-picker" :placeholder="today" @dp-change="validateBirthday"></date-picker>
                        <div class="input-group-append" v-on:click="$refs['date-picker'].dp.show()" style="cursor:pointer">
                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                      </div>
                      <small class="form-text text-error" v-if="formError.birthday && !errors.length">{{ formError.birthday[0] }}</small>
                      <small class="form-text text-error" v-else-if="errors[0]">{{ errors[0] }}</small>
                    </div>
                  </ValidationProvider>
                  <!-- End Form group -->

                  <!-- Form group -->
                  <ValidationProvider mode="eager" name="都道府県" v-slot="{ errors }" rules="required" slim>
                    <div class="form-group col-md-6 select-border">
                      <label for="sector">都道府県 <span v-if="!viewMode" class="red-required">必須</span></label>
                      <p v-if="viewMode" class="frm-show-data">{{ user_prefecture.name }}</p>
                      <select2 v-else class="form-control basic-select" name="prefecture_id" v-model="user_prefecture.id">
                        <option value="" :selected="!user_prefecture.id" disabled></option>
                        <option v-for="(prefecture, key) in metaData.prefectures" v-bind:value="key" v-bind:key="key" v-bind:selected="key == user_prefecture.id">{{
                          prefecture.name
                        }}</option>
                      </select2>
                      <small class="form-text text-error" v-if="errors[0]">{{ errors[0] }}</small>
                    </div>
                  </ValidationProvider>
                  <!-- End Form group -->

                  <!-- Form group -->
                  <div class="form-group col-md-6">
                    <label for="school">最終学歴（学校名）</label>
                    <p v-if="viewMode" class="frm-show-data">{{ user.graduated_school }}</p>
                    <input v-else type="text" class="form-control" name="graduated_school" id="school" v-bind:value="user.graduated_school" placeholder="" />
                  </div>
                  <!-- End Form group -->
                </div>
                <!-- End Form Block -->

                <!-- Form Block -->
                <ValidationProvider mode="eager" name="スキル" v-slot="{ errors }" rules="required|max:3" tag="div" slim>
                  <div class="form-row mb-5 frm-block form-web">
                    <p class="frm-txt">経験の多い、または 自信のある【職種・スキル】を最大３つまで選んでください。
                      <span v-if="!viewMode" class="red-required">必須</span>
                    </p>
                    <small class="form-text text-error frm-text-error" v-if="errors[0]">{{ (errors[0] == trans.get("messages.M101").replace(':attribute', 'スキル')) ? '職種・スキルの選択は３つ以内にしてください。' : errors[0] }}</small>
                    <!-- Form group -->
                    <p v-if="metaData.length == 0" class="col-12 text-center">読み込み中...</p>
                    <div v-if="!viewMode" v-for="item in metaData.skills" class="form-group col-md-4">
                      <div class="custom-control custom-checkbox">
                          <input type="checkbox" class="custom-control-input" :value="item.id"
                            v-model="selectedSkills" :checked="item.is_user_option" :id="'skill-' + item.id" />
                          <label class="custom-control-label" :for="'skill-' + item.id">{{ item.name }}</label>
                      </div>
                    </div>
                    <template v-for="item in metaData.skills">
                      <div v-if="viewMode && item.is_user_option" class="col-md-4">
                        <div class="custom-control custom-checkbox">
                          <input style="cursor: default;" class="custom-control-input" checked type="checkbox" :id="'skill-' + item.id" name="skill" disabled="">
                          <label style="cursor: default;" :for="'skill-' + item.id" class="custom-control-label">{{ item.name }}</label>
                        </div>
                      </div>
                    </template>
                    <!-- End Form group -->
                  </div>
                </ValidationProvider>

                <!-- Form Block -->
                <ValidationProvider mode="eager" name="希望職種" v-slot="{ errors }" rules="required" tag="div" slim>
                <div class="form-row mb-5 frm-block form-web">
                  <p class="frm-txt">希望職種<span v-if="!viewMode" class="red-required">必須</span></p>
                  <small class="form-text text-error frm-text-error" v-if="errors[0]">{{ errors[0] }}</small>

                  <!-- Form group -->
                  <p v-if="metaData.length == 0" class="col-12 text-center">読み込み中...</p>
                  <div v-if="!viewMode" v-for="(item, key) in metaData.desired_occupations" class="form-group col-md-4">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input" :id="'job-' + item.id" :value="item.id" :checked="item.is_user_option" v-model="selectedDesiredOccupations" />
                      <label class="custom-control-label" :for="'job-' + item.id">{{ item.name }}</label>
                    </div>
                  </div>
                  <template v-for="item in metaData.desired_occupations">
                    <div v-if="viewMode && item.is_user_option" class="col-md-4">
                      <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" style="cursor: default;" checked disabled type="checkbox" :id="'skill-' + item.id" name="skill">
                        <label :for="'skill-' + item.id" class="custom-control-label" style="cursor: default;">{{ item.name }}</label>
                      </div>
                    </div>
                  </template>
                  <!-- End Form group -->
                </div>
                </ValidationProvider>
                <!-- End Form Block -->

                <!-- Form Block -->
                <ValidationProvider mode="eager" name="希望の働き方" v-slot="{ errors }" rules="required" tag="div" slim>
                <div class="form-row mb-5 frm-block form-web">
                  <p class="frm-txt">希望の働き方<span v-if="!viewMode" class="red-required">必須</span></p>
                  <small class="form-text text-error frm-text-error" v-if="errors[0]">{{ errors[0] }}</small>
                  <p v-if="metaData.length == 0" class="col-12 text-center">読み込み中...</p>
                  <div v-if="!viewMode" v-for="(item, key) in metaData.desired_working_styles" class="form-group col-md-4">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" :value="item.id" class="custom-control-input" :checked="item.is_user_option" :id="'style-' + item.id" v-model="selectedDesiredWorkingStyles" />
                      <label class="custom-control-label" :for="'style-' + item.id">{{ item.name }}</label>
                    </div>
                  </div>
                  <template v-for="item in metaData.desired_working_styles">
                    <div v-if="viewMode && item.is_user_option" class="col-md-4">
                      <div class="custom-control custom-checkbox">
                        <input style="cursor: default;" class="custom-control-input" checked type="checkbox" :id="'skill-' + item.id" name="skill" disabled="">
                        <label style="cursor: default;" :for="'skill-' + item.id" class="custom-control-label">{{ item.name }}</label>
                      </div>
                    </div>
                  </template>
                </div>
                </ValidationProvider>
                <!-- End Form Block -->

                <!-- </ValidationProvider> -->
                <!-- Form Block -->
                <ValidationProvider v-if="!viewMode" ref="cities-validation" mode="eager" name="希望勤務地" v-slot="{ errors }" rules="required" tag="div" slim>
                <div class="form-row mb-5 frm-block form-web">
                  <p class="frm-txt">希望勤務地<span class="red-required">必須</span></p>
                  <small class="form-text text-error frm-text-error" v-if="errors[0]">{{ errors[0] }}</small>

                  <!-- Accordion Block -->
                  <p v-if="metaData.length == 0" class="col-12 text-center">読み込み中...</p>
                  <div class="accordion user-accordion" id="accordion">
                    <!-- Accordion Item -->
                    <div class="form-row mr-1 ml-1" v-for="(area, area_id) in metaData.areas" v-bind:key="area_id">
                      <p class="frm-txt">{{ area.name }}</p>
                      <p v-if="render.indexOf(area_id) < 0 && !area.prefectures" class="col-12 text-center">読み込み中...</p>
                      <div v-if="!viewMode" v-for="(item, key) in area.prefectures" class="form-group col-md-4">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" :value="item.id" class="custom-control-input" :id="'pos-' + item.id" v-model="selectedPrefectures" />
                          <label class="custom-control-label" :for="'pos-' + item.id">{{ item.name }}</label>
                        </div>
                      </div>
                      <template v-for="item in area.prefectures">
                        <div v-if="viewMode && selectedPrefectures.indexof(item.id) >= 0" class="col-md-4">
                          <div class="custom-control custom-checkbox">
                            <input style="cursor: default;" class="custom-control-input" checked type="checkbox" :id="'pos-' + item.id" disabled="">
                            <label style="cursor: default;" :for="'pos-' + item.id" class="custom-control-label">{{ item.name }}</label>
                          </div>
                        </div>
                      </template>
                    </div>
                  </div>
                  <div class="accordion user-accordion" id="accordion2">
                    <div id="accordion-title-nine" class="accordion-title">
                      <div class="form-row mr-1 ml-1">
                        <p class="frm-txt">在宅</p>
                        <div class="form-group col-md-4">
                          <div class="custom-control custom-radio">
                            <input type="radio" id="full_remote" name="work_at_home" value="full_remote" class="custom-control-input"
                              :checked="selectedPrefectures.indexOf('full_remote') >= 0" @change="onChangeWorkAtHome">
                            <input type="radio" hidden="hidden" value="full_remote" v-model="selectedPrefectures">
                            <label for="full_remote" class="custom-control-label">フルリモート</label>
                            </div>
                          </div>
                        <div class="form-group col-md-4">
                          <div class="custom-control custom-radio">
                            <input type="radio" id="some_remote" value="some_remote" name="work_at_home" class="custom-control-input"
                             :checked="selectedPrefectures.indexOf('some_remote') >= 0" @change="onChangeWorkAtHome">
                            <input type="radio" hidden="hidden" value="some_remote" v-model="selectedPrefectures">
                            <label for="some_remote" class="custom-control-label">一部リモート</label>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                </ValidationProvider>
                <div v-else class="form-row mb-5 frm-block form-web">
                <div class="card-body pb-2">
                  <p class="frm-txt">希望勤務地</p>
                  <div class="accordion user-accordion" id="accordion">
                    <template v-for="(area, area_id) in metaData.areas">
                      <div v-if="Object.keys(metaData.preferred_workplaces).indexOf(area_id) >= 0" class="accordion-item" v-bind:key="area_id">
                        <p class="frm-txt">{{ area.name }}
                        <div class="form-row collapse show">
                          <template v-for="(prefecture, key) in area.prefectures">
                          <div v-if="selectedPrefectures.indexOf(prefecture.id) >= 0" class="col-md-4" v-bind:key="key">
                            <div class="custom-control custom-checkbox">
                              <input style="cursor: default;" type="checkbox" checked class="custom-control-input" :id="'pos-' + (area_id + 1) + '-' + (key + 1)" disabled="">
                              <label style="cursor: default;" class="custom-control-label" :for="'pos-' + (area_id + 1) + '-' + (key + 1)">{{ prefecture.name }}</label>
                            </div>
                          </div></template>
                        </div>
                      </div>
                    </template>
                  </div>
                  <div class="accordion user-accordion" id="accordion2">
                    <div id="accordion-title-nine" class="accordion-title">
                      <div class="form-row mr-1 ml-1">
                        <p class="frm-txt">在宅</p>
                        <div class="form-group col-md-4">
                          <div class="custom-control custom-radio">
                            <input type="radio" id="full_remote" name="work_at_home" value="full_remote" class="custom-control-input"
                              :checked="selectedPrefectures.indexOf('full_remote') >= 0" disabled>
                            <label for="full_remote" class="custom-control-label">フルリモート</label>
                            </div>
                          </div>
                        <div class="form-group col-md-4">
                          <div class="custom-control custom-radio">
                            <input type="radio" id="some_remote" value="some_remote" name="work_at_home" class="custom-control-input"
                             :checked="selectedPrefectures.indexOf('some_remote') >= 0" disabled>
                            <label for="some_remote" class="custom-control-label">一部リモート</label>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
                <!-- End Form Block -->

                <!-- Form Block -->
                <!-- <ValidationProvider mode="eager" name="スキル" v-slot="{ errors }" rules="" tag="div" slim> -->
                <div class="form-row mb-5 frm-dashboard-block" v-if="enableWorkExperiences">
                  <div class="col-md-12 dashboard-title d-flex align-items-center">
                    <div class="section-title-02 mb-sm-0">
                      <h4 class="mb-0">職務経歴</h4>
                    </div>
                    <a class="btn btn-md ml-sm-auto blue-btn" href="javascript:void(0)" v-on:click="addWorkExperience">職務経歴を追加</a>
                  </div>

                  <!-- Dashboard Timeline  -->
                  <template v-for="(item, key) in workExperiences">
                    <div class="col-md-12 mt-3 dashboard-timeline-info d-flex align-items-center">
                      <div class="dashboard-timeline-edit">
                        <ul class="list-unstyled d-flex">
                          <li class="mr-1">
                            <a class="text-right" data-toggle="collapse" href="#dateposted-16" role="button" aria-expanded="false" aria-controls="dateposted">
                              <i class="fas fa-pencil-alt text-info mr-2"></i>
                            </a>
                          </li>
                          <li class="mr-1">
                            <a href="javascript:void(0)" v-on:click="removeWorkExperience(key)">
                              <i class="far fa-trash-alt text-danger"></i>
                            </a>
                          </li>
                        </ul>
                      </div>
                      <h6 class="mb-2">職務経歴{{ key + 1 }}</h6>
                    </div>

                    <div class="col-md-12 bg-light p-3 mb-4" :id="'work-xperiences-' + key">
                      <v-alert v-if="changedWorkExp === key && item.alert" ref="page-alert" :type="item.alert.type"
                        :messages="item.alert.message" autoscroll dismissible autofade></v-alert>
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label>会社名</label>
                          <input type="text" class="form-control" v-model="item.companyName" placeholder="" />
                        </div>
                      </div>

                      <div class="form-row">
                        <div class="form-group col-md-6 select-border">
                          <label>勤務期間</label>
                          <select2 class="form-control basic-select" v-model="item.workingPeriod">
                            <option value="15" v-for="i in 25" v-bind:value="i * 12 + 3" v-bind:selected="i * 12 + 3 == item.workingPeriod">{{ i }}年 3ヶ月</option>
                          </select2>
                        </div>
                        <div class="form-group col-md-6">
                          <label>職種</label>
                          <select2 class="form-control basic-select" v-model="item.occupation">
                            <option value="1" v-bind:selected="'1' == item.occupation">WEBマーケティング・広告運用</option>
                            <option value="2" v-bind:selected="'2' == item.occupation">マーケティング・広告運用</option>
                            <option value="3" v-bind:selected="'3' == item.occupation">広告運用</option>
                          </select2>
                        </div>
                      </div>

                      <div class="form-row">
                        <div class="form-group col-md-12">
                          <label>職務内容</label>
                          <textarea class="form-control" rows="4" v-model="item.jobContent"></textarea>
                        </div>
                        <div class="form-group col-md-12 mb-0 mt-3">
                          <a class="btn btn-md blue-btn" href="javacript:void(0)" v-on:click="updateWorkExperience(item, key)">登録</a>
                        </div>
                      </div>
                    </div>
                  </template>
                  <!-- End Dashboard Timeline  -->
                </div>
                <div class="form-row mb-5 frm-block form-web">
                  <div class="col-md-12 mb-0">
                    <div class="form-group">
                      <label>ご質問や条件面などのご相談</label>
                      <p v-if="viewMode" class="frm-show-data" v-html="user.questions"></p>
                      <textarea v-else class="form-control" name="questions" v-model="user.questions" rows="4"></textarea>
                    </div>
                  </div>
                </div>
                <!-- End Form Block -->
                <div class="col-md-12 my-5 mx-auto text-center" v-if="!viewMode">
                  <a class="btn yellow-btn btn-lg" href="javascript:void(0)" title="上記内容で登録する" v-on:click="handleSubmit">上記内容で登録する</a>
                </div>
              </ValidationObserver>
            </form>
            <!-- End Form -->
          </div>
        </div>
      </div>
    </div>
    <DialogConfirm />
  </section>
</template>
<script>
import { mapGetters, mapActions } from "vuex";
// import vue-bootstrap-datetimepick
import datePicker from "vue-bootstrap-datetimepicker";
// import moment
import moment from "moment";
import select2 from "./../Select2";
import vAlert from "../Alert";

export default {
  props: ['viewMode'],
  data() {
    const dateFormat = "YYYY/MM/DD";
    return {
      render: [],
      user: {},
      today: moment().format(dateFormat),
      datepickerConfig: {
        format: dateFormat,
        useCurrent: false,
        locale: "ja"
      },
      metaData: [],
      workExperiences: [],
      enableWorkExperiences: false,
      selectedSkills: [],
      selectedPrefectures: [],
      selectedDesiredOccupations: [],
      selectedDesiredWorkingStyles: [],
      page_alert: null,
      errors: null,
      loadingUrl: '',
      changedWorkExp: false,
      formError: {},
    };
  },
  computed: {
    ...mapGetters("user", ["isLogin", "userData"]),
    user_prefecture : {
      get() {
        return this.user.prefecture ? this.user.prefecture : {id:'',name:''};
      },
      set(value) {
        if(this.user.prefecture) {
          this.user.prefecture.id = value;
        }
        else{
          this.user.prefecture = {id: value};
        }
      }
    }
  },
  created() {
    this.user = this.userData;
    this.setNewData();
  },
  mounted() {
    this.$store.commit("setErrors", {});
    this.masterData();
    this.setupAxios();
  },
  methods: {
    ...mapActions("user", ["getMasterData", "sendUpdateRequest"]),
    async handleSubmit() {
      const valid = await this.$refs["validation-observer"].validate();
      if (valid) {
        return this.showDialogConfirm();
      }
      this.scrollToError();
    },
    setNewData() {
      this.user.new_name = this.user.name;
      this.user.new_furigana = this.user.furigana;
      this.user.new_email = this.user.email;
      this.user.new_birthday = this.user.birthday;
      this.user.new_phone_number = this.user.phone_number;
      this.user.new_prefecture = this.user.prefecture;
      this.user.new_graduated_school = this.user.graduated_school;
      this.user.new_gender = ["1", "2"].includes("" + this.user.gender) ? this.user.gender : null;
    },
    scrollToError() {
      const firstError = $("small.form-text.text-error").first().closest('div');
      this.$_scrollTo(firstError);
    },
    updateUser() {
      this.$_loadingIcon('show');
      let _self = this;
      _self.clearAlert();
      const formData = new FormData(_self.$refs["web-resume-data"]);
      var data = {};
      for (var entrie of formData.entries()) {
        data[entrie[0]] = entrie[1];
      }
      data.options = _self.selectedSkills.concat(_self.selectedDesiredOccupations).concat(_self.selectedDesiredWorkingStyles);
      data.workExperiences = _self.workExperiences;
      let separateWorkAtHome = this.separateWorkAtHome(_self.selectedPrefectures);
      data.preferredWorkplaces = separateWorkAtHome.cities;
      data.work_at_home = separateWorkAtHome.work_at_home;
      _self.sendUpdateRequest(data).then(
        res => {
          _self.user = res.data.payload;
          _self.setNewData();
          _self.$root.$emit('setUserCompleteName', _self.userData.complete_name);
          _self.page_alert = {
            type: "success",
            message: res.data.messages
          };
          _self.formError = {};
          _self.$_loadingIcon('hide');
        },
        error => {
          _self.$_loadingIcon('hide');
          if(error.response.status == 422) {
            _self.formError = error.response.data.errors;
            setTimeout(function() {
              _self.scrollToError();
            },0);
            return
          }
          _self.user.errors = error.errors;
          _self.page_alert = {
            type: "danger",
            message: "errors"
          };
        }
      );
    },
    updateWorkExperience(workExperience, workExperienceKey) {
      this.workExperiences[workExperienceKey].alert = null;
      this.changedWorkExp = false;
      let isEmpty =  (!workExperience.companyName) && (!workExperience.workingPeriod)
                  && (!workExperience.jobContent) && (!workExperience.occupation);
      if(isEmpty) return;
      axios.post("work-experiences", workExperience).then(res => {
        let message = workExperience.id ? this.trans.get("messages.M120") : this.trans.get("messages.M123");
        this.workExperiences[workExperienceKey] = {
        alert: {
          type: 'success',
          message: message
        },
        id: res.data.id,
        companyName: res.data.company_name,
        jobContent: res.data.description,
        occupation: res.data.occupation,
        workingPeriod: res.data.working_period};
        this.changedWorkExp = workExperienceKey;
      });
    },
    async masterData() {
      this.$_loadingIcon('show');
      let _this = this;
      await this.getMasterData(this.user.id).then(res => {
        this.metaData = res.data;
        this.metaData.areas = res.data.areas;
        this.selectedSkills = [];
        this.selectedPrefectures = [];
        this.selectedDesiredOccupations = [];
        this.selectedDesiredWorkingStyles = [];
        for (let i in this.metaData.skills) {
          if (this.metaData.skills[i]["is_user_option"]) {
            this.selectedSkills.push(this.metaData.skills[i].id);
          }
        }
        for (let i in this.metaData.desired_occupations) {
          if (this.metaData.desired_occupations[i]["is_user_option"]) {
            this.selectedDesiredOccupations.push(this.metaData.desired_occupations[i].id);
          }
        }
        for (let i in this.metaData.desired_working_styles) {
          if (this.metaData.desired_working_styles[i]["is_user_option"]) {
            this.selectedDesiredWorkingStyles.push(this.metaData.desired_working_styles[i].id);
          }
        }
        for (let i in this.metaData.career_experiences) {
          this.workExperiences.push({
            id: this.metaData.career_experiences[i].id,
            occupation: this.metaData.career_experiences[i].occupation,
            jobContent: this.metaData.career_experiences[i].description,
            companyName: this.metaData.career_experiences[i].company_name,
            workingPeriod: this.metaData.career_experiences[i].working_period
          });
        }
        if (!this.workExperiences.length) {
          this.addWorkExperience();
        }
        for (let i in this.metaData.preferred_workplaces) {
          for (let j in this.metaData.preferred_workplaces[i]) {
            this.selectedPrefectures.push(this.metaData.preferred_workplaces[i][j]);
          }
          // this.loadCities(i);
        }
        switch (this.user.work_at_home) {
          case 1:
            this.selectedPrefectures.push('full_remote');
            break;
          case 2:
            this.selectedPrefectures.push('some_remote');
            break;
          default:
            break;
        }
        this.$_loadingIcon('hide');
      });
    },
    async validateBirthday() {
      await this.$refs["birthday-validation"].validate();
    },
    addWorkExperience() {
      const workExperienceExample = {
        companyName: "",
        workingPeriod: "",
        occupation: "",
        jobContent: ""
      };
      this.workExperiences.push(workExperienceExample);
    },
    removeWorkExperience(index) {
      this.workExperiences.splice(index, 1);
      if (!this.workExperiences.length) {
        this.addWorkExperience();
      }
    },
    async loadCities(areaId) {
      areaId = ''+areaId;
      if (this.metaData.areas[areaId].cities) {
        if(this.render.indexOf(areaId) < 0) {
          this.render.push(areaId);
        }
        return ;
      }
      await axios.get("area/" + areaId).then(res => {
        this.metaData.areas[areaId].cities = res.data;
        if(this.render.indexOf(areaId) < 0) {
          this.render.push(areaId);
        }
      });
    },
    clearAlert() {
      this.page_alert = null;
      for(let i in this.workExperiences) {
        this.workExperiences[i].alert = null;
      }
    },
    setupAxios() {
      let _this = this;
      axios.interceptors.request.use(function(config) {
        if(_this.loadingUrl == config.url){
          return Promise.reject();
        }
        _this.loadingUrl = config.url;
        return config;
      }, function(error) {
        _this.loadingUrl = '';
        if(error){
          return Promise.reject(error);
        }
        return Promise.reject();
      });
      axios.interceptors.response.use(function(response) {
        _this.loadingUrl = '';
        return response;
      }, function(error) {
        _this.loadingUrl = '';
        if(error){
          return Promise.reject(error);
        }
        return Promise.reject();
      });
    },
    showDialogConfirm() {
      const params = {
        title: this.trans.get('messages.M127'),
        text: this.trans.get('messages.M132'),
        onConfirm: () => {
          return this.updateUser();
        }
      };
      this.$modal.dialogConfirm(params);
    },
    onChangeWorkAtHome(e) {
      let key = this.selectedPrefectures.indexOf('some_remote');
      if(key < 0) {
        key = this.selectedPrefectures.indexOf('full_remote');
      }
      if(key >= 0) {
        this.selectedPrefectures[key] = e.target.value;
      }
      if(key < 0) {
        this.selectedPrefectures.push(e.target.value);
      }
      $('input[name=work_at_home]').val(e.target.value);
    },
    separateWorkAtHome(selectedPrefectures) {
      let workAtHome = $('input[name=work_at_home]').val();
      switch (workAtHome) {
        case 'full_remote':
          workAtHome = 1;
          break;
        case 'some_remote':
          workAtHome = 2;
          break;
        default:
          workAtHome = null;
          break;
      }
      let key = selectedPrefectures.indexOf('some_remote');
      if(key < 0) {
        key = selectedPrefectures.indexOf('full_remote');
      }
      let cities = [];
      for(let i in selectedPrefectures) {
        if(i == key) continue;
        cities.push(selectedPrefectures[i]);
      }
      return {
        cities: cities,
        work_at_home: workAtHome
      };
    }
  },
  components: {
    datePicker,
    select2,
    vAlert
  }
};
</script>
