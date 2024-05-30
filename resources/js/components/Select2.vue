<script>
require("select2");
export default {
  name: "select2",
  props: ["configs", "value"],
  template: `<select><slot></slot></select>`,
  mounted: function() {
    var vm = this;
    $(this.$el)
      // init select2
      .select2(this.configs)
      .val(this.value)
      .trigger("change")
      // emit event on change.
      .on("select2:select", function(e) {
        vm.$emit("change", e);
      })
      .on("select2:select", function(e) {
        vm.$emit("input", this.value);
      })
      .on("select2:select", function(e) {
        vm.$emit("update", e);
      });
  },
  watch: {
    value: function(value) {
      // update value
      $(this.$el)
        .val(value)
        .trigger("change");
    },
    options: function(options) {
      // update options
      $(this.$el)
        .empty()
        .select2({ data: options });
    }
  },
  destroyed: function() {
    $(this.$el)
      .off()
      .select2("destroy");
  }
};
</script>
