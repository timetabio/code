/**
 * (c) 2016 Ruben Schmidmeister
 */
import { defer } from '../dom/next-render.js'
import { getByteSize } from '../dom/string.js'

export class ValidatedInput extends HTMLInputElement {
  constructor () {
    super()

    this._validate = this._validate.bind(this)

    defer(() => this._validate())
  }

  connectedCallback () {
    this.addEventListener('input', this._validate)
  }

  disconnectedCallback () {
    this.removeEventListener('input', this._validate)
  }

  _validate () {
    this.setCustomValidity(this._getValidity())
  }

  /**
   *
   * @returns {string}
   * @private
   */
  _getValidity () {
    if (this.maxByteSize) {
      return this._validateMaxByteSize()
    }

    return ''
  }

  /**
   *
   * @returns {string}
   * @private
   */
  _validateMaxByteSize () {
    if (getByteSize(this.value) > this.maxByteSize) {
      return `max size of ${this.maxByteSize} exceeded`
    }

    return ''
  }

  /**
   *
   * @returns {number|null}
   */
  get maxByteSize () {
    return Number.parseInt(this.getAttribute('max-byte-size')) || null;
  }
}
