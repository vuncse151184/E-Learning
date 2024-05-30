<template>
  <div class="header-inner bg-blue text-center header-inner-custom">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <h2>{{ MenuTitle }}</h2>
          <ol class="breadcrumb mb-0 p-0">
            <li class="breadcrumb-item"><a href="/" title="ホーム">ホーム</a></li>
            <li class="breadcrumb-item active">
              <i class="fas fa-chevron-right"></i> <span> {{ MenuTitle }} </span>
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "HeaderInner",
  props: {
    MenuTitle: {
      type: String
    }
  }
};
</script>
