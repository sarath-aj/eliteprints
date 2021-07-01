<template>
  <div class="content">
    <div
      id="my-slider"
      :se-min="minThreshold"
      :se-step="step"
      :se-min-value="min"
      :se-max-value="max"
      :se-max="maxThreshold"
      class="slider"
    >
      <div class="slider-touch-left">
        <span />
      </div>
      <div class="slider-touch-right">
        <span />
      </div>
      <div class="slider-line">
        <span />
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    minThreshold: {
      type: Number,
      default: 0,
    },
    maxThreshold: {
      type: Number,
      default: 1500,
    },
    step: {
      type: Number,
      default: 1,
    },
    min: {
      type: Number,
      required: true,
    },
    max: {
      type: Number,
      required: true,
    },
  },
  data() {
    return {
      instance: undefined,
    };
  },
  mounted() {
    this.instance = new this.RangeSlider('my-slider');
    this.instance.didChanged = (min, max) => this.updateValues(min, max);
  },
  destroyed() {},
  methods: {
    updateValues(min, max) {
      this.$emit('update:min', min);
      this.$emit('update:max', max);
    },
  },
};
</script>

<style>
.slider {
  display: block;
  position: relative;
  height: 36px;
  width: 100%;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  -o-user-select: none;
  user-select: none;
}

.slider .slider-touch-left,
.slider .slider-touch-right {
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
  display: block;
  position: absolute;
  height: 36px;
  width: 36px;
  padding: 6px;
  z-index: 2;
}

.slider .slider-touch-left span,
.slider .slider-touch-right span {
  display: block;
  width: 100%;
  height: 100%;
  background: #ff324d;
  border: 1px solid #ff324d;
  border-radius: 50%;
}

.slider .slider-line {
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
  position: absolute;
  width: calc(100% - 36px);
  left: 18px;
  top: 16px;
  height: 4px;
  border-radius: 4px;
  background: #f0f0f0;
  z-index: 0;
  overflow: hidden;
}

.slider .slider-line span {
  display: block;
  height: 100%;
  width: 0%;
  background: #ff324d;
}
</style>
