<template>
  <!-- /.row -->
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <!-- Form -->
          <form class="col-md-12 form-inline job-seeker-frm">
            <!-- Form Group -->
            <div class="form-group row col-md-3 status-input">
              <label for="status" class="col-md-6 col-form-label">ステイタス</label>
              <div class="col-md-6">
                <select2 id="status" class="form-control select2" style="width: 100%;" v-model="status_register">
                  <option v-for="(item, key) in register_status" v-bind:value="item.id" v-bind:key="key">{{ item.name }}</option>
                </select2>
              </div>
            </div>
            <!-- End Form Group -->

            <!-- Form Group -->
            <div class="form-group row col-md-7 date-input">
              <label for="created_date" class="col-md-3 col-form-label">作成日</label>
              <div class="col-md-9 row">
                <div class="input-group date col-md-5 datetimepicker-group" id="created_date_from" data-target-input="nearest" ref="created_date_from">
                  <date-picker v-model="created_date_from" name="created_date_from" :config="datepickerConfig" ref="date-picker-from" :placeholder="today"></date-picker>
                  <div class="input-group-append" data-target="#created_date_from" data-toggle="datetimepicker" v-on:click="$refs['date-picker-from'].dp.show()">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                  </div>
                </div>
                <span class="col-md-1 separate-icon">~</span>
                <div class="input-group date col-md-5 datetimepicker-group" id="created_date_to" data-target-input="nearest" ref="created_date_to">
                  <date-picker v-model="created_date_to" name="created_date_to" :config="datepickerConfig" ref="date-picker-to" :placeholder="today"></date-picker>
                  <div class="input-group-append" data-target="#created_date_to" data-toggle="datetimepicker" v-on:click="$refs['date-picker-to'].dp.show()">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                  </div>
                </div>
              </div>
            </div>
            <!-- End Form Group -->

            <!-- Form Group -->
            <div class="form-group row col-md-2 search-input">
              <div class="col-md-12">
                <div class="input-group" style="width: 100%;">
                  <input @change="getCompanyNameSearch($event)" type="text" name="company_name" class="form-control float-right" placeholder="Search">

                  <div class="input-group-append">
                    <button @click="onSearch" type="button" class="btn btn-default" style="min-width: 50px;"><i class="fas fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <!-- End Form Group -->
          </form>
          <!-- Form -->
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive">
          <table class="table table-hover text-nowrap job-seeker-tbl">
            <thead>
              <tr>
                <th>ID</th>
                <th>会社名</th>
                <th>メールアドレス</th>
                <th>作成日</th>
                <th>ステータス</th>
                <th>HOT</th>
                <th>アクション</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(item, index) in companies.data" :key="index">
                <td>{{ item.id }}</td>
                <td>
                  <a href="javascript:void(0)" :title="item.company_name" @click="gotoDetail(item.id, 'view')">{{ item.company_name }}</a>
                </td>
                <td>{{ item.charge_person_email }}</td>
                <td>{{ moment(item.created_date).format(dateFormat) }}</td>
                <td>
                  <template v-if="item.finish_register != 2">{{ getRegisterStatus(item.finish_register) }}</template>
                  <template v-else>
                    <p class="red-txt m-0">{{ getRegisterStatus(item.finish_register) }} <i class="fa fa-ban"></i></p>
                  </template>
                </td>
                <td>
                  <label class="el_custom_switch">
                    <input v-on:change="showDialogConfirmStatus(item.id, item.hot_flg, index)" type="checkbox" name="switch" v-model="item.hot_flg">
                    <span class="el_switch_style"></span>
                  </label>
                </td>
                <td>
                  <button class="active-btn" @click="gotoDetail(item.id, 'edit')"><i class="fas fa-pencil-alt"></i></button>
                  <button class="active-btn" @click="showDialogConfirm(item.id, item.admin_memo, index)"><i class="fas fa-file-alt"></i></button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->

        <div class="card-footer" v-if="companies.total > companies.per_page">
          <!-- Pagination -->
          <div class="pagination-block">
            <v-pagination ul-class="pagination" v-model="companies.current_page" :page-count="companies.last_page" @change="pageChangeHandler"></v-pagination>
          </div>
          <!-- End Pagination -->
        </div>
      </div>
      <!-- /.card -->
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" ref="edit_memo_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">メモを入力してください</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <v-alert v-if="page_alert" ref="page-alert" :type="page_alert.type" :messages="page_alert.message" dismissible autofade :delay="500000"></v-alert>
            <textarea class="body-cont" v-model="admin_memo"></textarea>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn gray-btn" data-dismiss="modal">キャンセル</button>
            <button type="button" class="btn blue-btn mgr-15" @click="changeMemoAdmin">確認</button>
          </div>
        </div>
      </div>
    </div>
    <!-- End Modal -->
  </div>
  <!-- /.row -->
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import vPagination from "../Pagination_admin";
import select2 from "../Select2";
import moment from 'moment';
import vAlert from '../Alert'
export default {
  data() {
    const dateFormat = 'YYYY/MM/DD';
    return {
      companies: [],
      loading: false,
      dateFormat: dateFormat,
      error: '',
      created_date_from: '',
      created_date_to: '',
      company_name_search: '',
      datepickerConfig:{
        format: dateFormat,
        useCurrent: false,
        locale: 'ja',
      },
      register_status: [
        {id: '', name: 'すべて'},
        {id: 0, name: '未確定'},
        {id: 1, name: 'アクティブ'},
        {id: 2, name: '禁止'},
      ],
      status_register: '',
      today: moment().format(dateFormat),
      search_action: false,
      page_alert: null,
      position: {},
      admin_memo: '',
      hot_stt: 0,
    };
  },
  computed: {
    ...mapGetters(["errors"]),
    ...mapGetters("admin", ["isLogin", "adminData"])
  },
  methods: {
    init() {
      let page = this.companies.current_page ? this.companies.current_page: 1;
      let self = this;
      let searchStr = '';
      if (self.search_action) {
        let searchStr = '&status=' + self.status_register;
        let isExistDateFrom = typeof self.created_date_from != 'undefined' && self.created_date_from !== '' && self.created_date_from != null;
        if (isExistDateFrom) {
          let dateFromFormat = moment(self.created_date_from).format('YYYY-MM-DD');
          searchStr += '&date_from=' + dateFromFormat;
        }
        let isExistDateTo = typeof self.created_date_to != 'undefined' && self.created_date_to !== '' && self.created_date_to != null;
        if (isExistDateTo) {
          let dateToFormat = moment(self.created_date_to).format('YYYY-MM-DD');
          searchStr += '&date_to=' + dateToFormat;
        }
        let companyName = self.company_name_search;
        if (companyName !== '') {
          searchStr += '&company_name=' + companyName;
        }
        page += searchStr;
      }
      axios.get("administrator/company-list?page=" + page)
      .then(
        res => {
          self.companies = res.data.company_info;
        },
        error => {
          self.error = error;
        }
      )
    },
    moment: function (date) {
      return moment(date);
    },
    pageChangeHandler() {
      if (this.loading) {
        return;
      }
      this.companies.data = [];
      this.init();
    },
    onSearch() {
      this.companies = [];
      this.search_action = true;
      let page = this.companies.current_page ? this.companies.current_page: 1;
      let link = "administrator/company-list?page=" + page;
      let searchStr = '&status=' + this.status_register;
      let isExistDateFrom = typeof this.created_date_from != 'undefined' && this.created_date_from !== '' && this.created_date_from != null;
      if (isExistDateFrom) {
        let dateFromFormat = moment(this.created_date_from).format('YYYY-MM-DD');
        searchStr += '&date_from=' + dateFromFormat;
      }
      let isExistDateTo = typeof this.created_date_to != 'undefined' && this.created_date_to !== '' && this.created_date_to != null;
      if (isExistDateTo) {
        let dateToFormat = moment(this.created_date_to).format('YYYY-MM-DD');
        searchStr += '&date_to=' + dateToFormat;
      }
      let companyName = this.company_name_search;
      if (companyName !== '') {
        searchStr += '&company_name=' + companyName;
      }
      let self = this;
      axios.get(link + searchStr)
        .then(
          res => {
            self.companies = res.data.company_info;
          },
          error => {
            self.error = error;
          }
        )
    },
    getCompanyNameSearch(event) {
      this.company_name_search = event.target.value;
    },
    gotoDetail(id, mode) {
      this.$router.push({ name: "admin.company.detail", params: { id: id }, query: { mode: mode } });
    },
    getRegisterStatus(statusId) {
      if (typeof statusId == 'undefined' || '' === statusId || null == statusId) {
        return '未確定';
      }
      for (let i in this.register_status) {
        if (this.register_status[i].id === statusId) {
          return this.register_status[i].name;
        }
      }
    },
    showDialogConfirm(id, adminMemo, index) {
      this.admin_memo = adminMemo;
      this.position.idCorp = id;
      this.position.index = index;
      $(this.$refs.edit_memo_modal).modal('show');
    },
    changeMemoAdmin() {
      let _self = this;
      _self.page_alert = null;
      let data = { admin_memo: _self.admin_memo };
      axios.post("administrator/company/update/" + _self.position.idCorp, data).then(
        response => {
          if ('success' === response.data.status) {
            _self.companies.data[_self.position.index].admin_memo = _self.admin_memo;
            _self.page_alert = {
              type: 'success',
              message: _self.trans.get("messages.M120")
            };
          }
          if ('error' === response.data.status) {
            _self.page_alert = {
              type: 'danger',
              message: response.data.messages
            };
          }
        },
        error => {
          _self.page_alert = {
            type: "danger",
            message: _self.errors
          };
        },
      );
    },
    setHotStt(id, hotFlg, index) {
      let _self = this;
      _self.page_alert = null;
      let data = { hot_flg: hotFlg };
      axios.post("administrator/company/update/" + id, data).then(
        response => {
          if ('success' === response.data.status) {
            _self.companies.data[index].hot_flg = hotFlg;
            // _self.page_alert = {
            //   type: 'success',
            //   message: _self.trans.get("messages.M120")
            // };
          }
          if ('error' === response.data.status) {
            _self.page_alert = {
              type: 'danger',
              message: response.data.messages
            };
          }
        },
        error => {
          _self.page_alert = {
            type: "danger",
            message: _self.errors
          };
        },
      );
    },
    showDialogConfirmStatus(id, hotFlg, index) {
      this.hot_stt = Number(hotFlg);
      let isShow = false;
      const params = {
        title: "確認",
        text: "更新しますか？",
        onConfirm: () => {
          isShow = true;
          return this.setHotStt(id, this.hot_stt, index);
        },
        onHide: () => {
          if (!isShow) {
            this.companies.data[index].hot_flg = !hotFlg;
          }
        },
      };
      this.$modal.dialogConfirmCompany(params);
    },
  },
  created() {
    this.init();
  },
  mounted() {
    this.$store.commit("setErrors", {});
    let self = this;
  },
  components: {
    vPagination,
    select2,
    vAlert
  }
};
</script>
