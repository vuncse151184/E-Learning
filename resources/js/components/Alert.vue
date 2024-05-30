<template>
  <div>
    <div :class="'alert alert-' + type + (dismissible ? ' alert-dismissible' : '')" v-if="Object.keys(data_messages).length == 1">
      <strong v-if="title">{{ title }}</strong>
      {{ Object.keys(data_messages).length && type == "danger" ? data_messages[Object.keys(data_messages)[0]][0] : data_messages[0] }}
      <button v-if="dismissible" type="button" class="close" @click="remove">&times;</button>
    </div>
    <div :class="'alert alert-' + type + (dismissible ? ' alert-dismissible' : '')" v-else>
      <ul>
        <li style="text-align:left" v-for="(message, key) in data_messages" :key="key">
          <strong>{{ key }}</strong> {{ message[0] }}
        </li>
      </ul>
      <button v-if="dismissible" type="button" class="close" @click="remove">&times;</button>
    </div>
  </div>
</template>
<script>
export default {
  Type : Object.freeze({  Success: "success", Info: "info", Primary: "primary", Secondary: "secondary", 
                          Dark: "dark", Light: "light", Warn: "warning", Danger: "danger" }),
  props: {
    type: {
      validator: function(value) {
        // The value must match one of these types
        let allow_types = ["success", "info", "primary", "secondary", "dark", "light", "warning", "danger"];
        return allow_types.indexOf(value) !== -1;
      },
      required: true
    },
    title: {
      type: String,
      required: false
    },
    messages: {
      type: [String, Array, Object],
      required: true
    },
    dismissible: {
      type: Boolean,
      required: false,
      default: false
    },
    autoscroll: {
      type: Boolean,
      required: false,
      default: false
    },
    autofade: {
      type: Boolean,
      required: false,
      default: false
    },
    delay: {
      type: Number,
      required: false,
      default: 10000
    }
  },
  data() {
    return {
      data_messages: []
    };
  },
  mounted() {
    this.data_messages = this.messages;
    if (typeof this.messages != "object") {
      this.data_messages = [this.messages];
    }
    if (this.autofade) {
      let _this = this;
      $(this.$el)
        .fadeTo(this.delay, 500)
        .slideUp(500, function() {
          _this.remove();
        });
    }
    if (this.autoscroll) this.scroll();
  },
  methods: {
    scroll() {
      const location = $(this.$el).offset().top - $("nav").first()[0].offsetHeight;
      $("html").animate(
        {
          scrollTop: location
        },
        500
      );
    },
    remove() {
      $(this.$el).hide();
    }
  }
};
</script>
