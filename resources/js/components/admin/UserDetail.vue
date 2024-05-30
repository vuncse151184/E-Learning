<template>
    <div class="row">
      <div class="col-md-12">
        <div class="tab_btn">
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a v-on:click="clearAlert();switchMode(false)" :class="('view' == mode) ? 'active' : ''" class="nav-link" id="checking-tab" data-toggle="tab" href="#checking" role="tab" aria-controls="checking" :aria-selected="('view' == mode) ? 'true' : 'false'">閲覧</a>
            </li>
            <li class="nav-item">
              <a v-on:click="clearAlert();switchMode(true)" :class="('edit' == mode) ? 'active' : ''" class="nav-link" id="edit-tab" data-toggle="tab" href="#checking" role="tab" aria-controls="edit" :aria-selected="('edit' == mode) ? 'true' : 'false'">編集</a>
            </li>
            <li class="nav-item">
              <a @click="clearAlert();getApplicationHistory()" class="nav-link" id="history-tab" data-toggle="tab" href="#history" role="tab" aria-controls="history" aria-selected="false">応募履歴</a>
            </li>
            <li class="nav-item">
              <a @click="clearAlert" class="nav-link" id="note-tab" data-toggle="tab" href="#note" role="tab" aria-controls="note" aria-selected="false">メモ</a>
            </li>
          </ul>
        </div>
        <!-- Tab Content -->
        <div class="bg_container tab-content mb-5">
          <!-- Tab 01: Checking Tab -->
          <div class="tab-pane active" id="checking" role="tabpanel" aria-labelledby="checking-tab">
            <v-alert v-if="page_alert" ref="page-alert" :type="page_alert.type" :messages="page_alert.message" autoscroll dismissible autofade :delay="500000"></v-alert>
            <form class="user-data-frm" role="form">
              <!-- Form status-->
              <div v-if="!enableEdit" class="row form_status">
                <!-- col 04 -->
                <div class="col-6 col-sm-6 col-md-4">
                  <div class="form-group">
                    <div class="form-group">
                      <label for="status_select">ステータス</label>
                      <p class="frm-show-data">{{ getRegisterStatus(user.finish_register) }}</p>
                    </div>
                  </div>
                </div>
                <!-- End col 04 -->
              </div>

              <div v-if="enableEdit" class="row form_status">
                <ValidationObserver ref="observer" slim>
                  <!-- col 04 -->
                  <div class="col-12 col-sm-12 col-md-4">
                    <ValidationProvider mode="eager" name="求人情報を掲載" v-slot="{ errors }" rules="must_selected" slim>
                      <div class="form-group custom-select2">           
                        <select2 class="form-control basic-select select2" style="width: 100%;" name="finish_register" v-model="user.finish_register">
                          <option value="" v-bind:selected="!user.finish_register" disabled></option>
                          <option v-for="(item, key) in register_status" v-bind:value="item.id" v-bind:key="key">{{ item.name }}</option>
                        </select2>
                        <small class="form-text text-danger" v-if="errors[0]">{{ errors[0] }}</small>
                      </div>
                    </ValidationProvider>
                  </div>
                  <!-- End col 04 -->
                </ValidationObserver>
                <!-- col 07 -->
                <div class="col-12 col-sm-12 col-md-8 text-right">
                  <div class="form-group">
                    <button class="btn blue-btn" type="button" data-toggle="modal" data-target="#exampleModalCenter" @click="beforeChange">編集を保存</button>
                    <button class="btn trans-btn" type="button" data-toggle="modal" data-target="#exampleModalCenter" @click="resetForm">リセット</button>
                  </div>
                </div>
                <!-- End col 07 -->
              </div>
              <!-- End Form status-->

              <!-- General Form -->
              <div class="card">
                <div class="card-body">
                  <!-- Row -->
                  <div class="row">
                    <!-- Col 06 -->
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="id">ID</label>
                        <p class="frm-show-data">{{ user.id }}</p>
                      </div>
                    </div>
                    <!-- End Col 06 -->
                    <!-- Col 06 -->
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="created_date">作成日</label>
                        <p class="frm-show-data">{{ moment(user.created_at).format(dateFormat) }}</p>
                      </div>
                    </div>
                    <!-- End Col 06 -->
                  </div>
                  <!-- End Row -->

                  <!-- Row -->
                  <div class="row">
                    <!-- Col 06 -->
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="fullname">氏名</label>
                        <p class="frm-show-data">{{ user.name }}</p>
                      </div>
                    </div>
                    <!-- End Col 06 -->

                    <!-- Col 06 -->
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="furigana">ふりがな</label>
                        <p class="frm-show-data">{{ user.furigana }}</p>
                      </div>
                    </div>
                    <!-- End Col 06 -->
                  </div>
                  <!-- End Row -->

                  <!-- Row -->
                  <div class="row">
                    <!-- Col 06 -->
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="email">メールアドレス</label>
                        <p class="frm-show-data">{{ user.email }}</p>
                      </div>
                    </div>
                    <!-- End Col 06 -->

                    <!-- Col 06 -->
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="phone">電話番号</label>
                        <p class="frm-show-data">{{ user.phone_number }}</p>
                      </div>
                    </div>
                    <!-- End Col 06 -->
                  </div>
                  <!-- End Row -->

                  <!-- Row -->
                  <div class="row">
                    <!-- Col 06 -->
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="gender">性別</label>
                        <div class="form-group form-inline">
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" :checked="user.gender == 1" v-model="user.gender" value="1" type="radio" id="male" name="gender" :disabled="disabled">
                            <label for="male" class="custom-control-label">男性</label>
                          </div>
                          <div class="custom-control custom-radio ml-3">
                            <input class="custom-control-input" :checked="user.gender == 2" v-model="user.gender" value="2" type="radio" id="female" name="gender" :disabled="disabled">
                            <label for="female" class="custom-control-label">女性</label>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End Col 06 -->

                    <!-- Col 06 -->
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="birthday">生年月日</label>
                        <p class="frm-show-data">{{ user.birthday ? moment(user.birthday).format(dateFormat) : '' }}</p>
                      </div>
                    </div>
                    <!-- End Col 06 -->
                  </div>
                  <!-- End Row -->

                  <!-- Row -->
                  <div class="row">
                    <!-- Col 06 -->
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="">都道府県</label>
                        <p class="frm-show-data">{{ user.prefecture_id ? metaData.prefectures[user.prefecture_id].name : '' }}</p>
                      </div>
                    </div>
                    <!-- End Col 06 -->

                    <!-- Col 06 -->
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="school">最終学歴（学校名）</label>
                        <p class="frm-show-data">{{ user.graduated_school }}</p>
                      </div>
                    </div>
                    <!-- End Col 06 -->
                  </div>
                  <!-- End Row -->
                </div>
                <!-- /.card-body -->
              </div>
              <!-- End General Form -->

              <!-- Skill Form -->
              <div class="card">
                <div class="card-body">
                  <h6>経験の多い、または 自信のある【職種・スキル】を最大３つまで選んでください。</h6>
                  <!-- Row -->
                  <div class="row">
                    <!-- Col 04 -->
                    <div class="col-sm-4" v-for="(item, key) in metaData.skills" v-bind:key="key">
                      <div class="form-group">
                        <div class="custom-control custom-checkbox">
                          <input class="custom-control-input" type="checkbox" :value="item.id"
                            :checked="item.is_user_option" :id="'skill-' + (item.id)" :disabled="disabled">
                          <label :for="'skill-' + (item.id)" class="custom-control-label">{{ item.name }}</label>
                        </div>
                      </div>
                    </div>
                    <!-- End Col 04 -->
                  </div>
                  <!-- End Row -->
                </div>
                <!-- /.card-body -->
              </div>
              <!-- End Skill Form -->

              <!-- Job Form -->
              <div class="card">
                <div class="card-body">
                  <h6>希望職種</h6>
                  <!-- Row -->
                  <div class="row">
                    <!-- Col 04 -->
                    <div class="col-sm-4" v-for="(item, key) in metaData.desired_occupations" v-bind:key="key">
                      <div class="form-group">
                        <div class="custom-control custom-checkbox">
                          <input class="custom-control-input" type="checkbox" name="job" :id="'job-'+(item.id)" :value="item.id" :checked="item.is_user_option" :disabled="disabled">
                          <label :for="'job-'+(item.id)" class="custom-control-label">{{ item.name }}</label>
                        </div>
                      </div>
                    </div>
                    <!-- End Col 04 -->
                  </div>
                  <!-- End Row -->
                </div>
                <!-- /.card-body -->
              </div>
              <!-- End Job Form -->

              <!-- Style Form -->
              <div class="card">
                <div class="card-body">
                  <h6>希望の働き方</h6>
                  <!-- Row -->
                  <div class="row">
                    <!-- Col 06 -->
                    <div class="col-sm-4" v-for="(item, key) in metaData.desired_working_styles" v-bind:key="key">
                      <div class="form-group">
                        <div class="custom-control custom-checkbox">
                          <input class="custom-control-input" :value="item.id" type="checkbox" name="style"
                            :checked="item.is_user_option" :id="'style-'+(item.id)" :disabled="disabled">
                          <label :for="'style-'+(item.id)" class="custom-control-label">{{ item.name }}</label>
                        </div>
                      </div>
                    </div>
                    <!-- End Col 06 -->
                  </div>
                  <!-- End Row -->
                </div>
                <!-- /.card-body -->
              </div>
              <!-- End Style Form -->

              <!-- Pos Form -->
              <div class="card">
                <div class="card-body">
                  <h6>希望勤務地</h6>

                  <!-- Accordion Block -->
                  <p v-if="metaData.length == 0" class="text-center">読み込み中...</p>
                  <div class="accordion user-accordion" id="accordion">
                    <!-- Accordion Item -->
                    <template v-for="(area, areaId) in metaData.areas">
                      <div v-bind:key="areaId">
                        <!-- Accordion Title -->
                        <div class="accordion-title">
                          <h6>{{ area.name }}</h6>
                        </div>
                        <!-- End Accordion Title -->

                        <p v-if="render.indexOf(areaId) < 0 && !area.prefectures" class="text-center">読み込み中...</p>

                        <!-- Accordion Cont -->
                        <div class="form-row collapse show">
                          <template v-for="(prefecture, key) in area.prefectures">
                            <!-- Form group -->
                            <div class="form-group col-md-4" v-bind:key="key">
                              <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" :id="'pos-'+ (areaId +1 ) +'-'+ (key +1 )" name="pos" v-bind:value="prefecture.id" v-model="selectedPrefectures" :disabled="disabled">
                                <label class="custom-control-label" :for="'pos-'+ (areaId +1 ) +'-'+ (key +1 )">{{ prefecture.name }}</label>
                              </div>
                            </div>
                            <!-- End Form group -->
                          </template>
                        </div>
                        <!-- End Accordion Cont -->
                      </div>
                    </template>
                    <!-- End Accordion Item -->
                  </div>
                  <!-- End Accordion Block -->
                </div>
                <!-- /.card-body -->
              </div>
              <!-- End Pos Form -->

              <!-- Consolation Form -->
              <div class="card">
                <div class="card-body">
                  <h6>ご質問や条件面などのご相談</h6>
                  <div class="form-group">
                    <p class="frm-show-data">{{ user.questions }}</p>
                  </div>
                </div>
              </div>
              <!-- End Consolation Form -->

              <!-- Upload file -->
              <div class="card">
                <div class="card-body">
                  <div class="input-group upfile_custom">
                    <div class="col-md-6">
                      <div class="custom-file">
                        <a :href="user.resume_src" class="custom-file-icon" target="_blank" dowload>
                          <span class="custom-file-title">履歴書</span>
                          <span class="custom-file-name"><i class="far fa-file-pdf"></i> {{ user.resume }}</span>
                          <span class="custom-file-last"><i class="fas fa-download"></i></span>
                        </a>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="custom-file">
                        <a :href="user.curriculum_vitae_src" target="_blank" class="custom-file-icon" dowload>
                          <span class="custom-file-title">職務経歴書</span>
                          <span class="custom-file-name"><i class="far fa-file-word"></i> {{ user.curriculum_vitae }}</span>
                          <span class="custom-file-last"><i class="fas fa-download"></i></span>
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- End Upload file -->
            </form>
          </div>

          <!-- Tab 02: Edit Tab -->
          <!-- <div :class="('edit' == mode) ? 'active' : ''" class="tab-pane" id="edit" role="tabpanel" aria-labelledby="edit-tab"></div> -->
          <!-- End Tab 02: Edit Tab -->

          <!-- Tab 03: History Tab -->
          <div class="tab-pane" id="history" role="tabpanel" aria-labelledby="history-tab">
            <v-alert v-if="page_alert" ref="page-alert-application-stt-update" :type="page_alert.type" :messages="page_alert.message" autoscroll dismissible autofade :delay="500000"></v-alert>
            <div class="card">              
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                <div class="form-group">
                  <h6>応募履歴：<b>{{ user.name }}</b></h6>
                </div>                
                <table class="table table-hover text-nowrap job-seeker-tbl">
                  <thead>
                    <tr>
                      <th>応募日 <a href="javascript:void(0)" class="sort-data-icon" title="sort" @click="sortList"><i class="fa fa-sort"></i></a></th>
                      <th>選考企業名</th>
                      <th>求人案件名</th>
                      <th>進歩</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(item, index) in application_history.data" :key="index">
                      <td>{{ moment(item.created_at).format(dateFormat) }}</td>
                      <td>
                        <a href="javascript:void(0)" :title="item.company_name" @click="goDetail('admin.company.detail', item.company_id)">{{ item.company_name }}</a>
                      </td>
                      <td>
                        <a href="javascript:void(0)" :title="limitStr(item.job_title)" @click="goDetail('admin.job.view', item.job_id)">{{ limitStr(item.job_title) }}</a>
                      </td>
                      <td class="status-select">
                        <select2 class="form-control basic-select select2" style="width: 100%;" name="status" v-model="item.status" @change="showDialogConfirmApplicationStatus(index, item.status)">
                          <!-- <option value="" v-bind:selected="!item.status" disabled></option> -->
                          <option v-for="(detail, key) in application_status" v-bind:value="key" v-bind:key="key">{{ detail }}</option>
                        </select2>
                        <input type="hidden" :ref="'status_app_' + index" v-model="item.status">
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>

            <div class="card-footer" v-if="application_history.total > application_history.per_page">
              <!-- Pagination -->
              <div class="pagination-block">
                <v-pagination ul-class="pagination" v-model="application_history.current_page" :page-count="application_history.last_page" @change="pageChangeHandler"></v-pagination>
              </div>
              <!-- End Pagination -->
            </div>
          </div>
          <!-- End Tab 03: History Tab -->

          <!-- Tab 04: Note Tab -->
          <div class="tab-pane" id="note" role="tabpanel" aria-labelledby="note-tab">
            <v-alert v-if="page_alert" ref="page-alert-memo-update" :type="page_alert.type" :messages="page_alert.message" dismissible autofade :delay="500000"></v-alert>
            <!-- Form -->
            <form class="user-data-frm" role="form">
              <!-- Card Content -->
              <div class="card">
                <div class="card-body">
                  <div class="form-group">
                    <textarea v-model="user.admin_memo" class="form-control" name="admin_memo" id="noteform" rows="5" placeholder="メモを入力してください。"></textarea>
                  </div>
                </div>
              </div>
              <!-- End Card Content -->

              <!-- Button -->
              <div class="text-right">
                <button class="btn blue-btn mr-2" type="button" @click="showDialogConfirmMemo">編集を保存</button>
                <button class="btn trans-btn" type="button" @click="resetMemoForm">リセット</button>
              </div>
              <!-- End Button -->
            </form>
            <!-- End Form -->
          </div>
          <!-- End Tab 04: Note Tab -->
        </div>
      </div>
    </div>
</template>
<script>
import { mapGetters, mapActions } from "vuex";
import select2 from "../Select2";
import moment from 'moment';
import vAlert from '../Alert';
import vPagination from "../Pagination_admin";
export default {
  data() {
    const dateFormat = 'YYYY/MM/DD';
    return {
      user: {},
      loading: false,
      metaData: {},
      render: [],
      dateFormat: dateFormat,
      mode: '',
      disabled: true,
      selectedPrefectures: [],
      enableEdit: false,
      register_status: [
        {id: 1, name: 'アクティブ'},
        {id: 0, name: '未確定'},
        {id: 2, name: '禁止'},
      ],
      page_alert: null,
      current_memo_admin: '',
      application_history: [],
      application_status: [],
      sortClickCount: 0,
    };
  },
  computed: {
    ...mapGetters(["errors", "settings"]),
    ...mapGetters("admin", ["isLogin", "adminData"])
  },
  methods: {
    async init() {
      this.mode = this.$route.query.mode ? this.$route.query.mode : 'view';
      if ('edit' == this.mode) {
        this.enableEdit = true;
      } else {
        this.enableEdit = false;
      }
      await axios.get(this.$router.currentRoute.fullPath)
      .then(
        res => {
          this.user = res.data.user_data;
          this.metaData = res.data.master_data;
          this.current_memo_admin = this.user.admin_memo;

          for (let i in this.metaData.preferred_workplaces) {
            for (let j in this.metaData.preferred_workplaces[i]) {
              this.selectedPrefectures.push(this.metaData.preferred_workplaces[i][j]);
            }
          }
        },
        error => {
          this.user = {};
        }
      )
      .then(
        () => {
          this.loading = false;
        }
      )
    },
    moment: function (date) {
      return moment(date);
    },
    getRegisterStatus(value) {
      switch (value) {
        case 0:
          return '未確定';
          break;
        case 1:
          return 'アクティブ';
          break;
        case 2:
          return '禁止';
          break;
        default:
          return '';
      }
    },
    switchMode(value) {
      this.enableEdit = value;
    },
    async beforeChange() {
      let _self = this;
      const valid = await _self.$refs.observer.validate();
      if (valid) {
        _self.showDialogConfirm();
      }
    },
    showDialogConfirm() {
      const params = {
        title: "確認",
        text: "更新しますか？",
        onConfirm: () => {
          return this.changeUserInfo();
        },
        onHide: () => {
          $('button[class=close]').trigger('click');
        },
      };
      this.$modal.dialogConfirm(params);
    },
    changeUserInfo() {
      let _self = this;
      _self.page_alert = null;
     
      let data = { finish_register: parseInt(_self.user.finish_register) };
      axios.post("administrator/user/update/" + _self.$route.params.id, data).then(
        response => {
          if ('success' === response.data.status) {
            _self.page_alert = {
              type: 'success',
              message: _self.trans.get("messages.M120")
            };
          }
          if ('error' === response.data.status) {
            _self.page_alert = {
              type: 'danger',
              message: res.data.messages
            };
          }
        },
        error => {
          _self.page_alert = {
            type: "danger",
            message: _self.errors
          };
        }
      );
    },
    resetForm() {
      this.init();
      this.enableEdit = true;
    },
    showDialogConfirmMemo() {
      const params = {
        title: "確認",
        text: "更新しますか？",
        onConfirm: () => {
          return this.changeMemoAdmin();
        }
      };
      this.$modal.dialogConfirm(params);
    },
    changeMemoAdmin() {
      let _self = this;
      _self.page_alert = null;
      
      let data = { admin_memo: _self.user.admin_memo };
      axios.post("administrator/user/update/" + _self.$route.params.id, data).then(
        response => {
          if ('success' === response.data.status) {
            _self.user.admin_memo = response.data.payload.admin_memo;
            _self.current_memo_admin = _self.user.admin_memo;
            _self.page_alert = {
              type: 'success',
              message: _self.trans.get("messages.M120")
            };
          }
          if ('error' === response.data.status) {
            _self.page_alert = {
              type: 'danger',
              message: res.data.messages
            };
          }
        },
        error => {
          _self.page_alert = {
            type: "danger",
            message: _self.errors
          };
        }
      );
    },
    clearAlert() {
      this.page_alert = null;
    },
    resetMemoForm() {
      this.user.admin_memo = this.current_memo_admin;
    },
    getApplicationHistory() {
      let _self = this;
      let page = _self.application_history.current_page ? _self.application_history.current_page: 1;
      _self.page_alert = null;

      let sort = 'asc';
      if (this.sortClickCount % 2 != 0) {
        sort = 'desc';
      }

      let queryStr = (_self.$route.query.mode) ? '?mode=' + _self.$route.query.mode + '&sort=' + sort + '&page=' + page : '?page=' + page+ '&sort=' + sort;

      axios.get("administrator/user/application-history-list/" + _self.$route.params.id + queryStr).then(
        response => {
          _self.application_history = response.data.application_history;
          _self.application_status = _self.settings.application_status;
        },
        error => {
          _self.page_alert = {
            type: "danger",
            message: _self.errors
          };
        }
      );
    },
    goDetail(routeName, id) {
      this.$router.push({ name: routeName, params: { id: id } });
    },
    pageChangeHandler() {
      if (this.loading) {
        return;
      }
      this.application_history.data = [];
      this.getApplicationHistory();
    },
    sortList() {
      this.sortClickCount++;
      this.getApplicationHistory();
    },
    changeApplicationStatus(index, value) {
      let _self = this;
      _self.page_alert = null;
      
      let data = {
        id: _self.application_history.data[index].id,
        status: $(this.$refs['status_app_' + index]).val()
      };
      axios.post("administrator/user/application-history-list/update", data).then(
        response => {
          if ('success' === response.data.status) {
            _self.application_history.data[index].status = response.data.payload.status;
            _self.page_alert = {
              type: 'success',
              message: _self.trans.get("messages.M120")
            };
          }
          if ('error' === response.data.status) {
            _self.page_alert = {
              type: 'danger',
              message: res.data.messages
            };
          }
        },
        error => {
          _self.page_alert = {
            type: "danger",
            message: _self.errors
          };
        }
      );
    },
    showDialogConfirmApplicationStatus(index, value) {
      const params = {
        title: "確認",
        text: "更新しますか？",
        onConfirm: () => {
          return this.changeApplicationStatus(index, value);
        }
      };
      this.$modal.dialogConfirm(params);
    },
    limitStr(str) {
      if (typeof str != 'undefined' && str !== '' && str != null) {
        return str.substring(0, 40);
      }
    },
  },
  created() {
    this.init();
  },
  mounted() {
    this.$store.commit("setErrors", {});
    // $('.datetimepicker-group').datetimepicker({
    //   format: 'L',
    //   locale: default_locale
    // });
  },
  components: {
    select2,
    vAlert,
    vPagination,
  }
};
</script>
