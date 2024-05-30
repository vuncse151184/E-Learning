<template>
  <section class="job-lst-cont">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="user-dashboard-info-box mb-0">
            <form>
              <!-- <div class="form-row">
                <div class="form-group col-md-6">
                  <label>ID</label>
                  <p class="frm-show-data">{{ user.id }}</p>
                </div>
              </div> -->

              <!-- Form Row -->
              <div class="form-row">
                <!-- Form group -->
                <div class="form-group col-md-6">
                  <label>氏名</label>
                  <p class="frm-show-data">{{ user.name }}</p>
                </div>
                <!-- End Form group -->

                <!-- Form group -->
                <div class="form-group col-md-6">
                  <label>ふりがな</label>
                  <p class="frm-show-data">{{ user.furigana }}</p>
                </div>
                <!-- End Form group -->
              </div>
              <!-- End Form Row -->

              <!-- Form Row -->
              <div class="form-row">
                <!-- Form group -->
                <div class="form-group col-md-6">
                  <label>メールアドレス</label>
                  <p class="frm-show-data">{{ user.email }}</p>
                </div>
                <!-- End Form group -->

                <!-- Form group -->
                <div class="form-group col-md-6">
                  <label>電話番号</label>
                  <p class="frm-show-data">{{ user.phone_number }}</p>
                </div>
                <!-- End Form group -->
              </div>
              <!-- End Form Row -->

              <!-- Form Row -->
              <div class="form-row">
                <!-- Form group -->
                <div class="form-group col-md-6">
                  <label class="d-block mb-3">性別</label>
                  <div class="custom-control custom-radio d-inline">
                    <input type="radio" id="male" name="customRadio" class="custom-control-input" v-bind:value="1" v-model="user.gender" :checked="{ checked: user.gender == 1 }" disabled />
                    <label class="custom-control-label" for="male">男性</label>
                  </div>
                  <div class="custom-control custom-radio d-inline ml-3">
                    <input type="radio" id="female" name="customRadio" class="custom-control-input" v-bind:value="2" v-model="user.gender" :checked="{ checked: user.gender == 2 }" disabled />
                    <label class="custom-control-label" for="female">女性</label>
                  </div>
                </div>
                <!-- End Form group -->

                <!-- Form group -->
                <div class="form-group col-md-6">
                  <label for="birthday">生年月日</label>
                  <p class="frm-show-data">{{ user.birthday }}</p>
                </div>
                <!-- End Form group -->
              </div>
              <!-- End Form Row -->

              <!-- Form Row -->
              <div class="form-row">
                <!-- Form group -->
                <div class="form-group col-md-6 mb-5 select-border">
                  <label for="sector">都道府県</label>
                  <p class="frm-show-data">{{ user.prefecture ? user.prefecture.name : "" }}</p>
                </div>
                <!-- End Form group -->

                <!-- Form group -->
                <div class="form-group col-md-6">
                  <label>最終学歴（学校名）</label>
                  <p class="frm-show-data">{{ user.graduated_school }}</p>
                </div>
                <!-- End Form group -->
              </div>
              <!-- End Form Row -->
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
<script>
import { mapGetters, mapActions } from "vuex";
export default {
  data() {
    return {
      user: {
        name: "",
        furigana: "",
        email: "",
        gender: 1,
        phone_number: "",
        prefecture: "",
        graduated_school: "",
        errors: null
      },
      prefectures: {},
      options: {
        format: "YYYY/MM/DD",
        locale: "ja",
        useCurrent: false
      }
    };
  },
  computed: {
    ...mapGetters(["errors"]),
    ...mapGetters("user", ["userData"])
  },
  mounted() {
    this.$store.commit("setErrors", {});
    this.user = this.userData;
  },
  methods: {}
};
</script>
