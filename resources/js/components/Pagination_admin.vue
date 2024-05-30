<template>
  <ul :class="paginationClasses.ul">
    <li v-if="paginationLabels.first" :class="`${paginationClasses.li} ${hasFirst ? paginationClasses.liDisable : ''}`" @click="first" v-html="paginationLabels.first"></li>

    <li v-if="paginationLabels.prev" :class="`${paginationClasses.li} ${hasFirst ? paginationClasses.liDisable : ''}`" @click="prev" v-html="paginationLabels.prev"></li>

    <li v-for="page in items" :key="page.label" :class="`${paginationClasses.li} ${page.active ? paginationClasses.liActive : ''} ${page.disable ? paginationClasses.liDisable : ''}`">
      <a v-if="page.disable" :class="`${paginationClasses.button} ${paginationClasses.buttonDisable}`">
        ...
      </a>
      <a v-else href="#!" @click="goto(page.label)" :class="`${paginationClasses.button} ${page.active ? paginationClasses.buttonActive : ''}`">{{ page.label }} </a>
      <a class="sr-only" v-if="page.active">(current)</a>
    </li>

    <li v-if="paginationLabels.next" :class="`${paginationClasses.li} ${hasLast ? paginationClasses.liDisable : ''}`" @click="next" v-html="paginationLabels.next"></li>

    <li v-if="paginationLabels.last" :class="`${paginationClasses.li} ${hasLast ? paginationClasses.liDisable : ''}`" @click="last" v-html="paginationLabels.last"></li>
  </ul>
</template>

<script>
const defaultClasses = {
  ul: "pagination justify-content-center mb-0",
  li: "page-item",
  liActive: "active",
  liDisable: "disable",
  button: "page-link",
  buttonActive: "active",
  buttonDisable: "disable"
};

const defaultLabels = {
  first: '<a class="page-link "><i class="fas fa-fast-backward"></i></a>',
  prev: '<a class="page-link b-radius-none"><i class="fas fa-angle-double-left"></i></a>',
  next: '<a class="page-link" href="#"><i class="fas fa-angle-double-right"></i></a>',
  last: '<a class="page-link" href="#"><i class="fas fa-fast-forward"></i></a>'
};

export default {
  props: ["ulClass", "value", "pageCount", "classes", "labels"],
  data() {
    return {
      paginationClasses: {
        ul: this.ulClass ? this.ulClass : defaultClasses.ul,
        li: "page-item",
        liActive: "active",
        liDisable: "disable",
        button: "page-link",
        buttonActive: "active",
        buttonDisable: "disable"
      },
      paginationLabels: {
        ...defaultLabels,
        ...this.labels
      }
    };
  },

  mounted() {
    if (this.value > this.pageCount) {
      this.$emit("input", this.pageCount);
    }
  },

  computed: {
    items() {
      let valPrev = this.value > 1 ? this.value - 1 : 1; // for easier navigation - gives one previous page
      let valNext = this.value < this.pageCount ? this.value + 1 : this.pageCount; // one next page
      let extraPrev = valPrev === 3 ? 2 : null;
      let extraNext = valNext === this.pageCount - 2 ? this.pageCount - 1 : null;
      let dotsBefore = valPrev > 3 ? 2 : null;
      let dotsAfter = valNext < this.pageCount - 2 ? this.pageCount - 1 : null;

      let output = [];

      for (let i = 1; i <= this.pageCount; i += 1) {
        if ([1, this.pageCount, this.value, valPrev, valNext, extraPrev, extraNext, dotsBefore, dotsAfter].includes(i)) {
          output.push({
            label: i,
            active: this.value === i,
            disable: [dotsBefore, dotsAfter].includes(i)
          });
        }
      }

      return output;
    },

    hasFirst() {
      return this.value === 1;
    },

    hasLast() {
      return this.value === this.pageCount;
    }
  },

  watch: {
    value: function() {
      this.$emit("change");
    }
  },

  methods: {
    first() {
      if (!this.hasFirst) {
        this.$emit("input", 1);
      }
    },

    prev() {
      if (!this.hasFirst) {
        this.$emit("input", this.value - 1);
      }
    },

    goto(page) {
      this.$emit("input", page);
    },

    next() {
      if (!this.hasLast) {
        this.$emit("input", this.value + 1);
      }
    },

    last() {
      if (!this.hasLast) {
        this.$emit("input", this.pageCount);
      }
    }
  }
};
</script>
