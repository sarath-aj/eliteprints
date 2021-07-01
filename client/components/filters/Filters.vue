<template>
  <div class="col-lg-3 order-lg-first mt-4 pt-2 mt-lg-0 pt-lg-0">
    <div class="sidebar">
      <aside class="widget">
        <h5 class="widget_title">BY PRICE</h5>
        <div class="filter_price">
          <DoubleRangeSlider
            :min="selected.price[0]"
            :max="selected.price[1]"
            @update:min="updateMin"
            @update:max="updateMax"
          />
          <div class="price_range">
            <span
              >Price:
              <span id="flt_price"
                >${{ selected.price[0] }} - ${{ selected.price[1] }}</span
              ></span
            >
          </div>
        </div>
      </aside>
      <aside class="widget widget--tags">
        <h5 class="widget_title">BRANDS</h5>
        <ul class="list_brand">
          <li v-for="brand in brands" :key="brand.id">
            <div class="custome-checkbox">
              <input
                :id="'tag-brand-' + brand.id"
                v-model="selected.brand_id"
                class="form-check-input submit-form-on-change"
                type="checkbox"
                :value="brand.id"
              />
              <label class="form-check-label" :for="'tag-brand-' + brand.id"
                ><span>{{ brand.name }}</span></label
              >
            </div>
          </li>
        </ul>
      </aside>
      <aside class="widget widget--tags">
        <h5 class="widget_title">COLORS</h5>
        <ul class="list_brand">
          <li v-for="(color, index) in colors" :key="index">
            <div class="custome-checkbox">
              <input
                :id="'tag-color-' + index"
                v-model="selected.color"
                class="form-check-input submit-form-on-change"
                type="checkbox"
                :value="color.color"
              />
              <label class="form-check-label" :for="'tag-color-' + index"
                ><span>{{ color.color }}</span></label
              >
            </div>
          </li>
        </ul>
      </aside>
      <aside class="widget widget--tags">
        <h5 class="widget_title">SLEEVE TYPE</h5>
        <ul class="list_brand">
          <li>
            <div class="custome-checkbox">
              <input
                id="tag-full-sleeve"
                v-model="selected.sleeve"
                class="form-check-input submit-form-on-change"
                type="checkbox"
                value="full"
              />
              <label class="form-check-label" for="tag-full-sleeve"
                ><span>Full Sleeve</span></label
              >
            </div>
          </li>
          <li>
            <div class="custome-checkbox">
              <input
                id="tag-half-sleeve"
                v-model="selected.sleeve"
                class="form-check-input submit-form-on-change"
                type="checkbox"
                value="half"
              />
              <label class="form-check-label" for="tag-half-sleeve"
                ><span>Half Sleeve</span></label
              >
            </div>
          </li>
          <li>
            <div class="custome-checkbox">
              <input
                id="tag-sleeveless"
                v-model="selected.sleeve"
                class="form-check-input submit-form-on-change"
                type="checkbox"
                value="sleeveless"
              />
              <label class="form-check-label" for="tag-sleeveless"
                ><span>Sleeveless</span></label
              >
            </div>
          </li>
          <li>
            <div class="custome-checkbox">
              <input
                id="tag-short-sleeve"
                v-model="selected.sleeve"
                class="form-check-input submit-form-on-change"
                type="checkbox"
                value="short"
              />
              <label class="form-check-label" for="tag-short-sleeve"
                ><span>Short Sleeve</span></label
              >
            </div>
          </li>
        </ul>
      </aside>
      <aside class="widget widget--tags">
        <h5 class="widget_title">NECK TYPE</h5>
        <ul class="list_brand">
          <li>
            <div class="custome-checkbox">
              <input
                id="tag-polo-neck"
                v-model="selected.neck"
                class="form-check-input submit-form-on-change"
                type="checkbox"
                value="polo"
              />
              <label class="form-check-label" for="tag-polo-neck"
                ><span>Polo Neck</span></label
              >
            </div>
          </li>
          <li>
            <div class="custome-checkbox">
              <input
                id="tag-round-neck"
                v-model="selected.neck"
                class="form-check-input submit-form-on-change"
                type="checkbox"
                value="round"
              />
              <label class="form-check-label" for="tag-round-neck"
                ><span>Round Neck</span></label
              >
            </div>
          </li>
          <li>
            <div class="custome-checkbox">
              <input
                id="tag-collared-neck"
                v-model="selected.neck"
                class="form-check-input submit-form-on-change"
                type="checkbox"
                value="collared"
              />
              <label class="form-check-label" for="tag-collared-neck"
                ><span>Collared Neck</span></label
              >
            </div>
          </li>
          <li>
            <div class="custome-checkbox">
              <input
                id="tag-v-neck"
                v-model="selected.neck"
                class="form-check-input submit-form-on-change"
                type="checkbox"
                value="v"
              />
              <label class="form-check-label" for="tag-v-neck"
                ><span>V Neck</span></label
              >
            </div>
          </li>
          <li>
            <div class="custome-checkbox">
              <input
                id="tag-hooded-neck"
                v-model="selected.neck"
                class="form-check-input submit-form-on-change"
                type="checkbox"
                value="hooded"
              />
              <label class="form-check-label" for="tag-hooded-neck"
                ><span>Hooded Neck</span></label
              >
            </div>
          </li>
        </ul>
      </aside>
      <aside class="widget widget--tags">
        <h5 class="widget_title">FIT</h5>
        <ul class="list_brand">
          <li>
            <div class="custome-checkbox">
              <input
                id="tag-boxy-fit"
                v-model="selected.fit"
                class="form-check-input submit-form-on-change"
                type="checkbox"
                value="boxy"
              />
              <label class="form-check-label" for="tag-boxy-fit"
                ><span>Boxy</span></label
              >
            </div>
          </li>
          <li>
            <div class="custome-checkbox">
              <input
                id="tag-compression-fit"
                v-model="selected.fit"
                class="form-check-input submit-form-on-change"
                type="checkbox"
                value="compression"
              />
              <label class="form-check-label" for="tag-compression-fit"
                ><span>Compression</span></label
              >
            </div>
          </li>
          <li>
            <div class="custome-checkbox">
              <input
                id="tag-loose-fit"
                v-model="selected.fit"
                class="form-check-input submit-form-on-change"
                type="checkbox"
                value="loose"
              />
              <label class="form-check-label" for="tag-loose-fit"
                ><span>Loose</span></label
              >
            </div>
          </li>
          <li>
            <div class="custome-checkbox">
              <input
                id="tag-slim-fit"
                v-model="selected.fit"
                class="form-check-input submit-form-on-change"
                type="checkbox"
                value="slim"
              />
              <label class="form-check-label" for="tag-slim-fit"
                ><span>Slim</span></label
              >
            </div>
          </li>
          <li>
            <div class="custome-checkbox">
              <input
                id="tag-regular-fit"
                v-model="selected.fit"
                class="form-check-input submit-form-on-change"
                type="checkbox"
                value="regular"
              />
              <label class="form-check-label" for="tag-regular-fit"
                ><span>Regular</span></label
              >
            </div>
          </li>
        </ul>
      </aside>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import DoubleRangeSlider from '@/components/DoubleRangeSlider/DoubleRangeSlider';
import queryString from 'query-string';

export default {
  components: {
    DoubleRangeSlider,
  },
  data() {
    return {
      initial: true,
      min: 0,
      max: 1500,
      brands: [],
      colors: [],
      filters: {},
      selected: {
        price: [0, 1500],
        color: [],
        brand_id: [],
        sleeve: [],
        neck: [],
        fit: [],
      },
    };
  },
  async fetch() {
    const brands = await axios.get(this.backendURL + 'api/brands');
    const colors = await axios.get(this.backendURL + 'api/colors');
    this.brands = brands.data.data;
    this.colors = colors.data.data;
  },
  computed: {
    backendURL() {
      return process.env.backendURL;
    },
  },
  watch: {
    selected: {
      handler() {
        if (!this.initial) {
          this.updateQueryString();
        }

        if (this.$route.query.page > 1) {
          this.setQueryParameters();
        }
        this.initial = false;
      },
      deep: true,
    },
  },
  created() {
    const receivedQuery = _.omit(
      queryString.parse(
        queryString.stringify(this.$route.query, { encode: false }),
        { arrayFormat: 'bracket', parseNumbers: true }
      ),
      ['page']
    );
    this.selected = { ...this.selected, ...receivedQuery };

    if (process.client) {
      const filtersQueryString = queryString.stringify(
        _.omit(this.$route.query, ['page']),
        { encode: false }
      );
      if (this.$route.query.page) {
        history.replaceState(
          null,
          null,
          '?page=' + this.$route.query.page + '&' + filtersQueryString
        );
      }
      if (this.$route.query.page) {
        history.replaceState(null, null, '?' + filtersQueryString);
      }
    }
  },
  methods: {
    updateMin(value) {
      this.$set(this.selected.price, 0, Number(value));
    },
    updateMax(value) {
      this.$set(this.selected.price, 1, Number(value));
    },
    setQueryParameters() {
      const filtersQueryString =
        'page=1&' +
        queryString.stringify(
          { ...this.selected },
          { arrayFormat: 'bracket' },
          { encode: false }
        );
      history.replaceState(null, null, '?' + filtersQueryString);
    },
    updateQueryString() {
      this.$router
        .replace({
          query: {
            page: 1,
            'price[]': this.selected.price,
            'brand_id[]': this.selected.brand_id,
            'sleeve[]': this.selected.sleeve,
            'neck[]': this.selected.neck,
            'fit[]': this.selected.fit,
            'color[]': this.selected.color,
          },
        })
        .then(() => this.setQueryParameters());
    },
  },
};
</script>
