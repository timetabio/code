(function () {
  'use strict'

  if (/MSIE|Trident/.test(navigator.userAgent)) {
    document.getElementById('outdated-browser').removeAttribute('hidden')
  }
})()
