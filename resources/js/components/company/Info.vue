<template>
  <!-- Main -->
  <main role="main" class="col-lg-12 main-block">
    <section class="main-cont">
      <!-- Breadcrumb -->
      <Breadcrumb />
      <!-- End Breadcrumb -->

      <!-- Main container -->
      <div class="container main-body">
        <div class="row">
          <Left />
          <!-- Content-right -->
          <div class="col-sm-12 col-md-8 col-lg-9 content-right">
            <table class="table table-style width-250 mb-5">
              <tbody>
                <tr>
                  <th>企業名</th>
                  <td>{{ dataInfo.company_name }}</td>
                </tr>
                <tr>
                  <th>代表者名</th>
                  <td>{{ dataInfo.representative_name }}</td>
                </tr>
                <tr>
                  <th>企業ロゴ</th>
                  <td>
                    <div class="img-upload">
                      <div class="box-img">
                        <img v-bind:src="dataInfo.logo" :alt="dataInfo.company_name" />
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th>コーポレートURL</th>
                  <td>
                    <a v-bind:href="dataInfo.url" target="_blank">{{ dataInfo.url }}</a>
                  </td>
                </tr>
                <tr>
                  <th>郵便番号</th>
                  <td>{{ dataInfo.postal_code }}</td>
                </tr>
                <tr>
                  <th>都道府県</th>
                  <td>{{ dataInfo.prefectures }}</td>
                </tr>
                <tr>
                  <th>市区町村</th>
                  <td>{{ dataInfo.city }}</td>
                </tr>
                <tr>
                  <th>番地・建物名</th>
                  <td>{{ dataInfo.address }}</td>
                </tr>
                <tr>
                  <th>設立年月</th>
                  <td>{{ dataInfo.establishment_year }}</td>
                </tr>
                <tr>
                  <th>資本金</th>
                  <td>{{ dataInfo.capital }}</td>
                </tr>
                <tr>
                  <th>従業員数</th>
                  <td>{{ dataInfo.number_of_employees }}</td>
                </tr>
                <tr>
                  <th>売上高</th>
                  <td>{{ dataInfo.sales }}</td>
                </tr>
                <tr>
                  <th>自社紹介</th>
                  <td>{{ dataInfo.company_introduction }}</td>
                </tr>
              </tbody>
            </table>
            <table class="table table-style width-250">
              <tbody>
                <tr>
                  <th>ご担当者氏名</th>
                  <td>{{ dataInfo.charge_person_name }}</td>
                </tr>
                <tr>
                  <th>ご担当者氏名ふりがな</th>
                  <td>{{ dataInfo.charge_person_furigana }}</td>
                </tr>
                <tr>
                  <th>ご担当者部署</th>
                  <td>{{ dataInfo.charge_person }}</td>
                </tr>
                <tr>
                  <th>ご担当者電話番号</th>
                  <td>{{ dataInfo.charge_person_phone }}</td>
                </tr>
              </tbody>
            </table>
            <div class="text-center mt-5">
              <!-- <button type="submit" class="btn btn-style">
                企業情報を編集
              </button> -->
              <router-link class="btn btn-style" :to="{ name: 'company.edit' }">企業情報を編集</router-link>
            </div>
          </div>
          <!-- End Content-right -->
        </div>
      </div>
      <!-- End Main container -->
    </section>
  </main>
  <!-- End Main -->
</template>

<script>
import { mapGetters, mapActions } from "vuex";
export default {
  data() {
    return {
      dataInfo: {
        company_name: "",
        charge_person_name: "",
        charge_person_furigana: "",
        charge_person: "",
        charge_person_phone: "",
        representative_name: "",
        logo: "",
        url: "",
        postal_code: "",
        prefectures: "",
        city: "",
        address: "",
        establishment_year: "",
        capital: "",
        number_of_employees: "",
        sales: "",
        company_introduction: ""
      }
    };
  },
  computed: {
    ...mapGetters("company", ["companyData"])
  },
  mounted() {
    this.loadInfo();
  },
  methods: {
    ...mapActions("company", ["getCompanyData"]),
    async loadInfo() {
      let _self = this;
      let _id = this.companyData.id;
      _self.getCompanyData({ company_id: _id }).then(
        () => {
          _self.dataInfo = _self.companyData;
        },
        error => {}
      );
    }
  }
};
</script>
