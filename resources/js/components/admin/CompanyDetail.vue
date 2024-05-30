<template>
  <!-- /.row -->
  <div class="row">
    <div class="col-md-12">
      <!-- Tab Button -->
      <div class="tab_btn">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item">
            <a @click="clearAlert" :class="('view' == mode) ? 'active' : ''" class="nav-link" id="checking-tab" data-toggle="tab" href="#checking" role="tab" aria-controls="checking" :aria-selected="('view' == mode) ? 'true' : 'false'">閲覧</a>
          </li>
          <li class="nav-item">
            <a @click="clearAlert" :class="('edit' == mode) ? 'active' : ''" class="nav-link" id="edit-tab" data-toggle="tab" href="#edit" role="tab" aria-controls="edit" :aria-selected="('edit' == mode) ? 'true' : 'false'">編集</a>
          </li>
          <li class="nav-item">
            <a @click="clearAlert" class="nav-link" id="note-tab" data-toggle="tab" href="#note" role="tab" aria-controls="note" aria-selected="false">メモ</a>
          </li>
        </ul>
      </div>
      <!-- End Tab Button -->

      <!-- Tab Content -->
      <div class="bg_container tab-content">
        <!-- Tab 01: Checking Tab -->
        <div :class="('view' == mode) ? 'active' : ''" class="tab-pane" id="checking" role="tabpanel" aria-labelledby="checking-tab">
          <form class="user-data-frm" role="form">
            <!-- Form status-->
            <div class="row form_status">
                <!-- col 04 -->
              <div class="col-6 col-sm-6 col-md-3">
                <div class="form-group">
                  <p class="frm-show-data">{{ getRegisterStatus(company.finish_register) }}</p>
                </div>
              </div>
              <!-- End col 04 -->
              <!-- col 03 -->
              <div class="col-6 col-sm-6 col-md-2">
                <div class="form-group">
                  <p class="frm-show-data">{{ company.hot_flg ? 'ON' : 'OFF' }}</p>
                </div>
              </div>
              <!-- End col 03 -->
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
                      <p class="frm-show-data">{{ company.id }}</p>
                    </div>
                  </div>
                  <!-- End Col 06 -->

                  <!-- Col 06 -->
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="created_date">作成日</label>
                      <p class="frm-show-data">{{ moment(company.created_at).format(dateFormat) }}</p>
                    </div>
                  </div>
                  <!-- End Col 06 -->
                </div>
                <!-- End Row -->

                <!-- Row -->
                <div class="row">
                  <!-- Col 12 -->
                  <div class="col-12">
                    <div class="form-group">
                      <label for="namecompany">企業名</label>
                      <p class="frm-show-data">{{ company.company_name }}</p>
                    </div>
                  </div>
                  <!-- End Col 12 -->
                </div>
                <!-- End Row -->

                <!-- Row -->
                <div class="row">
                  <!-- Col 06 -->
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="perchar">ご担当者氏名</label>
                      <p class="frm-show-data">{{ company.charge_person_name }}</p>
                    </div>
                  </div>
                  <!-- End Col 06 -->

                  <!-- Col 06 -->
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="percharfuri">ご担当者氏名 ふりがな</label>
                      <p class="frm-show-data">{{ company.charge_person_furigana }}</p>
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
                      <label for="depchar">ご担当者部署</label>
                      <p class="frm-show-data">{{ company.charge_person }}</p>
                    </div>
                  </div>
                  <!-- End Col 06 -->

                  <!-- Col 06 -->
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="phone">ご担当者電話番号</label>
                      <p class="frm-show-data">{{ company.charge_person_phone }}</p>
                    </div>
                  </div>
                  <!-- End Col 06 -->
                </div>
                <!-- End Row -->

                <!-- Row -->
                <div class="row">
                  <!-- Col 12 -->
                  <div class="col-12">
                    <div class="form-group">
                      <label for="email">メールアドレス</label>
                      <p class="frm-show-data">{{ company.charge_person_email }}</p>
                    </div>
                  </div>
                  <!-- End Col 12 -->
                </div>
                <!-- End Row -->

              </div>
              <!-- /.card-body -->
            </div>
            <!-- End General Form -->

              <!-- General Form -->
              <div class="card card-warning">
              <div class="card-body">
                <!-- Row -->
                <div class="row">
                  <!-- Col 12 -->
                  <div class="col-12">
                    <div class="form-group">
                      <label for="reprename">代表者名</label>
                      <p class="frm-show-data">{{ company.leader_name }}</p>
                    </div>
                  </div>
                  <!-- End Col 12 -->
                </div>
                <!-- End Row -->

                <!-- Row -->
                <div class="row">
                  <!-- Col 12 -->
                  <div class="col-12">
                    <div class="form-group">
                      <label for="corpurl">コーポレートURL</label>
                      <p class="frm-show-data">{{ company.url }}</p>
                    </div>
                  </div>
                  <!-- End Col 12 -->
                </div>
                <!-- End Row -->

                  <!-- Row -->
                  <div class="row">
                  <!-- Col 06 -->
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="postcode">郵便番号</label>
                      <p class="frm-show-data">{{ company.postal_code }}</p>
                    </div>
                  </div>
                  <!-- End Col 06 -->

                  <!-- Col 06 -->
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="prefectu">都道府県</label>
                      <p class="frm-show-data">{{ (company.prefecture) ? company.prefecture.name : '' }}</p>
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
                      <label for="munici">市区町村</label>
                      <p class="frm-show-data">{{ company.city }}</p>
                    </div>
                  </div>
                  <!-- End Col 06 -->

                  <!-- Col 06 -->
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="addbuil">番地・建物名</label>
                      <p class="frm-show-data">{{ company.town }}</p>
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
                      <label for="created_date2">設立年月</label>
                      <p class="frm-show-data">{{ moment(company.founded_date).format(dateFormat) }}</p>
                    </div>
                  </div>
                  <!-- End Col 06 -->

                  <!-- Col 06 -->
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="capit">資本金 </label>
                      <p class="frm-show-data">{{ company.capital }}</p>
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
                      <label for="eestayea">従業員数</label>
                      <p class="frm-show-data">{{ company.number_of_employees }}名</p>
                    </div>
                  </div>
                  <!-- End Col 06 -->

                  <!-- Col 06 -->
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="amfals">売上高</label>
                      <p class="frm-show-data">{{ company.sales }}</p>
                    </div>
                  </div>
                  <!-- End Col 06 -->
                </div>
                <!-- End Row -->

                <!-- Row -->
                <div class="row">
                  <!-- Col 12 -->
                  <div class="col-12">
                    <div class="form-group">
                      <label for="compintro">自社紹介</label>
                      <p class="frm-show-data">{{ company.company_introduction }}</p>
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
        <div :class="('edit' == mode) ? 'active' : ''" class="tab-pane" id="edit" role="tabpanel" aria-labelledby="edit-tab">
          <v-alert v-if="page_alert" ref="page-alert" :type="page_alert.type" :messages="page_alert.message" autoscroll dismissible autofade :delay="500000"></v-alert>
          <form class="user-data-frm form_comp" role="form" ref="company-detail-form">
            <ValidationObserver ref="observer">
              <!-- Form status-->
              <div class="row form_status">
                <!-- col 04 -->
                <div class="col-6 col-sm-6 col-md-3">
                  <ValidationProvider mode="eager" name="求人情報を掲載" v-slot="{ errors }" rules="must_selected" slim>
                    <div class="form-group custom-select2">
                      <select2 class="form-control basic-select select2" style="width: 100%;" name="finish_register" v-model="company.finish_register">
                        <option v-for="(item, key) in register_status" v-bind:value="item.id" v-bind:key="key">{{ item.name }}</option>
                      </select2>
                      <small class="form-text text-danger" v-if="errors[0]">{{ errors[0] }}</small>
                    </div>
                  </ValidationProvider>
                </div>
                <!-- End col 04 -->
                <!-- col 03 -->
                <div class="col-6 col-sm-6 col-md-2">
                  <div class="form-group custom-select2">
                    <select2 class="form-control basic-select select2" name="hot_flg" style="width: 100%;" v-model="company.hot_flg">
                      <option v-for="(item, key) in status_corp" v-bind:value="item.id" v-bind:key="key">{{ item.name }}</option>
                    </select2>
                  </div>
                </div>
                <!-- End col 03 -->
                <!-- col 07 -->
                <div class="col-sm-12 col-md-7 text-right">
                  <div class="form-group">
                    <button class="btn blue-btn mgr-15" type="button" @click="beforeChange">編集を保存</button>
                    <button class="btn trans-btn" type="button" @click="resetForm">リセット</button>
                  </div>
                </div>
                <!-- End col 07 -->
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
                        <input id="id" type="text" name="id" class="form-control" placeholder="" v-bind:value="company.id" disabled>
                      </div>
                    </div>
                    <!-- End Col 06 -->

                    <!-- Col 06 -->
                    <div class="col-sm-6">
                      <ValidationProvider ref="validate-created-date" mode="eager" name="作成日" v-slot="{ errors }" rules="must_selected|date_format|date" slim>
                        <div class="form-group">
                          <label for="created_date">作成日</label>
                          <div class="input-group date" id="created_date" data-target-input="nearest">
                            <date-picker v-model="created_at" name="created_at" :config="datepickerConfig" ref="date-picker-created-at" :placeholder="'YYYY/MM/DD'"  @dp-change="validateDateCalendar('validate-created-date')"></date-picker>
                            <div class="input-group-append" data-target="#created_date" data-toggle="datetimepicker" v-on:click="$refs['date-picker-created-at'].dp.show()">
                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                          </div>
                          <small class="form-text text-danger" v-if="errors[0]">{{ errors[0] }}</small>
                        </div>
                      </ValidationProvider>
                    </div>
                    <!-- End Col 06 -->
                  </div>
                  <!-- End Row -->

                  <!-- Row -->
                  <div class="row">
                    <!-- Col 12 -->
                    <div class="col-12">
                      <ValidationProvider mode="eager" name="企業名" v-slot="{ errors }" rules="required|max:100" slim>
                        <div class="form-group">
                          <label for="namecompany">企業名</label>
                          <div class="input-group">
                            <input id="namecompany" type="text" name="company_name" class="form-control" placeholder="" v-model="company.company_name">
                            <div class="input-group-append">
                              <div class="input-group-text"><i class="fa fa-archway"></i></div>
                            </div>
                          </div>
                          <small class="form-text text-danger" v-if="errors[0]">{{ errors[0] }}</small>
                        </div>
                      </ValidationProvider>
                    </div>
                    <!-- End Col 12 -->
                  </div>
                  <!-- End Row -->

                  <!-- Row -->
                  <div class="row">
                    <!-- Col 06 -->
                    <div class="col-sm-6">
                      <ValidationProvider mode="eager" name="ご担当者氏名" v-slot="{ errors }" rules="required|max:100" slim>
                        <div class="form-group">
                          <label for="perchar">ご担当者氏名</label>
                          <div class="input-group">
                            <input id="perchar" type="text" class="form-control" placeholder="" name="charge_person_name" v-model="company.charge_person_name">
                            <div class="input-group-append">
                              <div class="input-group-text"><i class="fa fa-file-signature"></i></div>
                            </div>
                          </div>
                          <small class="form-text text-danger" v-if="errors[0]">{{ errors[0] }}</small>
                        </div>
                      </ValidationProvider>
                    </div>
                    <!-- End Col 06 -->

                    <!-- Col 06 -->
                    <div class="col-sm-6">
                      <ValidationProvider mode="eager" name="ご担当者氏名 ふりがな" v-slot="{ errors }" rules="required|furigana|max:100" slim>
                      <div class="form-group">
                        <label for="percharfuri">ご担当者氏名 ふりがな</label>
                        <div class="input-group">
                          <input id="percharfuri" type="text" class="form-control" placeholder="" name="charge_person_furigana" v-model="company.charge_person_furigana">
                          <div class="input-group-append">
                            <div class="input-group-text"><i class="fa fa-file-signature"></i></div>
                          </div>
                        </div>
                        <small class="form-text text-danger" v-if="errors[0]">{{ errors[0] }}</small>
                      </div>
                      </ValidationProvider>
                    </div>
                    <!-- End Col 06 -->
                  </div>
                  <!-- End Row -->

                  <!-- Row -->
                  <div class="row">
                    <!-- Col 06 -->
                    <div class="col-sm-6">
                      <ValidationProvider mode="eager" name="ご担当者部署" v-slot="{ errors }" rules="required|max:100" slim>
                        <div class="form-group">
                          <label for="depchar">ご担当者部署</label>
                          <div class="input-group">
                            <input id="depchar" type="text" class="form-control" placeholder="" name="charge_person" v-model="company.charge_person">
                            <div class="input-group-append">
                              <div class="input-group-text"><i class="fa fa-chalkboard-teacher"></i></div>
                            </div>
                          </div>
                          <small class="form-text text-danger" v-if="errors[0]">{{ errors[0] }}</small>
                        </div>
                      </ValidationProvider>
                    </div>
                    <!-- End Col 06 -->

                    <!-- Col 06 -->
                    <div class="col-sm-6">
                      <ValidationProvider mode="eager" name="ご担当者電話番号" v-slot="{ errors }" rules="required|phone_number|max:100" slim>
                      <div class="form-group">
                        <label for="phone">ご担当者電話番号</label>
                        <div class="input-group">
                          <input id="phone" type="text" class="form-control" placeholder="" name="charge_person_phone" v-model="company.charge_person_phone">
                          <div class="input-group-append">
                            <div class="input-group-text"><i class="fa fa-phone"></i></div>
                          </div>
                        </div>
                        <small class="form-text text-danger" v-if="errors[0]">{{ errors[0] }}</small>
                      </div>
                      </ValidationProvider>
                    </div>
                    <!-- End Col 06 -->
                  </div>
                  <!-- End Row -->

                  <!-- Row -->
                  <div class="row">
                    <!-- Col 12 -->
                    <div class="col-12">
                      <ValidationProvider mode="eager" name="メールアドレス" v-slot="{ errors }" rules="required|email|max:100" vid="new_email" slim>
                        <div class="form-group">
                          <label for="email">メールアドレス</label>
                          <div class="input-group">
                            <input id="email" type="text" class="form-control" placeholder="" name="charge_person_email" v-model="company.charge_person_email">
                            <div class="input-group-append">
                              <div class="input-group-text"><i class="fa fa-envelope"></i></div>
                            </div>
                          </div>
                          <small class="form-text text-danger" v-if="errors[0]">{{ errors[0] }}</small>
                        </div>
                      </ValidationProvider>
                    </div>
                    <!-- End Col 12 -->
                  </div>
                  <!-- End Row -->

                </div>
                <!-- /.card-body -->
              </div>
              <!-- End General Form -->

                <!-- General Form -->
                <div class="card card-warning">
                <div class="card-body">
                  <!-- Row -->
                  <div class="row">
                    <!-- Col 12 -->
                    <div class="col-12">
                      <ValidationProvider mode="eager" name="代表者名" v-slot="{ errors }" rules="required|max:100" slim>
                        <div class="form-group">
                          <label for="reprename">代表者名</label>
                          <div class="input-group">
                            <input id="reprename" type="text" class="form-control" placeholder="" name="leader_name" v-model="company.leader_name">
                            <div class="input-group-append">
                              <div class="input-group-text"><i class="fa fa-file-signature"></i></div>
                            </div>
                          </div>
                          <small class="form-text text-danger" v-if="errors[0]">{{ errors[0] }}</small>
                        </div>
                      </ValidationProvider>
                    </div>
                    <!-- End Col 12 -->
                  </div>
                  <!-- End Row -->

                  <!-- Row -->
                  <div class="row">
                    <!-- Col 12 -->
                    <div class="col-12">
                      <ValidationProvider mode="eager" name="コーポレートURL" v-slot="{ errors }" rules="required|max:100" slim>
                        <div class="form-group">
                          <label for="corpurl">コーポレートURL</label>
                          <div class="input-group">
                            <input id="corpurl" type="text" class="form-control" placeholder="" name="url" v-model="company.url">
                            <div class="input-group-append">
                              <div class="input-group-text"><i class="fa fa-link"></i></div>
                            </div>
                          </div>
                          <small class="form-text text-danger" v-if="errors[0]">{{ errors[0] }}</small>
                        </div>
                      </ValidationProvider>
                    </div>
                    <!-- End Col 12 -->
                  </div>
                  <!-- End Row -->

                    <!-- Row -->
                    <div class="row">
                    <!-- Col 06 -->
                    <div class="col-sm-6">
                      <ValidationProvider mode="eager" name="郵便番号" v-slot="{ errors }" rules="required|postalcodeadmin|max:20" slim>
                        <div class="form-group">
                          <label for="postcode">郵便番号</label>
                          <div class="input-group">
                            <input @change="getInfoByZipCode(company.postal_code)" id="postcode" type="text" class="form-control" placeholder="" name="postal_code" v-model="company.postal_code">
                            <div class="input-group-append">
                              <div class="input-group-text"><i class="fa fa-shipping-fast"></i></div>
                            </div>
                          </div>
                          <small class="form-text text-danger" v-if="errors[0]">{{ errors[0] }}</small>
                        </div>
                      </ValidationProvider>
                    </div>
                    <!-- End Col 06 -->

                    <!-- Col 06 -->
                    <div class="col-sm-6">
                      <ValidationProvider mode="eager" name="都道府県" v-slot="{ errors }" rules="must_selected" slim>
                        <div class="form-group">
                          <label for="prefectu">都道府県</label>
                          <div class="input-group">
                            <select2 class="form-control basic-select select2" style="width: 100%;" name="prefecture_id" v-model="prefectureId">
                              <option value="" v-bind:selected="!prefectureId" disabled></option>
                              <option v-for="(item, key) in prefectures" v-bind:value="item.id" v-bind:key="key"
                                v-bind:selected="item.id == prefectureId">{{ item.name }}</option>
                            </select2>
                          </div>
                          <small class="form-text text-danger" v-if="errors[0]">{{ errors[0] }}</small>
                        </div>
                      </ValidationProvider>
                    </div>
                    <!-- End Col 06 -->
                  </div>
                  <!-- End Row -->

                  <!-- Row -->
                  <div class="row">
                    <!-- Col 06 -->
                    <div class="col-sm-6">
                      <ValidationProvider mode="eager" name="市区町村" v-slot="{ errors }" rules="required|max:100" slim>
                        <div class="form-group">
                          <label for="munici">市区町村</label>
                          <div class="input-group">
                            <input id="munici" type="text" class="form-control" placeholder="" name="city" v-model="company.city">
                            <div class="input-group-append">
                              <div class="input-group-text"><i class="fa fa-city"></i></div>
                            </div>
                          </div>
                          <small class="form-text text-danger" v-if="errors[0]">{{ errors[0] }}</small>
                        </div>
                      </ValidationProvider>
                    </div>
                    <!-- End Col 06 -->

                    <!-- Col 06 -->
                    <div class="col-sm-6">
                      <ValidationProvider mode="eager" name="番地・建物名" v-slot="{ errors }" rules="required|max:100" slim>
                        <div class="form-group">
                          <label for="addbuil">番地・建物名</label>
                          <div class="input-group">
                            <input id="addbuil" type="text" class="form-control" placeholder="" name="town" v-model="company.town">
                            <div class="input-group-append">
                              <div class="input-group-text"><i class="fa fa-map-marker-alt"></i></div>
                            </div>
                          </div>
                          <small class="form-text text-danger" v-if="errors[0]">{{ errors[0] }}</small>
                        </div>
                      </ValidationProvider>
                    </div>
                    <!-- End Col 06 -->
                  </div>
                  <!-- End Row -->

                  <!-- Row -->
                  <div class="row">
                    <!-- Col 06 -->
                    <div class="col-sm-6">
                      <ValidationProvider ref="validate-founded-date" mode="eager" name="設立年月" v-slot="{ errors }" rules="must_selected|date_format|date" slim>
                        <div class="form-group">
                          <label for="founded_date">設立年月</label>
                          <div class="input-group date" id="founded_date1" data-target-input="nearest" ref="founded_date">
                            <date-picker v-model="company.founded_date" name="founded_date" :config="datepickerConfig" ref="date-picker-founded-date" :placeholder="'YYYY/MM/DD'" @dp-change="validateDateCalendar('validate-founded-date')"></date-picker>
                            <div class="input-group-append" data-target="#founded_date1" data-toggle="datetimepicker2" v-on:click="$refs['date-picker-founded-date'].dp.show()">
                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                          </div>
                          <small class="form-text text-danger" v-if="errors[0]">{{ errors[0] }}</small>
                        </div>
                      </ValidationProvider>
                    </div>
                    <!-- End Col 06 -->

                    <!-- Col 06 -->
                    <div class="col-sm-6">
                      <ValidationProvider mode="eager" name="資本金" v-slot="{ errors }" rules="required|max:200" slim>
                        <div class="form-group">
                          <label for="capit">資本金 </label>
                          <div class="input-group">
                            <input id="capit" type="text" class="form-control" placeholder="" name="capital" v-model="company.capital">
                            <div class="input-group-append">
                              <div class="input-group-text"><i class="fa fa-torii-gate"></i></div>
                            </div>
                          </div>
                          <small class="form-text text-danger" v-if="errors[0]">{{ errors[0] }}</small>
                        </div>
                      </ValidationProvider>
                    </div>
                    <!-- End Col 06 -->
                  </div>
                  <!-- End Row -->

                  <!-- Row -->
                  <div class="row">
                    <!-- Col 06 -->
                    <div class="col-sm-6">
                      <ValidationProvider mode="eager" name="従業員数" v-slot="{ errors }" rules="required|numeric" slim>
                        <div class="form-group">
                          <label for="eestayea">従業員数</label>
                          <div class="input-group">
                            <input id="eestayea" type="text" class="form-control" placeholder="" name="number_of_employees" v-model="company.number_of_employees">
                            <div class="input-group-append">
                              <div class="input-group-text"><i class="fa fa-torah"></i></div>
                            </div>
                          </div>
                          <small class="form-text text-danger" v-if="errors[0]">{{ errors[0] }}</small>
                        </div>
                      </ValidationProvider>
                    </div>
                    <!-- End Col 06 -->

                    <!-- Col 06 -->
                    <div class="col-sm-6">
                      <ValidationProvider mode="eager" name="売上高" v-slot="{ errors }" rules="required||max:200" slim>
                        <div class="form-group">
                          <label for="amfals">売上高</label>
                          <div class="input-group">
                            <input id="amfals" type="text" class="form-control" placeholder="" name="sales" v-model="company.sales">
                            <div class="input-group-append">
                              <div class="input-group-text"><i class="fa fa-project-diagram"></i></div>
                            </div>
                          </div>
                          <small class="form-text text-danger" v-if="errors[0]">{{ errors[0] }}</small>
                        </div>
                      </ValidationProvider>
                    </div>
                    <!-- End Col 06 -->
                  </div>
                  <!-- End Row -->

                  <!-- Row -->
                  <div class="row">
                    <!-- Col 12 -->
                    <div class="col-12">
                      <ValidationProvider mode="eager" name="自社紹介" v-slot="{ errors }" rules="required|max:400" slim>
                        <div class="form-group">
                          <label for="compintro">自社紹介 <i class="fa fa-university"></i></label>
                          <textarea v-model="company.company_introduction" name="company_introduction" class="form-control" id="compintro" rows="7" placeholder=""></textarea>
                          <small class="form-text text-danger" v-if="errors[0]">{{ errors[0] }}</small>
                        </div>
                      </ValidationProvider>
                    </div>
                    <!-- End Col 12 -->
                  </div>
                  <!-- End Row -->


                </div>
                <!-- /.card-body -->
              </div>
              <!-- End General Form -->
              <div class="custom_btn text-center">
                <button type="button" class="btn blue-btn" @click="beforeChange">編集を保存</button>
                <button type="button" class="btn trans-btn" @click="resetForm">リセット</button>
              </div>
            </ValidationObserver>
          </form>
        </div>
        <!-- End Tab 02: Edit Tab -->

        <!-- Tab 03: Note Tab -->
        <div class="tab-pane" id="note" role="tabpanel" aria-labelledby="note-tab">
          <v-alert v-if="page_alert" ref="page-alert-memo-update" :type="page_alert.type" :messages="page_alert.message" dismissible autofade :delay="500000"></v-alert>
          <!-- Form -->
          <form class="user-data-frm" role="form" ref="edit-admin-memo-frm">
            <!-- Card Content -->
            <div class="card">
              <div class="card-body">
                <div class="form-group">
                  <textarea v-model="company.admin_memo" class="form-control" name="admin_memo" id="noteform" rows="5" placeholder=""></textarea>
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
        <!-- End Tab 03: Note Tab -->

      </div>
      <!-- End Tab Content -->
    </div>
  </div>
  <!-- /.row -->
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import select2 from "../Select2";
import moment from 'moment';
import datePicker from 'vue-bootstrap-datetimepicker';
import vAlert from '../Alert'
export default {
  data() {
    const dateFormat = 'YYYY/MM/DD';
    return {
      company: {
        prefecture: {
          id: null,
          name: null
        }
      },
      loading: false,
      dateFormat: dateFormat,
      error: '',
      datepickerConfig:{
        format: dateFormat,
        useCurrent: false,
        locale: 'ja',
      },
      created_at: '',
      founded_date: '',
      prefectures: [],
      prefectureId: null,
      page_alert: null,
      mode: '',
      current_memo_admin: '',
      register_status: [
        {id: 1, name: 'アクティブ'},
        {id: 0, name: '未確定'},
        {id: 2, name: '禁止'},
      ],
      status_corp: [
        {id: 0, name: 'OFF'},
        {id: 1, name: 'ON'},
      ],
      on_off: null,
    };
  },
  computed: {
    ...mapGetters(["errors"]),
    ...mapGetters("admin", ["isLogin", "adminData"])
  },
  methods: {
    init() {
      let self = this;
      self.mode = self.$route.query.mode ? self.$route.query.mode : 'view';
      axios.get("administrator/company/" + self.$route.params.id)
      .then(
        res => {
          self.company = res.data.company_data.payload;
          self.created_at = self.moment(self.company.created_at).format(self.dateFormat);
          self.founded_date = self.moment(self.company.founded_date).format(self.dateFormat);
          self.prefectures = res.data.prefectures;
          self.prefectureId = (self.company.prefecture) ? self.company.prefecture.id : null;
          self.current_memo_admin = self.company.admin_memo;
        },
        error => {
          self.error = error;
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
    validateDateCalendar(key) {
      switch (key) {
        case 'validate-created-date':
          this.$refs['validate-created-date'].validate();
          break;
        case 'validate-founded-date':
          this.$refs['validate-founded-date'].validate();
          break;
      }
    },
    getInfoByZipCode(value) {
      if (value !== '') {
        let self = this;
        axios.get("companies/info/postal-code/" + value, {}).then(response => {
          if (response.data.prefecture) {
            self.prefectureId = response.data.prefecture.id;
          }
          if (response.data.city) {
            self.company.city = response.data.city;
          }
        });
      }
    },
    async beforeChange() {
      let self = this;
      const valid = await self.$refs.observer.validate();
      if (valid) {
        self.showDialogConfirm();
      } else {
        self.scrollToError();
      }
    },
    showDialogConfirm() {
      const params = {
        title: "確認",
        text: "更新しますか？",
        onConfirm: () => {
          return this.changeCompanyInfo();
        }
      };
      this.$modal.dialogConfirmCompany(params);
    },
    changeCompanyInfo() {
      let self = this;
      self.page_alert = null;
      const formData = new FormData(self.$refs["company-detail-form"]);
      var dataForm = {};
      for (var entrie of formData.entries()) {
        dataForm[entrie[0]] = entrie[1];
      }
      let data = dataForm;
      axios.post("administrator/company/update/" + self.$route.params.id, data).then(
        response => {
          if ('success' === response.data.status) {
            self.company = response.data.payload;
            self.company.created_at = self.moment(self.company.created_at).format(self.dateFormat);
            self.page_alert = {
              type: 'success',
              message: self.trans.get("messages.M120")
            };
          }
          if ('error' === response.data.status) {
            self.page_alert = {
              type: 'danger',
              message: response.data.messages
            };
          }
        },
        error => {
          self.page_alert = {
            type: "danger",
            message: self.errors
          };
        },
      );
    },
    resetForm() {
      this.init();
    },
    showDialogConfirmMemo() {
      const params = {
        title: "確認",
        text: "更新しますか？",
        onConfirm: () => {
          return this.changeMemoAdmin();
        }
      };
      this.$modal.dialogConfirmCompany(params);
    },
    changeMemoAdmin() {
      let self = this;
      self.page_alert = null;
      const formData = new FormData(self.$refs["edit-admin-memo-frm"]);
      var dataForm = {};
      for (var entrie of formData.entries()) {
        dataForm[entrie[0]] = entrie[1];
      }
      let data = dataForm;
      axios.post("administrator/company/update/" + self.$route.params.id, data).then(
        response => {
          if ('success' === response.data.status) {
            self.company.admin_memo = response.data.payload.admin_memo;
            self.current_memo_admin = self.company.admin_memo;
            self.page_alert = {
              type: 'success',
              message: self.trans.get("messages.M120")
            };
          }
          if ('error' === response.data.status) {
            self.page_alert = {
              type: 'danger',
              message: response.data.messages
            };
          }
        },
        error => {
          self.page_alert = {
            type: "danger",
            message: self.errors
          };
        },
      );
    },
    clearAlert() {
      this.page_alert = null;
    },
    resetMemoForm() {
      this.company.admin_memo = this.current_memo_admin;
    },
    scrollToError() {
      const firstError = $("small.form-text.text-danger").first().closest('div');
      this.$_scrollTo(firstError);
    },
  },
  created() {
    this.init();
  },
  mounted() {
    this.$store.commit("setErrors", {});
  },
  components: {
    select2,
    datePicker,
    vAlert
  },
};
</script>
