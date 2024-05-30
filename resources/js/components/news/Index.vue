<template>
  <section class="space-ptb pt-5 mb-5 news-block">
    <div class="container">
      <h2 class="text-center text-blue mb-5">お知らせ</h2>
      <div class="row justify-content-center">
        <div class="col-12">
          <dl>
            <dt>2020.11.13</dt>
            <dd>
              <a href="/news/201113"  title="PrimeDXをリリースしました。">PrimeDXをリリースしました。</a>
            </dd>
          </dl>
          <div class="text-right pt-5"><a href="/#news_block" class="btn white-btn blue-border rounded text-blue font-weight-normal"><span class="pl-2 pr-4">戻る</span><i class="fas fa-tasks"></i></a></div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  mounted() {
    this.$store.commit("setTemplates", { footerFixed: true });
  }
};
</script>