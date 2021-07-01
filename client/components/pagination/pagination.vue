<template>
  <div>
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="mt-3 justify-content-center pagination_style1">
            <nav>
              <ul class="pagination">
                <li
                  :class="[
                    meta.current_page === 1 ? 'disabled' : '',
                    'page-item',
                  ]"
                >
                  <a
                    href="#"
                    class="page-link"
                    @click.prevent="switched(meta.current_page - 1)"
                    >&lsaquo;</a
                  >
                </li>
                <template v-if="section > 1">
                  <li
                    :class="[
                      meta.current_page === 1 ? 'active' : '',
                      'page-item',
                    ]"
                  >
                    <a href="#" class="page-link" @click.prevent="switched(1)"
                      >1</a
                    >
                  </li>

                  <li class="page-item">
                    <a
                      href="#"
                      class="page-link"
                      @click.prevent="goBackwardASection"
                      >...</a
                    >
                  </li>
                </template>

                <li
                  v-for="(page, index) in pages"
                  :key="index"
                  :class="[
                    meta.current_page === page ? 'active' : '',
                    'page-item',
                  ]"
                >
                  <a
                    class="page-link"
                    href="#"
                    @click.prevent="switched(page)"
                    >{{ page }}</a
                  >
                </li>

                <template v-if="section < sections">
                  <li class="page-item">
                    <a
                      href="#"
                      class="page-link"
                      @click.prevent="goForwardASection"
                      >...</a
                    >
                  </li>
                  <li class="page-item">
                    <a
                      class="page-link"
                      href="#"
                      rel="next"
                      @click.prevent="switched(meta.last_page)"
                      >{{ meta.last_page }}</a
                    >
                  </li>
                </template>
                <li
                  :class="[
                    meta.current_page === meta.last_page ? 'disabled' : '',
                    'page-item',
                  ]"
                >
                  <a
                    href="#"
                    class="page-link"
                    @click.prevent="switched(meta.current_page + 1)"
                    >&rsaquo;</a
                  >
                </li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    // eslint-disable-next-line vue/require-default-prop
    meta: {
      type: Object,
    },
  },
  data() {
    return {
      numbersPerSection: 5,
    };
  },
  computed: {
    section() {
      return Math.ceil(this.meta.current_page / this.numbersPerSection);
    },
    sections() {
      return Math.ceil(this.meta.last_page / this.numbersPerSection);
    },
    lastPage() {
      let lastPage =
        (this.section - 1) * this.numbersPerSection + this.numbersPerSection;
      if (this.section === this.sections) {
        lastPage = this.meta.last_page;
      }
      return lastPage;
    },
    pages() {
      return _.range(
        (this.section - 1) * this.numbersPerSection + 1,
        this.lastPage + 1
      );
    },
  },
  mounted() {
    if (this.meta.current_page > this.meta.last_page) {
      this.switched(this.meta.last_page);
    }
  },
  methods: {
    switched(page) {
      if (this.pageIsOutOfBounds(page)) {
        return;
      }
      const s = this.$route.query.s;
      this.$emit('pagination:switched', page, s);
    },

    pageIsOutOfBounds(page) {
      return page <= 0 || page > this.meta.last_page;
    },
    goBackwardASection() {
      this.switched(this.firstPageOfSection(this.section - 1));
    },

    goForwardASection() {
      this.switched(this.firstPageOfSection(this.section + 1));
    },
    firstPageOfSection(section) {
      return (section - 1) * this.numbersPerSection + 1;
    },
  },
};
</script>
