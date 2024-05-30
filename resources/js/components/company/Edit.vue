<template>
  <!--=================================
  Employer Dashboard -->
  <section class="job-lst-cont">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <!-- Button Block-->
          <div v-if="company && !company.finish_register && !enableForm" class="col-md-12 my-5 mx-auto">
            <p class="mb-5">企業情報をご登録ください。</p>
            <a class="btn blue-btn btn-lg" href="javascript:void(0)" title="企業情報を登録する" v-on:click="showEditForm">企業情報を登録する</a>
          </div>
          <!-- End Button Block-->
          <v-alert v-if="page_alert" ref="page-alert" :type="page_alert.type" :messages="page_alert.message" autoscroll dismissible autofade :delay="500000"></v-alert>
          <form v-if="(company && company.finish_register) || enableForm" class="mt-4">
            <!-- Form Block -->
            <ValidationObserver ref="observer">
              <div class="mb-5 frm-block form-web">
                <div v-if="alert_msg" :class="alert_type" class="alert text-left">
                  {{ alert_msg }}
                </div>
                <!-- Form Row -->
                <div class="form-row">
                  <!-- Form group -->
                  <div v-if="!editMode" class="form-group col-md-6">
                    <label for="company_name">企業名</label>
                    <p class="frm-show-data">{{ company ? company.company_name : "" }}</p>
                  </div>
                  <template v-else>
                    <ValidationProvider mode="eager" name="企業名" v-slot="{ errors }" rules="required|max:100" slim>
                      <div class="form-group col-md-6">
                        <label for="company_name">企業名 <span class="red-required">必須</span></label>
                        <input type="text" class="form-control" id="company_name" placeholder="" v-model="company.company_name" />
                        <small class="form-text text-error">{{ errors[0] }}</small>
                      </div>
                    </ValidationProvider>
                  </template>
                  <!-- End Form group -->

                  <!-- Form group -->
                  <div v-if="!editMode" class="form-group col-md-6">
                    <label for="name">代表者名</label>
                    <p class="frm-show-data">{{ company ? company.leader_name : "" }}</p>
                  </div>
                  <template v-else>
                    <ValidationProvider mode="eager" name="代表者名" v-slot="{ errors }" rules="required|max:100" slim>
                      <div class="form-group col-md-6">
                        <label for="name">代表者名 <span class="red-required">必須</span></label>
                        <input type="text" class="form-control" id="name" placeholder="" v-model="company.leader_name" />
                        <small class="form-text text-error">{{ errors[0] }}</small>
                      </div>
                    </ValidationProvider>
                  </template>
                  <!-- End Form group -->
                </div>
                <!-- End Form Row -->

                <!-- Form Row -->
                <div class="form-row">
                  <!-- Form group -->
                  <div v-if="!editMode" class="form-group col-md-12">
                    <label for="company_url">コーポレートURL</label>
                    <p class="frm-show-data">{{ company ? company.url : "" }}</p>
                  </div>
                  <template v-else>
                    <ValidationProvider mode="eager" name="コーポレートURL" v-slot="{ errors }" rules="required|max:100" slim>
                      <div class="form-group col-md-12">
                        <label for="company_url">コーポレートURL <span class="red-required">必須</span></label>
                        <input type="text" class="form-control" id="company_url" placeholder="" v-model="company.url" />
                        <small class="form-text text-error">{{ errors[0] }}</small>
                      </div>
                    </ValidationProvider>
                  </template>
                  <!-- End Form group -->
                </div>
                <!-- End Form Row -->

                <!-- Form Row -->
                <div class="form-row">
                  <!-- Form group -->
                  <div v-if="!editMode" class="form-group col-md-6">
                    <label for="postal_code">郵便番号</label>
                    <p class="frm-show-data">{{ company ? company.postal_code : "" }}</p>
                  </div>
                  <template v-else>
                    <div class="form-group col-lg-6">
                      <label>郵便番号 <span class="red-required">必須</span></label>
                      <div class="form-inline frm-inline">
                        <input
                          @keypress="inputNumber($event)"
                          v-on:change="
                            checkRequired(company.postal_code1, 'postal_code1');
                            checkPattern(company.postal_code1, 'postal_code1');
                          "
                          type="text"
                          class="form-control col-md-3"
                          id="postal_code_01"
                          placeholder=""
                          v-model="company.postal_code1"
                        />
                        <span class="col-md-1 text-center"> - </span>
                        <input
                          v-on:change="
                            checkRequired(company.postal_code2, 'postal_code2');
                            checkPattern(company.postal_code2, 'postal_code2');
                          "
                          type="text"
                          class="form-control col-md-3"
                          id="postal_code_02"
                          placeholder=""
                          v-model="company.postal_code2"
                        />
                        <span class="col-md-5 text-center">
                          <a @click="getInfoByZipCode" class="btn blue-btn btn-lg" href="javascript:void(0)" title="住所自動入力">住所自動入力</a>
                        </span>
                      </div>
                      <small class="form-text text-error" v-if="errorsPostalCode1 && errorsPostalCode1.length > 0">{{ errorsPostalCode1 }}</small>
                      <small class="form-text text-error" v-else-if="errorsPostalCode2 && errorsPostalCode2.length > 0">{{ errorsPostalCode2 }}</small>
                    </div>
                  </template>
                  <!-- End Form group -->

                  <!-- Form group -->
                  <div v-if="!editMode" class="form-group col-md-6 mb-5 select-border">
                    <label for="sector">都道府県</label>
                    <p class="frm-show-data">{{ company && company.prefecture ? company.prefecture.name : "" }}</p>
                  </div>
                  <template v-else>
                    <ValidationProvider mode="eager" name="都道府県" v-slot="{ errors }" rules="must_selected" slim>
                      <div class="form-group col-md-6 mb-5 select-border">
                        <label for="sector">都道府県 <span class="red-required">必須</span></label>
                        <select2 v-if="prefectureId" class="form-control basic-select" v-model="prefectureId">
                          <!-- <option value="" :selected="!company.prefecture.id" disabled></option> -->
                          <option v-for="(item, key) in prefecture" v-bind:value="item.id" v-bind:key="key" v-bind:selected="item.id == prefectureId">{{ item.name }}</option>
                        </select2>
                        <select2 v-else class="form-control basic-select" v-model="prefectureId">
                          <!-- <option value=""></option> -->
                          <option v-for="(item, key) in prefecture" v-bind:value="item.id" v-bind:key="key">{{ item.name }}</option>
                        </select2>
                        <small class="form-text text-error">{{ errors[0] }}</small>
                      </div>
                    </ValidationProvider>
                  </template>
                  <!-- End Form group -->
                </div>
                <!-- End Form Row -->

                <!-- Form Row -->
                <div class="form-row">
                  <!-- Form group -->
                  <div v-if="!editMode" class="form-group col-md-6">
                    <label for="city">市区町村</label>
                    <p class="frm-show-data">{{ company ? company.city : "" }}</p>
                  </div>
                  <template v-else>
                    <ValidationProvider mode="eager" name="市区町村" v-slot="{ errors }" rules="required|max:100" slim>
                      <div class="form-group col-md-6">
                        <label for="city">市区町村 <span class="red-required">必須</span></label>
                        <input type="text" class="form-control" id="city" placeholder="" v-model="company.city" />
                        <small class="form-text text-error">{{ errors[0] }}</small>
                      </div>
                    </ValidationProvider>
                  </template>
                  <!-- End Form group -->

                  <!-- Form group -->
                  <div v-if="!editMode" class="form-group col-md-6">
                    <label for="address_building_name">番地・建物名</label>
                    <p class="frm-show-data">{{ company ? company.town : "" }}</p>
                  </div>
                  <template v-else>
                    <ValidationProvider mode="eager" name="番地・建物名" v-slot="{ errors }" rules="required|max:100" slim>
                      <div class="form-group col-md-6">
                        <label for="address_building_name">番地・建物名 <span class="red-required">必須</span></label>
                        <input type="text" class="form-control" id="address_building_name" placeholder="" v-model="company.town" />
                        <small class="form-text text-error">{{ errors[0] }}</small>
                      </div>
                    </ValidationProvider>
                  </template>
                  <!-- End Form group -->
                </div>
                <!-- End Form Row -->

                <!-- Form Row -->
                <div class="form-row">
                  <!-- Form group -->
                  <div v-if="!editMode" class="form-group col-md-6 mb-5">
                    <label>設立年月</label>
                    <p class="frm-show-data">{{ company ? company.founded_date : "" }}</p>
                  </div>
                  <template v-else>
                    <ValidationProvider ref="founded-date-validation" mode="eager" name="設立年月" v-slot="{ errors }" rules="must_selected|date_format|date" slim>
                      <div class="form-group col-md-6 mb-5">
                        <label>設立年月 <span class="red-required">必須</span></label>
                        <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                          <date-picker
                            v-model="company.founded_date"
                            name="founded_date"
                            :config="datepickerConfig"
                            ref="date-picker"
                            @dp-change="validateFoundedDate"
                          ></date-picker>
                          <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker" v-on:click="$refs['date-picker'].dp.show()">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                        </div>
                        <small class="form-text text-error" v-if="errors[0]">{{ errors[0] }}</small>
                      </div>
                    </ValidationProvider>
                  </template>
                  <!-- End Form group -->

                  <!-- Form group -->
                  <div v-if="!editMode" class="form-group col-md-6">
                    <label for="capital">資本金 </label>
                    <p class="frm-show-data">{{ company ? company.capital : "" }}</p>
                  </div>
                  <template v-else>
                    <ValidationProvider mode="eager" name="資本金" v-slot="{ errors }" rules="required|max:200" slim>
                      <div class="form-group col-md-6">
                        <label for="capital">資本金 <span class="red-required">必須</span></label>
                        <input type="text" class="form-control" id="capital" placeholder="" v-model="company.capital" />
                        <small class="form-text text-error">{{ errors[0] }}</small>
                      </div>
                    </ValidationProvider>
                  </template>
                  <!-- End Form group -->
                </div>
                <!-- End Form Row -->

                <!-- Form Row -->
                <div class="form-row">
                  <!-- Form group -->
                  <div v-if="!editMode" class="form-group col-md-6">
                    <label for="number_of_employees">従業員数</label>
                    <p class="frm-show-data">{{ company ? company.number_of_employees : "" }}名</p>
                  </div>
                  <template v-else>
                    <ValidationProvider mode="eager" name="従業員数" v-slot="{ errors }" rules="required|numeric|min_value:1" slim>
                      <div class="form-group col-md-6">
                        <label for="number_of_employees">従業員数 <span class="red-required">必須</span></label>
                        <div class="form-inline">
                          <input @keypress="inputNumber($event)" type="text" class="form-control col-md-3" id="number_of_employees" v-model="company.number_of_employees" />
                          <span class="ml-3 font-weight-bold"> 名 </span>
                        </div>
                        <small class="form-text text-error">{{ errors[0] }}</small>
                      </div>
                    </ValidationProvider>
                  </template>
                  <!-- End Form group -->

                  <!-- Form group -->
                  <div v-if="!editMode" class="form-group col-md-6">
                    <label for="amount_of_sales">売上高</label>
                    <p class="frm-show-data">{{ company ? company.sales : "" }}</p>
                  </div>
                  <template v-else>
                    <ValidationProvider mode="eager" name="売上高" v-slot="{ errors }" rules="required|max:200" slim>
                      <div class="form-group col-md-6">
                        <label for="amount_of_sales">売上高 <span class="red-required">必須</span></label>
                        <input type="text" class="form-control" id="amount_of_sales" placeholder="" v-model="company.sales" />
                        <small class="form-text text-error">{{ errors[0] }}</small>
                      </div>
                    </ValidationProvider>
                  </template>
                  <!-- End Form group -->
                </div>
                <!-- End Form Row -->

                <!-- Form Row -->
                <div class="form-row">
                  <!-- Form group -->
                  <div v-if="!editMode" class="form-group col-md-12">
                    <label for="company_introduction">自社紹介</label>
                    <p class="frm-show-data">{{ company ? company.company_introduction : "" }}</p>
                  </div>
                  <template v-else>
                    <ValidationProvider mode="eager" name="自社紹介" v-slot="{ errors }" rules="required|max:400" slim>
                      <div class="form-group col-md-12">
                        <label for="company_introduction">自社紹介 <span class="red-required">必須</span></label>
                        <textarea class="form-control" rows="4" id="company_introduction" v-model="company.company_introduction" placeholder=""></textarea>
                        <small class="float-right">400文字まで</small>
                        <small class="form-text text-error">{{ errors[0] }}</small>
                      </div>
                    </ValidationProvider>
                  </template>
                  <!-- End Form group -->
                </div>
                <!-- End Form Row -->
              </div>
              <!-- End Form Block -->

              <!-- Form Block -->
              <div class="mb-5 frm-block form-web">
                <!-- Form Row -->
                <div class="form-row">
                  <!-- Form group -->
                  <div v-if="!editMode" class="form-group col-md-6">
                    <label for="person_name">ご担当者氏名</label>
                    <p class="frm-show-data">{{ company ? company.charge_person_name : "" }}</p>
                  </div>
                  <template v-else>
                    <ValidationProvider mode="eager" name="ご担当者氏名" v-slot="{ errors }" rules="required|max:100" slim>
                      <div class="form-group col-md-6">
                        <label for="person_name">ご担当者氏名 <span class="red-required">必須</span></label>
                        <input type="text" class="form-control" id="person_name" placeholder="" v-model="company.charge_person_name" />
                        <small class="form-text text-error">{{ errors[0] }}</small>
                      </div>
                    </ValidationProvider>
                  </template>
                  <!-- End Form group -->

                  <!-- Form group -->
                  <div v-if="!editMode" class="form-group col-md-6">
                    <label for="furigana_person_name">ご担当者氏名（ふりがな）</label>
                    <p class="frm-show-data">{{ company ? company.charge_person_furigana : "" }}</p>
                  </div>
                  <template v-else>
                    <ValidationProvider mode="eager" name="ご担当者氏名（ふりがな）" v-slot="{ errors }" rules="required|furigana|max:100" slim>
                      <div class="form-group col-md-6">
                        <label for="furigana_person_name">ご担当者氏名（ふりがな） <span class="red-required">必須</span></label>
                        <input type="text" class="form-control" id="furigana_person_name" placeholder="" v-model="company.charge_person_furigana" />
                        <small class="form-text text-error">{{ errors[0] }}</small>
                      </div>
                    </ValidationProvider>
                  </template>
                  <!-- End Form group -->
                </div>
                <!-- End Form Row -->

                <!-- Form Row -->
                <div class="form-row">
                  <!-- Form group -->
                  <div v-if="!editMode" class="form-group col-md-6">
                    <label for="person_in_charge">ご担当者部署</label>
                    <p class="frm-show-data">{{ company ? company.charge_person : "" }}</p>
                  </div>
                  <template v-else>
                    <ValidationProvider mode="eager" name="ご担当者部署" v-slot="{ errors }" rules="required|max:100" slim>
                      <div class="form-group col-md-6">
                        <label for="person_in_charge">ご担当者部署 <span class="red-required">必須</span></label>
                        <input type="text" class="form-control" id="person_in_charge" placeholder="" v-model="company.charge_person" />
                        <small class="form-text text-error">{{ errors[0] }}</small>
                      </div>
                    </ValidationProvider>
                  </template>
                  <!-- End Form group -->

                  <!-- Form group -->
                  <div v-if="!editMode" class="form-group col-md-6">
                    <label for="phone_number">ご担当者電話番号</label>
                    <p class="frm-show-data">{{ company ? company.charge_person_phone : "" }}</p>
                  </div>
                  <template v-else>
                    <ValidationProvider mode="eager" name="ご担当者電話番号" v-slot="{ errors }" rules="required|phone_number|max:100" slim>
                      <div class="form-group col-md-6">
                        <label for="phone_number">ご担当者電話番号 <span class="red-required">必須</span></label>
                        <input type="text" class="form-control" id="phone_number" placeholder="" v-model="company.charge_person_phone" />
                        <small class="form-text text-error">{{ errors[0] }}</small>
                      </div>
                    </ValidationProvider>
                  </template>
                  <!-- End Form group -->
                </div>
                <!-- End Form Row -->
              </div>
              <!-- End Form Block -->

              <!-- Button Block-->
              <div class="col-md-12 my-5 mx-auto text-center">
                <a v-if="!editMode" class="btn blue-btn btn-lg" href="javascript:void(0)" title="企業情報を編集" v-on:click="showEditForm">企業情報を編集</a>
                <a v-else class="btn blue-btn btn-lg" href="javascript:void(0)" title="上記内容で登録する" @click="beforeChange">上記内容で登録する</a>
              </div>
              <!-- End Button Block-->
            </ValidationObserver>

            <!-- Popup Button -->
            <!-- <a v-if="editMode" @click="showUploadPopup" href="javascript:void(0)" data-toggle="modal"><i class="fas fa-expand pr-2"></i>Open Popup</a> -->
            <!-- End Popup Button -->
          </form>
        </div>
      </div>
    </div>

  </section>
  <!--=================================
  Employer Dashboard -->
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import datePicker from "vue-bootstrap-datetimepicker";
// import moment
import moment from "moment";
import select2 from "./../Select2";
import vAlert from "../Alert";
export default {
  data() {
    const dateFormat = "YYYY/MM/DD";
    return {
      company: {},
      enableForm: false,
      editMode: false,
      datepickerConfig: {
        format: dateFormat,
        useCurrent: false,
        locale: "ja"
      },
      errorsPostalCode1: "",
      errorsPostalCode2: "",
      prefecture: [],
      prefectureId: "",
      company_image: "",
      company_image_name: "",
      alert_msg: "",
      alert_type: "",
      page_alert: null
    };
  },
  computed: {
    ...mapGetters(["errors"]),
    ...mapGetters("company", ["isLogin", "companyData"])
  },
  async created() {
    this.company = this.companyData;

    let isExistCompany = typeof this.company != "undefined" && this.company !== "" && this.company != null;
    if (isExistCompany) {
      await this.getPrefectureList();

      let isExistPrefecture = typeof this.company.prefecture != "undefined" && this.company.prefecture !== "" && this.company.prefecture != null;
      if (isExistPrefecture) {
        this.prefectureId = this.company.prefecture.id;
      }
    }
  },
  mounted() {
	this.$store.commit("setTemplates", { footerFixed: true });
    this.$store.commit("setErrors", {});
  },
  methods: {
    ...mapActions("company", ["getMasterData"]),
    showEditForm() {
      this.enableForm = true;
      this.editMode = true;

      let numberOfEmployees = parseInt(this.company.number_of_employees);
      if (numberOfEmployees <= 0 || !numberOfEmployees) {
        this.company.number_of_employees = null;
      }

      let sales = parseInt(this.company.sales);
      if (sales <= 0 || !sales) {
        this.company.sales = null;
      }

      this.clearAlert();
    },
    checkRequired(value, name) {
      switch (name) {
        case "postal_code1":
          if ("" === value) {
            this.errorsPostalCode1 = this.trans.get("validation.required").replace(":attribute", "郵便番号");
          } else {
            this.errorsPostalCode1 = "";
          }
          break;
        case "postal_code2":
          if ("" === value) {
            this.errorsPostalCode2 = this.trans.get("validation.required").replace(":attribute", "郵便番号");
          } else {
            this.errorsPostalCode2 = "";
          }
          break;
      }
    },
    async getPrefectureList() {
      await this.getMasterData().then(res => {
        this.prefecture = res.data.prefectures;
        this.company = res.data.company_data.payload;
      });
    },
    async validateFoundedDate() {
      await this.$refs["founded-date-validation"].validate();
    },
    changeCompanyInfo() {
      let _self = this;
      _self.page_alert = null;
      let data = _self.company;
      data.prefecture_id = _self.prefectureId;
      axios.post("companies/info/edit/" + _self.company.id, data).then(response => {
        if ("success" === response.data.status) {
          _self.$store.commit("company/setCompanyData", response.data.payload);
          _self.company = _self.companyData;
          _self.$root.$emit("setCompanyCompleteName", _self.companyData.company_name);
          _self.enableForm = false;
          _self.editMode = false;
          _self.page_alert = {
            type: "success",
            message: _self.trans.get("messages.M120")
          };
        }
        if ("error" === response.data.status) {
          _self.page_alert = {
            type: "danger",
            message: res.data.messages
          };
        }
      });
    },
    showModal() {
      const params = {
        title: "確認",
        text: "正常に更新されました。"
      };
      this.$modal.show(params);
    },
    showDialogConfirm() {
      const params = {
        title: "確認",
        text: this.trans.get("messages.M132"),
        onConfirm: () => {
          return this.changeCompanyInfo();
        }
      };
      this.$modal.dialogConfirmCompany(params);
    },
    async beforeChange() {
      let self = this;
      if ("" === self.company.postal_code1) {
        self.checkRequired(self.company.postal_code1, "postal_code1");
      }
      if ("" === self.company.postal_code2) {
        self.checkRequired(self.company.postal_code2, "postal_code2");
      }
      const valid = await self.$refs.observer.validate();
      let isValid = valid && "" === self.errorsPostalCode1 && "" === self.errorsPostalCode2;

      if (isValid) {
        self.showDialogConfirm();
      } else {
        self.scrollToError();
      }
    },
    checkPattern(value, name) {
      let flg = true;
      switch (name) {
        case "postal_code1":
          const patternZipCode = /^\d{3}$/;
          if (!patternZipCode.test(value)) {
            flg = false;
          }
          break;
        case "postal_code2":
          const patternZipCode2 = /^\d{4}$/;
          if (!patternZipCode2.test(value)) {
            flg = false;
          }
          break;
      }

      if (!flg) {
        if ("" === this.errorsPostalCode1) {
          this.errorsPostalCode1 = this.trans.get("validation.regex").replace(":attribute", "郵便番号") + "000-0000";
        }
      } else {
        this.errorsPostalCode1 = "";
      }
    },
    getInfoByZipCode() {
      let isValidPostalCd = "" === this.errorsPostalCode1 && "" === this.errorsPostalCode2;
      if (isValidPostalCd) {
        let postalCd = this.company.postal_code1 + "-" + this.company.postal_code2;
        let self = this;
        axios.get("companies/info/postal-code/" + postalCd, {}).then(response => {
          if (response.data.prefecture) {
            self.prefectureId = response.data.prefecture.id;
          }
          if (response.data.city) {
            self.company.city = response.data.city;
          }
        });
      }
    },
    inputNumber(event) {
      if (event.which != 8 && isNaN(String.fromCharCode(event.which))) {
        event.preventDefault();
      }
    },
    clearAlert() {
      this.page_alert = null;
    },
    scrollToError() {
      const firstError = $("small.form-text.text-error:not(:empty)")
        .first()
        .closest("div");
      if (firstError) {
        this.$_scrollTo(firstError);
      }
    }
  },
  components: {
    datePicker,
    select2,
    vAlert
  }
};
</script>
