<template>
  <div>
    <div class="header-inner bg-light text-center header-inner-custom">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <h2 class="text-blue">お役立ちコンテンツ</h2>
            <ol class="breadcrumb mb-0 p-0">
              <li class="breadcrumb-item text-blue">お役立ち資料をご用意しております。ぜひ一度ご覧ください。</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <section class="py-5 mb-5 news-block">
      <div class="container">
        <ol class="breadcrumb h6">
          <li class="breadcrumb-item text-blue">
            <router-link :to="{name: 'user.useful-content'}" title="お役立ちコンテンツ" class="h6 text-blue" >お役立ちコンテンツ</router-link>
          </li>
          <li class="breadcrumb-item text-blue active">{{ handleGetTitleBreadcrumb }}</li>
        </ol>
        <div class="row justify-content-center text-dark pt-4 pb-2">
          <div class="col-xl-8 col-lg-10 col-md-12">
            <p class="h4 py-3 mx-2 font-weight-bold text-dark" v-html="post.post_title"></p>
          </div>
        </div>
        <hr>
        <div class="row justify-content-center">
          <div class="col-xl-8 col-lg-10 col-md-12">
            <p class="pt-3">
              <iframe v-if="post_type == 'video' && post.post_video && isLogin" width="100%" height="400" :src="post.post_video" frameborder="0" allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture" ></iframe>
              <a href="javascript:void(0)" v-on:click.prevent="handleShowLogin" title="video_img" v-if="post_type == 'video' && post.post_video && !isLogin">
                <img src="/assets/img/video_img.png" :alt="post.post_title" class="img-fluid">
              </a>
              <img v-if="post_type == 'download' && post.post_thumbnail" :src="post.post_thumbnail" :alt="post.post_title" class="img-fluid">
            </p>
            <div v-html="post.post_content"></div>
          </div>
          <div class="col-xl-8 col-lg-10 col-md-12 pt-4">
            <div class="row useful-custom-btn">
              <div class="col-6 mb-lg-0 mb-4" v-if="post_type == 'download' && post.post_document">
                <button class="btn blue-btn bg-blue-light btn-block text-white" v-if="!isLogin" v-on:click="handleShowLogin"><i class="fas fa-download mr-md-4"></i> ダウンロード</button>
                <a :href="handleGetLinkDownload(post.post_document)" v-if="isLogin" class="btn blue-btn bg-blue-light btn-block text-white"><i class="fas fa-download mr-md-4"></i>ダウンロード</a>
              </div>
              <div class="col-6 mb-lg-0 mb-4">
                <div class="blog-post-share btn white-btn btn-block social-btn-tooltip">
                  <div class="share-box">
                    <a href="#!"> <i class="fas fa-share-alt"></i><span class="pl-2">シェア</span></a>
                    <ul class="list-unstyled share-box-social">
                      <li><a href="javascript:void(0)" v-on:click.prevent="handleUrlShare('facebook')" title="facebook"><i class="fab fa-facebook-f"></i></a> </li>
                      <li><a href="javascript:void(0)"  v-on:click.prevent="handleUrlShare('tweet')" title="twitter"><i class="fab fa-twitter"></i></a> </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="feature-info-section pt-5">
      <div class="container pb-5">
        <div class="row">
          <div class="col-lg-6 mb-lg-0 mb-4">
            <div class="feature-info feature-info-02 p-4 p-lg-5 bg-blue">
              <div class="feature-info-icon mb-3 mb-sm-0 text-white">
                <i class="flaticon-manager"></i>
              </div>
              <div class="feature-info-content text-white pl-sm-4 pl-0 align-self-center ">
                <h5 class="text-white">DX人材の方はこちら</h5>
              </div>
              <a class="ml-auto align-self-center text-white" href="/register">今すぐ応募する <i class="fas fa-long-arrow-alt-right"></i> </a>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="feature-info feature-info-02 p-4 p-lg-5 bg-blue-light">
              <div class="feature-info-icon mb-3 mb-sm-0 text-white">
                <i class="flaticon-job-3"></i>
              </div>
              <div class="feature-info-content text-white pl-sm-4 pl-0 align-self-center ">
                <h5 class="text-white">DX人材を探すの方はこちら</h5>
              </div>
              <a class="ml-auto align-self-center text-white" href="/company">求人を掲載 <i class="fas fa-long-arrow-alt-right"></i> </a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <footer-nav />
    <DialogLogin v-if="!isLogin" />
  </div>
</template>
<script>
  import {mapGetters, mapActions} from "vuex";
  import FooterNav from "../../layouts/inc/FooterNav";
  import DialogLogin from "../../../modals/DialogLogin";
  export default {
    components: {
      FooterNav,
      DialogLogin
    },
    data() {
      return {
        post: [],
        post_type: null,
        user: null,
        isLogin: false
      };
    },
    computed: {
      ...mapGetters(["errors"]),
    },
    created() {
      this.loadContentDetail();
      this.post_type = this.$route.params.post_type;
      this.$store.commit("setTemplates", {breadcrumb: false, footerFixed: false, menu_title: document.title});
      this.user = this.$store.state.user;
      this.isLogin = this.$store.state.user.isLogin;
    },
    mounted() {
      this.$store.commit("setErrors", {});
      this.scrollToTop();
    },
    computed: {
      handleGetTitleBreadcrumb() {
        let post_type = this.$route.params.post_type;
        if (post_type == 'download') {
          return "資料ダウンロード";
        } else {
          return "セミナー動画";
        }
      },
    },
    methods: {
      ...mapActions("pages", ["getUserContentDetail"]),
      loadContentDetail() {
        let params = "/" + this.$route.params.post_id + "/" + this.$route.params.post_type;
        let _self = this;
        _self.getUserContentDetail(params).then(response => {
          _self.post = response.data;
          window.document.title = _self.post.post_title + " || PRIME DX";
        });
      },
      handleGetLinkDownload (file) {
          if(file) {
            return window.location.origin + "/api/get-document?file=" + file;
          } else {
            return null;  
          }
      },
      handleShowLogin () {
        let params = {
          title: "ログイン",
          redirecUrl: window.location.href
        };
        this.$modal.dialogLogin(params);
      },
      handleUrlShare(type) {
        switch (type) {
          case "facebook":
            window.open(
                'https://www.facebook.com/sharer/sharer.php?u='+encodeURIComponent(window.location.href),
                'facebook-share-dialog',
                'width=800,height=400');
            break;
          case "tweet" :
            window.open(
                'https://twitter.com/intent/tweet?text='+ this.post.post_title +'&url='+ encodeURIComponent(window.location.href),
                'sharer',
                'scrollbars=yes,width=800,height=400');
            break;
        }
      },
      scrollToTop() {
        window.scrollTo(0,0);
      }
    }
  }
</script>
