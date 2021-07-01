<template>
  <!-- Back to top button -->
  <a id="button" aria-label="Scroll To Top" />
</template>

<script>
export default {
  mounted() {
    this.init();
  },
  methods: {
    init() {
      const btn = $('#button');
      $(window).scroll(function () {
        if ($(window).scrollTop() > 300) {
          btn.addClass('show');
        } else {
          btn.removeClass('show');
        }
      });
      btn.on('click', function (e) {
        e.preventDefault();
        $('html, body').animate({ scrollTop: 0 }, '300');
      });
    },
  },
};
</script>

<style>
#button {
  display: inline-block;
  background-color: #ff324d;
  width: 45px;
  height: 50px;
  text-align: center;
  border-radius: 4px;
  position: fixed;
  bottom: 5px;
  right: 5px;
  transition: background-color 0.3s, opacity 0.5s, visibility 0.5s;
  opacity: 0;
  visibility: hidden;
  z-index: 1000;
}

#button::after {
  content: '\f077';
  /* stylelint-disable-next-line font-family-no-missing-generic-family-keyword */
  font-family: FontAwesome;
  font-weight: normal;
  font-style: normal;
  font-size: 1.8em;
  line-height: 50px;
  color: #fff;
}

#button:hover {
  cursor: pointer;
  background-color: #333;
}

#button:active {
  background-color: #555;
}

#button.show {
  opacity: 1;
  visibility: visible;
}

@media (min-width: 500px) {
  #button {
    margin: 30px;
  }
}
</style>
