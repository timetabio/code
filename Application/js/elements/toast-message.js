/**
 * (c) 2016 Ruben Schmidmeister
 */

/**
 * @type {Element}
 */
let _toastContainer

export function getToastContainer () {
  if (_toastContainer) {
    return _toastContainer
  }

  _toastContainer = document.createElement('section')
  _toastContainer.className = 'toast-container'

  document.body.appendChild(_toastContainer)

  return _toastContainer
}

export class ToastMessage extends HTMLElement {

  constructor () {
    super()

    this.classList.add('toast-message')

    this._onTtlExpired = this._onTtlExpired.bind(this)
  }

  connectedCallback () {
    if (this.toastTtl) {
      this._timeout = setTimeout(this._onTtlExpired, this.toastTtl)
    }
  }

  disconnectedCallback () {
    if (this._timeout) {
      clearTimeout(this._timeout)
      this._timeout = null
    }
  }

  /**
   *
   * @returns {Promise}
   * @private
   */
  _onTtlExpired () {
    return this.hide()
  }

  /**
   *
   * @returns {Promise}
   */
  hide () {
    return new Promise((resolve) => {
      this.addEventListener(
        'animationend',
        () => {
          this.remove()
          resolve()
        },
        { once: true }
      )

      this.classList.add('-disappear')
    })
  }

  /**
   *
   * @returns {Promise}
   */
  show () {
    const container = getToastContainer()
    const toast = container.querySelector('toast-message')
    const onHide = toast ? toast.hide() : Promise.resolve()

    return onHide.then(() => {
      container.appendChild(this)
    })
  }

  /**
   *
   * @returns {number}
   */
  get toastTtl () {
    return Number.parseInt(this.getAttribute('toast-ttl')) || null;
  }

  /**
   *
   * @param {number} ttl
   */
  set toastTtl (ttl) {
    this.setAttribute('toast-ttl', ttl.toString())
  }
}
