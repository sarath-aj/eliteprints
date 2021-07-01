<template>
  <div
    id="js-cookie-consent-popup"
    class="js-cookie-consent cookie-consent hidden"
    style="background-color: #000 !important; color: #fff !important"
  >
    <div class="cookie-consent-body" style="max-width: 1170px">
      <span class="cookie-consent__message">
        Your experience on this site will be improved by allowing cookies
        <a href="https://shopwise.botble.com/cookie-policy">Cookie Policy</a>
      </span>
      <button
        id="js-cookie-consent-agree-popup"
        class="js-cookie-consent-agree cookie-consent__agree"
        style="
          background-color: #000 !important;
          color: #fff !important;
          border: 1px solid #fff !important;
        "
      >
        Allow cookies
      </button>
    </div>
  </div>
</template>

<script>
if (process.browser) {
  const cookieStorage = {
    getItem: (item) => {
      const cookies = document.cookie
        .split(';')
        .map((cookie) => cookie.split('='))
        .reduce((acc, [key, value]) => ({ ...acc, [key.trim()]: value }), {});
      return cookies[item];
    },
    setItem: (item, value) => {
      document.cookie = `${item}=${value};`;
    },
  };

  const storageType = cookieStorage;

  const consentPropertyName = 'jdc_consent';

  const shouldShowPopup = () => !storageType.getItem(consentPropertyName);

  const saveToStorage = () => storageType.setItem(consentPropertyName, true);
  window.onload = () => {
    const acceptFn = (event) => {
      saveToStorage(storageType);
      consentPopup.classList.add('hidden');
    };
    const consentPopup = document.getElementById('js-cookie-consent-popup');
    const acceptBtn = document.getElementById('js-cookie-consent-agree-popup');
    acceptBtn.addEventListener('click', acceptFn);

    if (shouldShowPopup(storageType)) {
      setTimeout(() => {
        consentPopup.classList.remove('hidden');
      }, 2000);
    }
  };
}

export default {};
</script>

<style>
.cookie-consent {
  background-color: #000 !important;
  padding: 10px 40px !important;
  color: #fff !important;
  position: fixed;
  bottom: 0;
  left: 0;
  right: 0;
  z-index: 999999;
}

.cookie-consent .cookie-consent-body {
  max-width: 1170px;
  padding-right: 15px;
  padding-left: 15px;
  margin-right: auto;
  margin-left: auto;
}

.cookie-consent .cookie-consent__message {
  height: 32px !important;
  line-height: 32px !important;
}

.cookie-consent .cookie-consent__message a {
  color: #fff !important;
  text-decoration: underline;
}

.cookie-consent .cookie-consent__agree {
  float: right;
  padding: 5px 10px !important;
  border-radius: 0 !important;
  outline: 0 !important;
  background: #000 !important;
  color: #fff !important;
  border: 1px solid #fff !important;
  text-transform: uppercase;
  font-size: 11px;
  font-weight: 600;
}

.cookie-consent .cookie-consent__agree:hover {
  background: #fff !important;
  color: #000 !important;
}

.hidden {
  opacity: 0;
}

@media screen and (max-width: 767px) {
  .cookie-consent .cookie-consent-body {
    text-align: center;
  }

  .cookie-consent .cookie-consent-body .cookie-consent__message {
    line-height: 25px !important;
  }

  .cookie-consent .cookie-consent-body .cookie-consent__agree {
    float: none;
    margin-top: 5px;
  }
}
</style>
