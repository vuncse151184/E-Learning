<template>
  <img :src="image" v-bind:class="addClass" v-if="image" :style="{ 'max-height': height, 'max-width': width }" />
</template>

<script>
export default {
  props: {
    image: {
      type: String
    },
    addClass: {
      type: String,
      default: "img-fluid"
    },
    width: {
      type: String,
      default: "auto"
    },
    height: {
      type: String,
      default: "auto"
    }
  }
};
</script>
