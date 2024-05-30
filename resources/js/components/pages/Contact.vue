<template>
  <div>
    <!--=================================
    Form register -->
    <section class="space-ptb pt-5 mb-5">
      <div class="container">
        <div class="">
          <div class="col-lg-10 m-auto">
            <div class="section-title-02 custom-contact-title">
              <h2 class="text-center text-blue">お問い合わせ</h2>             
            </div>
          </div>
        </div>
        <div class="container">
          <v-alert v-if="page_alert" ref="page-alert" :type="page_alert.type" :messages="page_alert.message" autoscroll dismissible autofade :delay="500000"></v-alert>
          <form action="" method="post" id="form-register" class="custom-form-contact" ref="contact-form">
            <ValidationObserver ref="observer">
              <!-- Form group -->
              <div class="form-group pb-3 align-items-center">
                <ValidationProvider mode="lazy" name="お名前" v-slot="{ errors }" rules="required" slim>
                  <div class="row">
                    <label for="name" class="col-sm-4 col-lg-3 col-form-label">
                      お名前
                      <span class="badge badge-danger ml-3">必須</span>
                    </label>
                    <div class="col-sm-8 col-lg-9">
                      <input id="name" name="name" v-model="name" type="text" class="form-control gray-border" required>
                    </div>
                    <small class="col-sm-8 col-lg-9 offset-lg-3 offset-sm-4 form-text text-danger" v-if="errors[0]">{{ errors[0] }}</small>
                  </div>
                </ValidationProvider>
              </div>
              <!-- End Form group -->

              <!-- Form group -->
              <div class="form-group pb-3">
                <ValidationProvider mode="lazy" name="ふりがな" v-slot="{ errors }" rules="required|furigana" slim>
                  <div class="row">
                    <label for="furigana" class="col-sm-4 col-lg-3 col-form-label">
                      ふりがな
                      <span class="badge badge-danger ml-3">必須</span>
                    </label>
                    <div class="col-sm-8 col-lg-9">
                      <input id="furigana" name="furigana" v-model="furigana" type="text" class="form-control gray-border" required>
                    </div>
                    <small class="col-sm-8 col-lg-9 offset-lg-3 offset-sm-4 form-text text-danger" v-if="errors[0]">{{ errors[0] }}</small>
                  </div>
                </ValidationProvider>
              </div>
              <!-- End Form group -->

              <!-- Form group -->
              <div class="form-group pb-3">
                <ValidationProvider mode="lazy" name="メールアドレス" v-slot="{ errors }" rules="required|email" vid="new_email" slim>
                  <div class="row">
                    <label for="email" class="col-sm-4 col-lg-3 col-form-label">
                      メールアドレス
                      <span class="badge badge-danger ml-3">必須</span>
                    </label>
                    <div class="col-sm-8 col-lg-9">
                      <input id="email" type="email" name="email" v-model="email" class="form-control gray-border" required>
                    </div>
                    <small class="col-sm-8 col-lg-9 offset-lg-3 offset-sm-4 form-text text-danger" v-if="errors[0]">{{ errors[0] }}</small>
                  </div>
                </ValidationProvider>
              </div>
              <!-- End Form group -->

              <!-- Form group -->
              <div class="form-group pb-3">
                <ValidationProvider mode="lazy" name="メールアドレス(確認)" v-slot="{ errors }" rules="required|confirmed:new_email" slim>
                  <div class="row">
                    <label for="confirm-email" class="col-sm-4 col-lg-3 col-form-label">
                      メールアドレス(確認)
                      <span class="badge badge-danger ml-3">必須</span>
                    </label>
                    <div class="col-sm-8 col-lg-9">
                      <input id="confirm-email" name="email_confirm" v-model="email_confirm" type="email" class="form-control gray-border" required>
                    </div>
                    <small class="col-sm-8 col-lg-9 offset-lg-3 offset-sm-4 form-text text-danger" v-if="errors[0]">{{ errors[0] }}</small>
                  </div>
                </ValidationProvider>
              </div>
              <!-- End Form group -->

              <!-- Form group -->
              <div class="form-group pb-3">
                <ValidationProvider mode="lazy" name="電話番号" v-slot="{ errors }" rules="required|phone_number" slim>
                  <div class="row">
                    <label for="phone" class="col-sm-4 col-lg-3 col-form-label">
                      電話番号
                      <span class="badge badge-danger ml-3">必須</span>
                    </label>
                    <div class="col-sm-8 col-lg-9">
                      <input id="phone" type="text" name="phone_number" v-model="phone_number" class="form-control gray-border" required>
                    </div>
                    <small class="col-sm-8 col-lg-9 offset-lg-3 offset-sm-4 form-text text-danger" v-if="errors[0]">{{ errors[0] }}</small>
                  </div>
                </ValidationProvider>
              </div>
              <!-- End Form group -->

              <!-- Form group -->
              <div class="form-group">
                <ValidationProvider mode="lazy" name="ご要望・ご質問等" v-slot="{ errors }" rules="required" slim>
                  <div class="row">
                    <label for="note" class="col-sm-4 col-lg-3 col-form-label">
                      ご要望・ご質問等
                      <span class="badge badge-danger ml-3">必須</span>
                    </label>
                    <div class="col-sm-8 col-lg-9">
                      <div class="form-group">
                        <textarea id="note" class="form-control gray-border" name="request_question" v-model="request_question" rows="9"></textarea>
                      </div>
                    </div>
                    <small class="col-sm-8 col-lg-9 offset-lg-3 offset-sm-4 form-text text-danger" v-if="errors[0]">{{ errors[0] }}</small>
                  </div>
                </ValidationProvider>
              </div>
                <!-- End Form group -->

              <div class="col-12 text-center mt-4">
                <p class="mt-1">※ <a class="handling-link" href="/handling-of-personal-information" target="_blank" title="個人情報取り扱い">個人情報取り扱い</a>、<a class="handling-link" href="/terms-of-service" target="_blank">利用規約</a>について同意の上、送信内容を確認してください。</p>
                <button type="button" class="btn blue-btn blue-border rounded contact-btn-submit" @click="beforeSend">入力内容を送信する</button>
              </div>
            </ValidationObserver>
          </form>
        </div>
      </div>
    </section>
    <!--=================================
    Form register -->
    <DialogConfirm />
  </div>
</template>
<script>
import { mapGetters, mapActions } from "vuex";
import vAlert from '../Alert'
export default {
  data() {
    return {
      name: '',
      furigana: '',
      email: '',
      email_confirm: '',
      phone_number: '',
      request_question: '',
      page_alert: null,
    };
  },
  computed: {
    ...mapGetters(["settings"]),
    ...mapGetters("user", ["isLogin"]),
    ...mapGetters(["errors"]),
  },
  methods: {
    async beforeSend() {
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
        text: "入力内容を送信しますか？",
        onConfirm: () => {
          return this.sendContactInformation();
        }
      };
      this.$modal.dialogConfirm(params);
    },
    sendContactInformation() {
      let self = this;
      self.page_alert = null;

      const formData = new FormData(self.$refs["contact-form"]);
      var dataForm = {};
      for (var entrie of formData.entries()) {
        dataForm[entrie[0]] = entrie[1];
      }

      let data = dataForm;
      axios.post("send-contact", data).then(response => {
        if ('success' === response.data.status) {
          self.page_alert = {
            type: 'success',
            message: response.data.messages
          };
          self.clearForm();
        }

        if ('error' === response.data.status) {
          self.page_alert = {
            type: 'danger',
            message: response.data.messages
          };
        }
      });
    },
    clearForm() {
      this.name = '';
      this.furigana = '';
      this.email = '';
      this.email_confirm = '';
      this.phone_number = '';
      this.request_question = '';
      this.$refs.observer.reset();
    },
    scrollToError() {
      const firstError = $("small.form-text.text-danger").first().closest('div');
      if (firstError) {
        this.$_scrollTo(firstError);
      }
    },
  },
  components: {
    vAlert
  }
};
</script>
