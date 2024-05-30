<template>
  <div class="container">
    <v-alert v-if="contact_alert" ref="page-alert" :type="contact_alert.type" :messages="contact_alert.message" autoscroll dismissible autofade ></v-alert>
    <ValidationObserver ref="contact-validation-observer" v-slot="{ handleSubmit }">
      <div class="section-title-02 custom-contact-title">
        <h2 class="text-center text-white fs-20">
          お問い合わせ 
        </h2>
      </div>
      <form action="" method="post" id="form-register" class="custom-form-contact">
        <!-- Form group -->
        <ValidationProvider mode="eager" name="お名前" v-slot="{ errors }" rules="required|max:100" slim>
          <div class="form-group pb-3 align-items-center">
            <div class="row">
              <label for="name" class="col-sm-4 col-lg-3 col-form-label">
                お名前 
                <span class="badge badge-danger ml-3">必須</span>
              </label>
              <div class="col-sm-8 col-lg-9">
                <input id="name" type="text" class="form-control gray-border" v-model="contact.name">
                <small class="form-text text-error" v-if="errors[0]">{{ errors[0] }}</small>
              </div>
            </div>
          </div>
        </ValidationProvider>
        <!-- End Form group -->

        <!-- Form group -->
        <ValidationProvider mode="eager" name="ふりがな" v-slot="{ errors }" rules="required|furigana|max:100" slim>
          <div class="form-group pb-3">
            <div class="row">
              <label for="furigana" class="col-sm-4 col-lg-3 col-form-label">
                ふりがな 
                <span class="badge badge-danger ml-3">必須</span>
              </label>
              <div class="col-sm-8 col-lg-9">
                <input id="furigana" type="text" class="form-control gray-border" v-model="contact.furigana">
                <small class="form-text text-error" v-if="errors[0]">{{ errors[0] }}</small>
              </div>
            </div>
          </div>
        </ValidationProvider>
        <!-- End Form group -->

        <!-- Form group -->
        <ValidationProvider mode="eager" name="メールアドレス" v-slot="{ errors }" rules="required|email" vid="email" slim>
          <div class="form-group pb-3">
            <div class="row">
              <label for="email" class="col-sm-4 col-lg-3 col-form-label">
                メールアドレス
                <span class="badge badge-danger ml-3">必須</span>
              </label>
              <div class="col-sm-8 col-lg-9">
                <input id="email" type="email" class="form-control gray-border" v-model="contact.email">
                <small class="form-text text-error" v-if="errors[0]">{{ errors[0] }}</small>
              </div>
            </div>
          </div>
        </ValidationProvider>
        <!-- End Form group -->

        <!-- Form group -->
        <ValidationProvider mode="eager" name="ルアドレス(確認)" v-slot="{ errors }" rules="required|email_confirmed:email" slim>
          <div class="form-group pb-3">
            <div class="row">
              <label for="confirm-email" class="col-sm-4 col-lg-3 col-form-label">
                メールアドレス(確認)
                <span class="badge badge-danger ml-3">必須</span>
              </label>
              <div class="col-sm-8 col-lg-9">
                <input id="confirm-email" type="email" class="form-control gray-border" v-model="contact.email_confirmed">
                <small class="form-text text-error" v-if="errors[0]">{{ errors[0] }}</small>
              </div>
            </div>
          </div>
        </ValidationProvider>
        <!-- End Form group -->

        <!-- Form group -->
        <ValidationProvider mode="eager" name="電話番号" v-slot="{ errors }" rules="required|max:20|phone_number" slim>
          <div class="form-group pb-3">
            <div class="row">
              <label for="phone" class="col-sm-4 col-lg-3 col-form-label">
                電話番号
                <span class="badge badge-danger ml-3">必須</span>
              </label>
              <div class="col-sm-8 col-lg-9">
                <input id="phone" type="text" class="form-control gray-border" v-model="contact.phone">
                <small class="form-text text-error" v-if="errors[0]">{{ errors[0] }}</small>
              </div>
            </div>
          </div>
        </ValidationProvider>
        <!-- End Form group -->

        <!-- Form group -->
        <ValidationProvider mode="eager" name="要望・ご質問等" v-slot="{ errors }" rules="required" slim>
          <div class="form-group">
            <div class="row">
              <label for="note" class="col-sm-4 col-lg-3 col-form-label">
                ご要望・ご質問等
              </label>
              <div class="col-sm-8 col-lg-9">
                <div class="form-group">
                  <textarea id="note" class="form-control gray-border" name="" rows="9" v-model="contact.question"></textarea>
                  <small class="form-text text-error" v-if="errors[0]">{{ errors[0] }}</small>
                </div>
              </div>
            </div>
          </div>
        </ValidationProvider>
          <!-- End Form group -->

        <div class="col-12 text-center mt-4">
          <p class="text-white">※ <a class="handling-link text-white" href="/handling-of-personal-information" target="_blank" title="個人情報取り扱い">個人情報取り扱い</a> について同意の上、送信内容を確認してください。</p>
          <button type="button" @click="handleSubmit(onClickContact)" class="btn white-btn text-blue rounded contact-btn-submit">入力内容を送信する</button>
        </div>
      </form>
    </ValidationObserver>
    <ConfirmDialog/>
  </div>
</template>
<script>
import vAlert from "./../../Alert";
import ConfirmDialog from "./../../../modals/DialogConfirm";
export default {
  data() {
    return {
      contact: {
        name: '',
        furigana: '',
        email: '',
        email_confirmed: '',
        phone: '',
        question: '',
      },
      contact_alert: null,
    }
  },
  methods: {
    onClickContact() {
      const params = {
        title: this.trans.get('messages.M127'),
        text: this.trans.get('messages.M140'),
        onConfirm: () => {
          return this.handleContact();
        }
      };
      this.$modal.dialogConfirm(params);
    },
    async handleContact() {
      this.$_loadingIcon('show');
      await axios.post('company/contact', this.contact)
      .then(
        res => {
          this.contact_alert = {
            type: 'success',
            message: res.data
          };
          this.clearContactForm();
        },
        error => {
          this.contact_alert = null;
          this.$_loadingIcon('hide');
        }
      )
    },
    clearContactForm() {
      this.contact = {
        name: '',
        furigana: '',
        email: '',
        email_confirmed: '',
        phone: '',
        question: '',
      };
      this.$refs['contact-validation-observer'].reset();
      this.$_loadingIcon('hide');
    },
  },
  components: {
    vAlert,
    ConfirmDialog,
  }
};
</script>