<template>
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
                <div class="input-group date col-md-5 datetimepicker-group" data-target-input="nearest">
                  <!-- <input type="text" class="form-control datetimepicker-input" data-target="#created_date_from" placeholder="2020/09/09" /> -->
                  <date-picker v-model="created_date_from" name="created_date_from" :config="datepickerConfig" ref="date-picker-from" :placeholder="today"></date-picker>
                  <div class="input-group-append" data-target="#created_date_from" data-toggle="datetimepicker" v-on:click="$refs['date-picker-from'].dp.show()">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                  </div>
                </div>
                <span class="col-md-1 separate-icon">~</span>
                <div class="input-group date col-md-5 datetimepicker-group" data-target-input="nearest">
                  <!-- <input type="text" class="form-control datetimepicker-input" data-target="#created_date_to" placeholder="2020/09/09" /> -->
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
                  <input v-model="name_search" type="text" name="name_search" class="form-control float-right" placeholder="Search" />

                  <div class="input-group-append">
                    <button v-on:click="onSearch" type="button" class="btn btn-default" style="min-width: 50px;"><i class="fas fa-search"></i></button>
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
                <th>氏名</th>
                <th>メールアドレス</th>
                <th>作成日</th>
                <th>ステータス</th>
                <th>アクション</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(user, index) in users.data" :key="index">
                <td>{{ user.id }}</td>
                <td>
                  <a href="javascript:void(0)" v-on:click="goDetail(user.id, 'view')" :title="user.name">{{ user.name }}</a>
                </td>
                <td>{{ user.email }}</td>
                <td>{{ moment(user.created_date).format(dateFormat) }}</td>
                <td>
                  <template v-if="user.deleted_at">
                    <p class="red-txt m-0">NG <i class="fas fa-ban"></i></p>
                  </template>
                  <template v-else>{{ getRegisterStatus(user.finish_register) }}</template>
                </td>
                <td>
                  <button class="active-btn" v-on:click="goDetail(user.id, 'edit')"><i class="fas fa-pencil-alt"></i></button>
                  <button class="active-btn" v-on:click="showDialogConfirm(user.id, user.admin_memo, index)"><i class="fas fa-file-alt"></i></button>

                  <!-- <button class="active-btn" :style="!user.deleted_at ? 'cursor: not-allowed;' : ''"><i class="fas fa-check-circle"></i></button>
                  <button class="active-btn" :style="user.deleted_at ? 'cursor: not-allowed;' : ''"><i class="fas fa-ban"></i></button> -->
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->

        <div class="card-footer" v-if="users.total > users.per_page">
          <!-- Pagination -->
          <div class="pagination-block">
            <v-pagination ul-class="pagination" v-model="users.current_page" :page-count="users.last_page" @change="pageChangeHandler"></v-pagination>
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
            <button type="button" class="btn blue-btn mgr-15" v-on:click="changeMemoAdmin">確認</button>
          </div>
        </div>
      </div>
    </div>
    <!-- End Modal -->
  </div>
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
      users: [],
      loading: false,
      dateFormat: dateFormat,
      admin_memo: '',
      position: {},
      page_alert: null,
      register_status: [
        {id: '', name: 'すべて'},
        {id: 0, name: '未確定'},
        {id: 1, name: 'アクティブ'},
        {id: 2, name: '禁止'},
      ],
      status_register: '',
      datepickerConfig:{
        format: dateFormat,
        useCurrent: false,
        locale: 'ja',
      },
      today: moment().format(dateFormat),
      created_date_from: '',
      created_date_to: '',
      search_action: false,
      name_search: '',
    };
  },
  computed: {
    ...mapGetters(["errors"]),
    ...mapGetters("admin", ["isLogin", "adminData"])
  },
  methods: {
    ...mapActions("admin", ["getUserList", "getUserDetail"]),
    async init() {
      let page = this.users.current_page ? this.users.current_page: 1;
      await this.getUserList(page)
      .then(
        res => {
          this.users = res.data;
        },
        error => {
          console.log(error)
        }
      )
      .then(
        () => {
          this.loading = false;
        }
      )
    },
    pageChangeHandler() {
      if(this.loading) return;
      this.users.data = [];
      if (!this.search_action) {
        this.init();
      } else {
        this.onSearch();
      }
    },
    goDetail(id, mode) {
      this.$router.push({ name: "admin.user.detail", params: { id: id}, query: { mode: mode } });
    },
    moment: function (date) {
      return moment(date);
    },
    showDialogConfirm(id, adminMemo, index) {
      this.admin_memo = adminMemo;
      this.position.userId = id;
      this.position.index = index;
      $(this.$refs.edit_memo_modal).modal('show');
    },
    changeMemoAdmin() {
      let _self = this;
      _self.page_alert = null;
      let data = { admin_memo: _self.admin_memo };
      axios.post("administrator/user/update/" + _self.position.userId, data).then(
        response => {
          if ('success' === response.data.status) {
            _self.users.data[_self.position.index].admin_memo = _self.admin_memo;
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
    onSearch() {
      this.search_action = true;
      let page = this.users.current_page ? this.users.current_page: 1;
      let link = page;
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
      let nameSearch = this.name_search;
      if (nameSearch !== '') {
        searchStr += '&name=' + nameSearch;
      }
      let _self = this;
      _self.getUserList(link + searchStr)
        .then(
          res => {
            _self.users = res.data;
          },
          error => {
            console.log(error);
          }
        )
    },
  },
  created() {
    this.init();
  },
  mounted() {
    this.$store.commit("setErrors", {});
    $('.datetimepicker-group').datetimepicker({
      format: 'L',
      locale: default_locale
    });
  },
  components: {
    vPagination,
    select2,
    vAlert,
  }
};
</script>
