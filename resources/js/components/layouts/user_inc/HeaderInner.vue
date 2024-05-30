<template>
  <div class="header-inner bg-light text-center">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <h2 class="text-primary">ログイン</h2>
          <ol class="breadcrumb mb-0 p-0">
            <li class="breadcrumb-item">
              <router-link :to="{ name: 'home' }" title="ホーム">ホーム</router-link>
            </li>
            <li class="breadcrumb-item active">
              <i class="fas fa-chevron-right"></i> <span>{{ item_active }}</span>
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    sub: Boolean,
    sub_data: Object
  },
  name: "HeaderInner",
  data() {
    return {
      item_active: document.title
    };
  },
  mounted() {}
};
</script>
