<template>
  <div class="container">
    <div class="mrt-title">
      <h2 class="h6 text-blue mb-3 font-weight-bold" v-if="seminal_video && seminal_video.data">セミナー動画</h2>
      <ul class="pl-0 mb-4">
        <li v-for="archive_video in seminal_video_archive" v-if="seminal_video_archive">
          <a href="javascript:void(0)"><span @click="handleGetArchive(archive_video.post_year, archive_video.post_month)">{{ archive_video.post_year }}年{{ archive_video.post_month }}月</span></a>
        </li>
      </ul>
    </div>
    <div class="row">
      <div class="col-sm-6 col-lg-4" v-for="video in seminal_video.data" v-if="seminal_video">
        <div class="mtr-cutom bg-light mb-4">
          <p>
            <a href="javascript:void(0)" v-on:click.prevent="handleUrl('page.useful.content.detail', {post_id: video.ID, post_type: 'video'})">
              <img :src="video.post_thumbnail" :alt="video.post_title" class="w-100">
            </a>
          </p>
          <p class="px-3 py-2">
            <a href="javascript:void(0)" v-on:click.prevent="handleUrl('page.useful.content.detail', {post_id: video.ID, post_type: 'video'})" v-html="video.post_title"></a>>
          </p>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12 text-center mt-4">
        <Pagination v-model="options.page" :page-count="options.page_count" @change="pageChangeHandler" v-if="seminal_video && seminal_video.data && seminal_video.last_page > 1"/>
      </div>
    </div>
  </div>
</template>
<script>
  import {mapGetters, mapActions} from "vuex";
  import Pagination from "../../Pagination";
  export default {
    components: {
      Pagination
    },
    data() {
      return {
        user: null,
        isLogin: false,
        options: {
          data_type: 'video',
          page: 1,
          page_count: 1,
          archive_year: 0,
          archive_month: 0,
          archive: false
        },
        seminal_video: {},
        seminal_video_archive: {},
      };
    },
    computed: {
      ...mapGetters(["errors"]),
      ...mapGetters("user", ["userData"])
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
      ...mapActions("pages", ["getUserContentDocument"]),
      loadUserContent() {
        let params = "?page=" + this.options.page + "&data_type=" + this.options.data_type + "&archive="+ this.options.archive + "&year="+ this.options.archive_year + "&month="+ this.options.archive_month;
        let _self = this;
        _self.getUserContentDocument(params).then(response => {
          _self.seminal_video = response.data.video;
          _self.seminal_video_archive = response.data.video_archive;
          _self.options.page_count = response.data.video.last_page;

        });
      },
      pageChangeHandler() {
        this.loadUserContent();
      },
      handleGetArchive(post_year, post_month) {
        this.options.page = 1;
        this.options.archive_year = post_year;
        this.options.archive_month = post_month;
        this.options.archive = true;
        this.loadUserContent();
      },
      async handleUrl (name, params) {
        this.$router.push({name: name, params: params});
      },
    }
  };
</script>
