<template>
  <section class="space-ptb mb-5">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-12">
          <div class="login-register">
            <div class="section-title">
              <h4 class="text-center">新規登録</h4>
            </div>
            <div class="tab-content">
              <div class="tab-pane active">
                <!-- Form -->
                <form class="mt-4" ref="user-register-form">
                  <ValidationObserver ref="validation-observer">
                    <!-- Form Block -->
                    <div class="form-row mb-5 frm-block">
                      <!-- Form group -->
                      <div class="form-group col-md-6 mb-5">
                        <ValidationProvider mode="eager" name="氏名" v-slot="{ errors }" rules="required|range_length:100" slim>
                          <label for="username">氏名 <span class="red-required">必須</span></label>
                          <input type="text" class="form-control" id="name" name="name" v-model="user.name" v-on:input="formError.name = ''" />
                          <small class="form-text text-error" v-if="formError.name && !errors.length">{{ formError.name[0] }}</small>
                          <small class="form-text text-error" v-else-if="errors[0]">{{ errors[0] }}</small>
                        </ValidationProvider>
                      </div>
                      <!-- End Form group -->

                      <!-- Form group -->
                      <div class="form-group col-md-6 mb-5">
                        <ValidationProvider mode="eager" name="氏名ふりがな" v-slot="{ errors }" rules="required|furigana|range_length:100 " slim>
                          <label for="furigana">ふりがな <span class="red-required">必須</span></label>
                          <input type="text" class="form-control" name="furigana" id="furigana" v-model="user.furigana" v-on:input="formError.furigana = ''" />
                          <small class="form-text text-error" v-if="formError.furigana && !errors.length">{{ formError.furigana[0] }}</small>
                          <small class="form-text text-error" v-else-if="errors[0]">{{ errors[0] }}</small>
                        </ValidationProvider>
                      </div>
                      <!-- End Form group -->

                      <!-- Form group -->
                      <div class="form-group col-md-6 mb-5">
                        <ValidationProvider mode="eager" name="メールアドレス" v-slot="{ errors }" rules="required|email" vid="email" slim>
                          <label for="email">メールアドレス <span class="red-required">必須</span></label>
                          <input type="text" class="form-control" name="email" id="email" v-model="user.email" v-on:input="formError.email = ''" />
                          <small class="form-text text-error" v-if="formError.email && !errors.length">{{ formError.email[0] }}</small>
                          <small class="form-text text-error" v-else-if="errors[0]">{{ errors[0] }}</small>
                        </ValidationProvider>
                      </div>
                      <!-- End Form group -->

                      <!-- Form group -->
                      <div class="form-group col-md-6 mb-5">
                        <ValidationProvider mode="eager" name="メールアドレス(確認用)" v-slot="{ errors }" rules="required|email_confirmed:email" slim>
                          <label for="email_confirmation">メールアドレス(確認用) <span class="red-required">必須</span></label>
                          <input type="text" class="form-control" name="confirm_email" id="email_confirmation"
                            v-model="user.email_confirmation" v-on:input="formError.confirm_email = ''" />
                          <small class="form-text text-error" v-if="formError.confirm_email && !errors.length">{{ formError.confirm_email[0] }}</small>
                          <small class="form-text text-error" v-else-if="errors[0]">{{ errors[0] }}</small>
                        </ValidationProvider>
                      </div>
                      <!-- End Form group -->

                      <!-- Form group -->
                      <div class="form-group col-md-6 mb-5">
                        <ValidationProvider mode="eager" name="パスワード" v-slot="{ errors }" rules="required|between:8,20" vid="password" slim>
                          <label for="password">パスワード <span class="red-required">必須</span></label>
                          <input type="password" class="form-control" name="password" id="password" v-model="user.password" v-on:input="formError.password = ''" />
                          <small class="form-text text-error" v-if="formError.password && !errors.length">{{ formError.password[0] }}</small>
                          <small class="form-text text-error" v-else-if="errors[0]">{{ errors[0] }}</small>
                        </ValidationProvider>
                      </div>
                      <!-- End Form group -->

                      <!-- Form group -->
                      <div class="form-group col-md-6 mb-5">
                        <ValidationProvider mode="eager" name="パスワード（確認用）" v-slot="{ errors }" rules="required|password_confirmed:password" slim>
                          <label for="confirm_confirmation">パスワード(確認用) <span class="red-required">必須</span></label>
                          <input
                            type="password" class="form-control" name="password_confirmation" id="confirm_confirmation"
                            v-model="user.password_confirmation" v-on:input="formError.confirm_password = ''"/>
                          <small class="form-text text-error" v-if="formError.password_confirmation && !errors.length">{{ formError.password_confirmation[0] }}</small>
                          <small class="form-text text-error" v-else-if="errors[0]">{{ errors[0] }}</small>
                        </ValidationProvider>
                      </div>
                      <!-- End Form group -->

                      <!-- Form group -->
                      <div class="form-group col-md-6 mb-5">
                        <ValidationProvider mode="eager" name="性別" v-slot="{ errors }" rules="must_selected" slim>
                          <label>性別 <span class="red-required">必須</span></label>
                          <div class="radio-lst">
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="gender" id="male" v-model="user.gender" value="1" />
                              <label class="form-check-label" for="male">男性</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="gender" id="female" v-model="user.gender" value="2" />
                              <label class="form-check-label" for="female">女性</label>
                            </div>
                          </div>
                          <small class="form-text text-error" v-if="formError.gender && !errors.length">{{ formError.gender[0] }}</small>
                          <small class="form-text text-error" v-else-if="errors[0]">{{ errors[0] }}</small>
                        </ValidationProvider>
                      </div>
                      <!-- End Form group -->

                      <!-- Form group -->
                      <div class="form-group col-md-6 mb-5">
                        <ValidationProvider mode="eager" ref="birthday-validation" name="生年月日" v-slot="{ errors }" rules="must_selected|date_format|date" slim>
                          <label for="birthday">生年月日 <span class="red-required">必須</span></label>
                          <div class="input-group date" data-target-input="nearest">
                            <date-picker v-model="user.birthday" name="birthday" :config="datepickerConfig" ref="date-picker" @dp-change="validateBirthday"></date-picker>
                            <div class="input-group-append" v-on:click="$refs['date-picker'].dp.show()" style="cursor:pointer">
                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                          </div>
                          <small class="form-text text-error" v-if="formError.birthday && !errors.length">{{ formError.birthday[0] }}</small>
                          <small class="form-text text-error" v-else-if="errors[0]">{{ errors[0] }}</small>
                        </ValidationProvider>
                      </div>
                      <!-- End Form group -->

                      <!-- Form group -->
                      <div class="form-group col-md-6 mb-5">
                        <ValidationProvider mode="eager" name="電話番号" v-slot="{ errors }" rules="required|range_length:20|phone_number" slim>
                          <label for="phone_num">電話番号 <span class="red-required">必須</span></label>
                          <input type="text" class="form-control" name="phone_number" id="phone_num" v-model="user.phone_number" />
                          <small class="form-text text-error" v-if="formError.phone_number && !errors.length">{{ formError.phone_number[0] }}</small>
                          <small class="form-text text-error" v-else-if="errors[0]">{{ errors[0] }}</small>
                        </ValidationProvider>
                      </div>
                      <!-- End Form group -->

                      <!-- Form group -->
                      <div class="form-group col-md-6 mb-5 select-border">
                        <ValidationProvider mode="eager" name="都道府県" v-slot="{ errors }" rules="must_selected" slim>
                          <label for="sector">都道府県 <span class="red-required">必須</span></label>
                          <select2 class="form-control basic-select" name="prefecture_id" v-model="user.prefecture">
                            <option value="" selected disabled></option>
                            <option v-for="(prefecture, key) in metaData.prefectures" v-bind:value="key" v-bind:key="key">{{ prefecture.name }}</option>
                          </select2>
                          <small class="form-text text-error" v-if="formError.prefectures && !errors.length">{{ formError.prefectures[0] }}</small>
                          <small class="form-text text-error" v-else-if="errors[0]">{{ errors[0] }}</small>
                        </ValidationProvider>
                      </div>
                      <!-- End Form group -->

                      <!-- Form group -->
                      <div class="form-group col-md-12">
                        <label for="school">最終学歴（学校名）</label>
                        <input type="text" class="form-control" name="graduated_school" id="school"/>
                      </div>
                      <!-- End Form group -->
                    </div>
                    <!-- End Form Block -->

                    <ValidationProvider mode="eager" name="スキル" v-slot="{ errors }" rules="required|max:3" tag="div" slim>
                      <div class="form-row mb-5 frm-block">
                        <p class="frm-txt">経験の多い、または 自信のある【職種・スキル】を最大３つまで選んでください。<span class="red-required">必須</span></p>
                        <small class="form-text text-error frm-text-error" v-if="errors[0]">{{ (errors[0] == trans.get("messages.M101").replace(':attribute', 'スキル')) ? '職種・スキルの選択は３つ以内にしてください。' : errors[0] }}</small>
                        <!-- Form group -->
                        <div v-for="item in metaData.skills" class="form-group col-md-4">
                          <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" :value="item.id" v-model="selectedSkills" :checked="item.is_user_option" :id="'skill-' + item.id" />
                            <label class="custom-control-label" :for="'skill-' + item.id">{{ item.name }}</label>
                          </div>
                        </div>
                        <!-- End Form group -->
                      </div>
                    </ValidationProvider>

                    <ValidationProvider mode="eager" name="希望職種" v-slot="{ errors }" rules="required" tag="div" slim>
                    <div class="form-row mb-5 frm-block form-web">
                      <p class="frm-txt">希望職種<span class="red-required">必須</span></p>
                      <small class="form-text text-error frm-text-error" v-if="errors[0]">{{ errors[0] }}</small>
                      <!-- Form group -->
                      <div v-for="(item, key) in metaData.desired_occupations" class="form-group col-md-4">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" class="custom-control-input" :id="'job-' + item.id" :value="item.id" :checked="item.is_user_option" v-model="selectedDesiredOccupations" />
                          <label class="custom-control-label" :for="'job-' + item.id">{{ item.name }}</label>
                        </div>
                      </div>
                      <!-- End Form group -->
                    </div>
                    </ValidationProvider>
                    <!-- End Form Block -->

                    <!-- Form Block -->
                    <ValidationProvider mode="eager" name="希望の働き方" v-slot="{ errors }" rules="required" tag="div" slim>
                    <div class="form-row mb-5 frm-block form-web">
                      <p class="frm-txt">希望の働き方<span class="red-required">必須</span></p>
                      <small class="form-text text-error frm-text-error" v-if="errors[0]">{{ errors[0] }}</small>
                      <div v-for="(item, key) in metaData.desired_working_styles" class="form-group col-md-4">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" :value="item.id" class="custom-control-input" :checked="item.is_user_option" :id="'style-' + item.id" v-model="selectedDesiredWorkingStyles" />
                          <label class="custom-control-label" :for="'style-' + item.id">{{ item.name }}</label>
                        </div>
                      </div>
                    </div>
                    </ValidationProvider>
                    <!-- End Form Block -->

                    <!-- Form Block -->
                  <ValidationProvider mode="eager" name="希望勤務地" v-slot="{ errors }" rules="required" tag="div" slim>
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
                      <div v-for="(item, key) in area.prefectures" class="form-group col-md-4">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" :value="item.id" class="custom-control-input" :id="'pos-' + item.id" v-model="selectedPrefectures" />
                          <label class="custom-control-label" :for="'pos-' + item.id">{{ item.name }}</label>
                        </div>
                      </div>
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

                    <div class="form-row">
                      <div class="col-md-12">
                        <p class="mt-1">※ <a href="/handling-of-personal-information" target="_blank" title="個人情報取り扱い">個人情報取り扱い</a>、<a href="/terms-of-service" target="_blank">利用規約</a>について同意の上、送信内容を確認してください。</p>
                      </div>
                      <div class="col-md-6">
                        <button type="button" @click="handleSubmit" class="btn yellow-btn btn-block mb-3">
                          以上の内容で登録する
                        </button>
                      </div>
                      <div class="col-md-6 text-md-right mt-2 text-center">
                        <p>
                          既に会員の方は
                          <a href="/login" class="" title="Sign in here">こちら</a>
                        </p>
                      </div>
                    </div>
                  </ValidationObserver>
                </form>
                <!-- End Form -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
<script>
import { mapGetters, mapActions } from "vuex";
import select2 from "./../Select2";
import moment from "moment";
export default {
  data() {
    const dateFormat = "YYYY/MM/DD";
    return {
      render: [],
      user: {},
      skills: {},
      datepickerConfig: {
        format: dateFormat,
        useCurrent: false,
        locale: "ja"
      },
      formError: {},
      metaData: [],
      workFromHome: null,
      selectedSkills: [],
      selectedPrefectures: [],
      selectedDesiredOccupations: [],
      selectedDesiredWorkingStyles: [],
      loadingUrl: '',
    };
  },
  computed: {
    ...mapGetters(["errors"])
  },
  created() {
    this.$_loadingIcon('show');
    this.$store.commit("setTemplates", { breadcrumb: false });
    this.masterData();
    this.$_loadingIcon('hide');
    this.setupAxios();
  },
  mounted() {
    this.$store.commit("setErrors", {});
  },
  methods: {
    ...mapActions("user", ["sendRegisterRequest", "getMasterData"]),
    async handleSubmit() {
      const valid = await this.$refs["validation-observer"].validate();
      if (valid) {
        return this.registerUser();
      }
      this.scrollToError();
    },
    scrollToError() {
      const firstError = $("small.form-text.text-error").first().closest('div');
      this.$_scrollTo(firstError);
    },
    async registerUser() {
      this.$_loadingIcon('show');
      const formData = new FormData(this.$refs["user-register-form"]);
      let data = {};
      for (var entrie of formData.entries()) {
        data[entrie[0]] = entrie[1];
      }
      data.options = this.selectedSkills.concat(this.selectedDesiredOccupations).concat(this.selectedDesiredWorkingStyles);
      data.workExperiences = this.workExperiences;
      let separateWorkAtHome = this.separateWorkAtHome(this.selectedPrefectures);
      data.preferredWorkplaces = separateWorkAtHome.cities;
      data.work_at_home = separateWorkAtHome.work_at_home;
      data.deleteWorkExperiences = this.deleteWorkExperiences;
      this.sendRegisterRequest(data).then(
        () => {
          this.$router.push({ name: "user.register.success" });
          this.$_loadingIcon('hide');
        },
        error => {
          this.$_loadingIcon('hide');
          this.formError = error.response.data.errors;
          this.scrollToError();
        }
      );
    },
    async masterData() {
      await this.getMasterData().then(res => {
        this.metaData = res.data;
      });
    },
    async validateBirthday() {
      await this.$refs["birthday-validation"].validate();
    },
    loadCities(areaId) {
      if (this.metaData.areas[areaId].cities) {
        if(this.render.indexOf(areaId) < 0) {
          this.render.push(areaId);
        }
        return ;
      }
      axios.get("area/" + areaId).then(res => {
        this.metaData.areas[areaId].cities = res.data;
        if(this.render.indexOf(areaId) < 0) {
          this.render.push(areaId);
        }
      });
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
      if(key >= 0) {
        for(let i in selectedPrefectures) {
          if(i == key) break;
          cities.push(selectedPrefectures[i]);
        }
      }
      return {
        cities: cities,
        work_at_home: workAtHome
      };
    }
  },
  components: {
    select2
  }
};
</script>
