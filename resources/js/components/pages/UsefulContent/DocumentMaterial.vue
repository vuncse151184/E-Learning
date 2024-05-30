<template>
  <div class="container">
    <div class="mrt-title">
      <h2 class="h6 text-blue mb-3 font-weight-bold" v-if="download_material && download_material.data">資料ダウンロード</h2>
      <ul class="pl-0 mb-4">
        <li v-for="archive in download_material_archive" v-if="download_material_archive">
          <a href="javascript:void(0)"><span @click="handleGetArchive(archive.post_year, archive.post_month)">{{ archive.post_year }}年  {{ archive.post_month }}月</span></a>
        </li>
      </ul>
    </div>
    <div class="row">
      <div class="col-sm-6 col-lg-4" v-for="download in download_material.data" v-if="download_material">
        <div class="mtr-cutom bg-light mb-4">
          <p>
            <a href="javascript:void(0)" v-on:click.prevent="handleUrl('page.useful.content.detail', {post_id: download.ID, post_type: 'download'})">
              <img :src="download.post_thumbnail" :alt="download.post_title" class="w-100">
            </a>
          </p>
          <p class="px-3 py-2">
            <a href="javascript:void(0)" v-on:click.prevent="handleUrl('page.useful.content.detail', {post_id: download.ID, post_type: 'download'})" v-html="download.post_title"></a>
          </p>
          <div class="px-3 pt-3 pb-2 d-inline-block w-100">
            <a :href="handleGetLinkDownload(download.post_document)" v-if="isLogin" class="btn blue-btn bg-blue-light text-white rounded font-weight-normal float-left" >
              ダウンロード
            </a>
            <button class="btn blue-btn bg-blue-light text-white rounded font-weight-normal float-left" v-if="!isLogin" v-on:click="handleShowLogin">ダウンロード</button>
            <a href="#!" class="text-blue h4 btn-social float-right">
              <i class="fas fa-share-alt"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12 text-center mt-4">
        <Pagination v-model="options.page" :page-count="options.page_count" @change="pageChangeHandler" v-if="download_material && download_material.data && download_material.last_page > 1" />
      </div>
    </div>
  </div>
</template>
<script>
  
  import {mapGetters, mapActions} from "vuex";
  import Pagination from "../../Pagination";
  export default {
    components: {
      Pagination,
    },
    data() {
      return {
        user: null,
        isLogin: false,
        options: {
          data_type: 'download',
          page: 1,
          page_count: 1,
          archive_year: 0,
          archive_month: 0,
          archive: false
        },
        download_material: {},
        download_material_archive: {},
      };
    },
    computed: {
      ...mapGetters(["errors"]),
    },
    created() {
      this.user = this.$store.state.user;
      this.isLogin = this.$store.state.user.isLogin;
      this.loadUserContent();
    },
    mounted() {
      this.$store.commit("setErrors", {});
    },
    methods: {
      ...mapActions("pages", ["getUserContentDocument", "getFileDownload"]),
      loadUserContent() {
        let params = "?page=" + this.options.page + "&data_type=" + this.options.data_type + "&archive="+ this.options.archive + "&year="+ this.options.archive_year + "&month="+ this.options.archive_month;
        let _self = this;
        _self.getUserContentDocument(params).then(response => {
            _self.download_material = response.data.download;
            _self.download_material_archive = response.data.download_archive;
            _self.options.page_count = response.data.download.last_page;
        });
      },
      pageChangeHandler () {
        this.loadUserContent();
      },
      handleGetArchive(post_year, post_month) {
        this.options.page = 1;
        this.options.archive_year = post_year;
        this.options.archive_month = post_month;
        this.options.archive = true;
        this.loadUserContent();
      },
      handleGetLinkDownload (file) {
        if(file) {
          return window.location.origin + "/api/get-document?file=" + file
        }
        return null;
      },
      handleShowLogin() {
        this.$emit('show-login');
      },
      async handleUrl (name, params) {
        this.$router.push({name: name, params: params});
      },
    }
  };
</script>
