<template>
  <section class="job-lst-cont">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="user-dashboard-info-box mb-0">
            <form>
              <!-- Form Row -->
              <div class="form-row">
                <!-- Form group -->
                <div class="form-group col-md-6">
                  <label for="email">ご担当者メールアドレス</label>
                  <p class="frm-show-data">
                    {{ company.charge_person_email }} <router-link :to="{ name: 'company.account.edit_email' }"><i class="fas fa-edit"></i></router-link>
                  </p>
                </div>
                <!-- End Form group -->

                <!-- Form group -->
                <div class="form-group col-md-6">
                  <label for="password">パスワード</label>
                  <p class="frm-show-data">
                    ******** <router-link :to="{ name: 'company.account.edit_password' }"><i class="fas fa-edit"></i></router-link>
                  </p>
                </div>
                <!-- End Form group -->
              </div>
              <!-- End Form Row -->

              <!-- Form Row -->
              <div class="form-row">
                <!-- Form group -->
                <div class="form-group col-md-6 datetimepickers">
                  <label>加入日</label>
                  <p class="frm-show-data">{{ company.joined_date }}</p>
                </div>
                <!-- End Form group -->

                <!-- Form group -->
                <div class="form-group col-md-6">
                  <label for="status">ステータス</label>
                  <p class="frm-show-data">{{ company.status }}</p>
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
      company: {}
    };
  },
  computed: {
    ...mapGetters(["errors"]),
    ...mapGetters("company", ["isLogin", "companyData"])
  },
  mounted() {
    this.$store.commit("setErrors", {});
    this.$store.commit("setTemplates", { footerFixed: true });
    this.company = this.companyData;
  },
  methods: {}
};
</script>
