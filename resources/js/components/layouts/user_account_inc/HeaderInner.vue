<template>
  <div class="header-inner bg-light header-inner-custom">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="jobber-user-info">
            <div class="profile-avatar">
              <avatar-thumbnail :image="user.logo_src" add-class="img-fluid" />
              <i @click="showUploadPopup" class="fas fa-pencil-alt"></i>
            </div>
            <div class="profile-avatar-info ml-4">
              <h3>{{ display_user }}</h3>
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade" id="exampleModalCenter" ref="exampleModalCenter" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header p-4 modal-white-bg">
              <h4 class="mb-0 text-center">写真をアップロード</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><i class="fas fa-times"></i></span>
              </button>
            </div>
            <div class="modal-body">
              <div class="text-center">
                <div class="tab-content">
                  <div class="tab-pane active" id="candidate" role="tabpanel">
                    <v-alert v-if="page_alert" ref="page-alert" :type="page_alert.type" :messages="page_alert.message" dismissible></v-alert>
                    <div class="upload-file">
                      <div class="custom-file m-0">
                        <input type="file" class="custom-file-input" name="logo" ref="img_file" id="add_file" @change="imageUploadChange($event)" />
                        <label class="custom-file-label" for="add_file">
                          <img src="/assets/img/upload-file.png" alt="" ref="preview_logo" style="width:100%" />
                          <span v-if="image_name">{{ image_name }}</span>
                        </label>
                      </div>
                    </div>
                    <p class="text-center">※PNG、JPEG、GIFのいずれかをご使用いただけます。<br />（推奨サイズ：縦200px、横200px以上）</p>
                    <form class="mt-4">
                      <div class="form-row justify-content-md-center">
                        <div class="col-md-6">
                          <a @click="uploadImage" class="btn blue-btn btn-block mb-3" href="javascript:void(0)" title="写真を登録">写真を登録</a>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import AvatarThumbnail from "../../Thumbnail";
import VAlert from "../../Alert";
export default {
  name: "HeaderInner",
  components: { AvatarThumbnail, VAlert },
  data() {
    return {
      user: {},
      display_user: "",
      image: "",
      image_name: "",
      page_alert: null
    };
  },
  computed: {
    ...mapGetters(["errors"]),
    ...mapGetters("user", ["userData"])
  },
  mounted() {
    this.user = this.userData;
    this.display_user = this.userData.name;
    this.$root.$on("setUserCompleteName", text => {
      this.display_user = text;
    });
  },
  methods: {
    showUploadPopup() {
      this.image = "";
      this.image_name = "";
      this.page_alert = null;
      this.$refs.preview_logo.src = "/assets/img/upload-file.png";
      $(this.$refs.exampleModalCenter).modal("show");
    },
    imageUploadChange(event) {
      let image_file = this.$refs.img_file.files[0];
      if (image_file) {
        this.$refs.preview_logo.src = URL.createObjectURL(image_file);
        this.image = image_file;
      }
    },
    uploadImage() {
      let _self = this;
      _self.page_alert = null;
      const formData = new FormData();
      formData.append("logo", _self.image);
      formData.append("id", _self.userData.id);
      formData.append("_upload", true);
      formData.append("_method", "POST"); // ADD THIS LINE
      const config = {
        headers: {
          "content-type": "multipart/form-data"
        }
      };
      if ("undefined" == typeof _self.image || "" === _self.image || null == _self.image) {
        return false;
      }
      axios.post("users/upload-private-image", formData, config).then(
        res => {
          _self.page_alert = {
            type: "success",
            message: _self.trans.get("messages.M120")
          };
          if (res.data && res.data.payload) {
            _self.$store.commit("user/setUserData", res.data.payload);
            _self.user = res.data.payload;
          }
        },
        error => {
          _self.page_alert = {
            type: "danger",
            message: _self.errors
          };
          _self.$refs.preview_logo.src = "/assets/img/upload-file.png";
        }
      );
    }
  }
};
</script>
