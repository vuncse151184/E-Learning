<template>
  <div class="form-group col-md-12 mb-4">
    <label :for="name" class="mb-0">{{ label }}</label>
    <div class="cover-photo-contact">
      <div class="upload-file">
        <div class="custom-file">
          <input type="file" :id="name" :name="name" class="custom-file-input" /> <label class="custom-file-label bg-blue-light">{{ buttonText }}</label>
        </div>
        <span class="ml-4 text-underline">C:\fake_path\file_name_3</span>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    name: {
      type: String
    },
    label: {
      type: String
    },
    buttonText: {
      type: String,
      default: "ファイルを選択"
    }
  },
  data: function() {
    return {
      myFiles: [] // a container for the files in our field
    };
  },
};
</script>

<style></style>
