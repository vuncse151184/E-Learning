<template>
  <section class="job-lst-cont">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="section-title-02 mb-4">
            <h4>履歴書・職務経歴書</h4>
          </div>
          <div>
            <!-- Form -->
            <ValidationObserver ref="observer" tag="form" class="mt-4" v-slot="{ handleSubmit }">
              <!-- Form Block -->
              <div class="form-row mb-5 frm-dashboard-block resum-registration">
                <!-- Form group -->
                <div class="form-group col-md-12 mb-4">
                  <label class="mb-2 upload-title" for="school">履歴書 <span>※ファイルのみ : .doc, .docx, .xls, .xlsx, *.pdf (2MB以下)</span></label>
                  <div class="cover-photo-contact">
                    <div class="upload-file upload-file-url">
                      <div class="custom-file">
                        <input type="file" id="resume" name="resume" class="custom-file-input" v-on:change="resumeInputChange($event)" />
                        <label class="custom-file-label bg-blue-light">ファイルを選択</label>
                      </div>
                      <span class="text-underline" v-if="resume_name">{{ resume_name }}</span>
                      <Download :file="download[0].file" :button-text="download[0].buttonText" v-else-if="(resume_name && uploadFinished) || download[0].file" />
                    </div>
                    <small class="form-text text-error" v-if="errors && errors.resume && errors.resume.length">{{ errors.resume[0] }}</small>
                    <small class="form-text text-error" v-else-if="form.errors && form.errors.resume">{{ form.errors.resume }}</small>
                  </div>
                </div>
                <!-- End Form group -->

                <!-- Form group -->

                <div class="form-group col-md-12 mb-2">
                  <label class="mb-2 upload-title" for="school">職務経歴書 <span>※ファイルのみ : .doc, .docx, .xls, .xlsx, *.pdf (2MB以下)</span></label>
                  <div class="cover-photo-contact">
                    <div class="upload-file upload-file-url">
                      <div class="custom-file">
                        <input type="file" id="curriculum_vitae" name="curriculum_vitae" class="custom-file-input" v-on:change="curriculumVitaeInputChange" />
                        <label class="custom-file-label bg-blue-light">ファイルを選択</label>
                      </div>
                      <span class="text-underline" v-if="curriculum_vitae_name">{{ curriculum_vitae_name }}</span>
                      <Download :file="download[1].file" :button-text="download[1].buttonText" v-else-if="(curriculum_vitae_name && uploadFinished) || download[1].file" />
                    </div>
                    <small class="form-text text-error" v-if="errors && errors.curriculum_vitae && errors.curriculum_vitae.length">{{ errors.curriculum_vitae[0] }}</small>
                    <small class="form-text text-error" v-else-if="form.errors && form.errors.curriculum_vitae">{{ form.errors.curriculum_vitae }}</small>
                  </div>
                </div>

                <!-- End Form group -->
              </div>
              <!-- End Form Block -->

              <div class="col-md-12 my-5 mx-auto text-center">
                <button type="button" class="btn yellow-btn btn-lg" @click.once="handleSubmit(uploadFiles)" :key="buttonKey">上記内容で登録する</button>
              </div>
            </ValidationObserver>
            <!-- End Form -->
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
<script>
import { mapGetters, mapActions } from "vuex";
import Attach from "../Attach";
import Download from "../Download";
export default {
  components: {
    Attach,
    Download
  },
  data: function() {
    return {
      resume: "",
      curriculum_vitae: "",
      resume_name: "",
      curriculum_vitae_name: "",
      buttonKey: 1,
      uploadFinished: false,
      download: [
        { file: "", buttonText: "" },
        { file: "", buttonText: "" }
      ],
      form: {
        errors: {
          resume: null,
          curriculum_vitae: null
        }
      }
    };
  },

  created() {
    this.$store.commit("setTemplates", { footerFixed: true, menu_title: document.title });
  },
  computed: {
    ...mapGetters(["errors"]),
    ...mapGetters("user", ["isLogin", "userData"])
  },
  mounted() {
    this.$store.commit("setErrors", {});
    if (this.userData.resume_src || this.userData.curriculum_vitae_src) {
      this.download[0].file = this.userData.resume_src;
      this.download[0].buttonText = this.userData.resume;
      this.download[1].file = this.userData.curriculum_vitae_src;
      this.download[1].buttonText = this.userData.curriculum_vitae;
    }
  },
  methods: {
    ...mapActions("user", ["sendUpdateUserData"]),
    resumeInputChange: async function(event) {
      var resume_file = document.getElementById("resume");
      if (resume_file.files[0]) {
        this.resume = resume_file.files[0];
        this.form.errors.resume = this.checkValid(this.resume);
        this.resume_name = resume_file.value;
      }
    },
    curriculumVitaeInputChange: function(event) {
      var curriculum_vitae_file = document.getElementById("curriculum_vitae");
      if (curriculum_vitae_file.files[0]) {
        this.curriculum_vitae = curriculum_vitae_file.files[0];
        this.form.errors.curriculum_vitae = this.checkValid(this.curriculum_vitae);
        this.curriculum_vitae_name = curriculum_vitae_file.value;
      }
    },
    checkValid(file) {
      var ext = file.name.split(".").pop();
      if (!(ext == "pdf" || ext == "docx" || ext == "doc" || ext == "xls" || ext == "xlsx")) {
        return Vue.prototype.trans.get("messages.M116");
      } else if (file.size / 1024 / 1024 > 2) {
        return Vue.prototype.trans.get("messages.M142");
      }
      return "";
    },
    async uploadFiles() {
      let _self = this;
      _self.$_loadingIcon("show");
      const formData = new FormData();
      formData.append("resume", _self.resume);
      formData.append("curriculum_vitae", _self.curriculum_vitae);
      formData.append("id", _self.userData.id); // ADD THIS LINE
      formData.append("_method", "POST"); // ADD THIS LINE
      const config = {
        headers: {
          "content-type": "multipart/form-data"
        }
      };
      axios
        .post("users/upload-files", formData, config)
        .then(function(res) {
          if (res.data.payload.resume) {
            _self.download[0].file = res.data.payload.resume_src;
            _self.download[0].buttonText = res.data.payload.resume;
            _self.resume_name = "";
            if (_self.errors) _self.errors.resume = "";
          }
          if (res.data.payload.curriculum_vitae) {
            _self.download[1].file = res.data.payload.curriculum_vitae_src;
            _self.download[1].buttonText = res.data.payload.curriculum_vitae;
            _self.curriculum_vitae_name = "";
            if (_self.errors) _self.errors.curriculum_vitae = "";
          }
          _self.setTimeout();
          _self.uploadFinished = true;
          _self.sendUpdateUserData(res.data.payload);
        })
        .catch(function() {
          _self.uploadFinished = false;
          _self.setTimeout();
        });
    },
    async setTimeout(timer = 0) {
      return setTimeout(() => {
        this.buttonKey++;
        this.$_loadingIcon("hide");
      }, timer);
    }
  }
};
</script>
