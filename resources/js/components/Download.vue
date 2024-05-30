<template>
  <a :href="file" target="_blank">{{ buttonText }}</a>
</template>

<script>
export default {
  props: {
    file: {
      type: String,
      default: "http://"
    },
    fileTitle: {
      type: String,
      default: "resume"
    },
    buttonText: {
      type: String,
      default: "Download"
    }
  }
};
</script>

<style></style>
