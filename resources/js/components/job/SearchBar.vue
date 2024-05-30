<template>
    <section class="header-inner header-inner-big bg-holder text-white" style="background-image: url(/assets/img/job-banner.png);">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="job-search-field">
              <div class="job-search-item">
                <form class="form row align-flex-end">
                  <div class="col-lg-3">
                    <label>職種</label>
                    <div class="form-group left-icon">
                      <select2 class="form-control basic-select" v-model="value.job_category">
                        <option value="" selected >お選びください</option>
                        <option v-for="(category, key) in options.job_category" :key="key" :value="category.id"
                          :selected="category.id == value.job_category">{{ category.name }}</option>
                      </select2>
                    <i class="fa fa-suitcase"></i> </div>
                  </div>
                  <div class="col-lg-3">
                    <label>働き方</label>
                    <div class="form-group left-icon">
                      <select2 class="form-control basic-select" v-model="value.work_style">
                        <option value="" selected >お選びください</option>
                        <option v-for="(style, key) in options.work_style" :key="key" :value="style.id"
                          :selected="style.id == value.work_style">{{ style.name }}</option>
                      </select2>
                    <i class="fa fa-clock" aria-hidden="true"></i> </div>
                  </div>
                  <div class="col-lg-4">
                    <label>フリーワード</label>
                    <div class="form-group left-icon">
                      <input type="text" class="form-control" name="job_title" v-model="value.keyword" placeholder="例：WEBプログラマー">
                    <i class="fas fa-search"></i> </div>
                  </div>
                  <div class="col-lg-2 col-sm-12" ref="search-button">
                    <div class="form-group form-action">
                      <a href="javascript:void(0) " class="btn yellow-btn mt-0 w-100">
                        <i class="fas fa-search-location"></i> 検索
                      </a>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
</template>
<script>
import select2 from "../Select2";
export default {
    props: {
        value: {
            type: Object,
            required: true
        },
    },
    data() {
      return {
        endpoint: 'job/search-options',
        options: {
          work_style: [],
          job_category: [],
        },
      }
    },
    created() {
      this.getSearchOptions();
    },
    mounted() {
      this.registerEvents();
    },
    methods: {
      async getSearchOptions() {
        await axios.get(this.endpoint)
        .then(
          res => {
            this.options = res.data;
          },
          error => { 
            console.log(errors.response.data)
          });
      },
      registerEvents() {
          let elems = $(this.$el).find('.form-control');
          elems.each((key, elem) => {
            $(elem).on("change", (...args) => {
                this.$emit("change", ...args);
            });
          });
          $(this.$refs['search-button'])
          .on("click", (...args) => {
            this.$emit("searchbar-click", ...args);
          });
      }
    },
    components: {
        select2,
    }
};
</script>