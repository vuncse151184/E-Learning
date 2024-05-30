<template>
  <div class="row">
    <div class="col-12">
      <div v-if="showTabbar" class="tab_btn">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item">
            <!-- <a class="nav-link" id="checking-tab" data-toggle="tab" href="#checking" role="tab" aria-controls="checking" aria-selected="false">閲覧</a> -->
            <router-link :to="{ name: 'admin.job.view', params: { id: jobId } }" router-link-active class="nav-link" role="tab" aria-controls="checking">閲覧</router-link>
          </li>
          <li class="nav-item">
            <!-- <a class="nav-link active" id="edit-tab" data-toggle="tab" href="#edit" role="tab" aria-controls="edit" aria-selected="true">編集</a> -->
            <router-link :to="{ name: 'admin.job.edit', params: { id: jobId } }" router-link-active class="nav-link" role="tab" aria-controls="edit">編集</router-link>
          </li>
        </ul>
      </div>
      <router-view></router-view>
    </div>
  </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";

export default {
  data() {
    return {
      /** Constants */
      /** Variables */
    };
  },
  computed: {
    ...mapGetters("admin", ["cfgTabbar"]),
    ///
    jobId: function() {
      return this.cfgTabbar.jobId;
    },
    showTabbar: function() {
      return this.cfgTabbar.showTabbar;
    }
  }
};
</script>
