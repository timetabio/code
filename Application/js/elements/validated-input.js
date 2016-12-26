/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */

import { defer } from '../dom/next-render.js'
import { getByteSize } from '../dom/string.js'

export class ValidatedInput extends HTMLInputElement {
  constructor () {
    super()

    this._validate = this._validate.bind(this)
  }

  connectedCallback () {
    this.addEventListener('input', this._validate)

    defer(() => this._validate())
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
    let result = ''

    if (this.maxByteSize) {
      result = result || this._validateMaxByteSize()
    }

    if (this.minByteSize) {
      result = result || this._validateMinByteSize()
    }

    return result
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
   * @returns {string}
   * @private
   */
  _validateMinByteSize () {
    if (getByteSize(this.value) < this.minByteSize) {
      return `min size of ${this.minByteSize} not reached`
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

  /**
   *
   * @returns {number|null}
   */
  get minByteSize () {
    return Number.parseInt(this.getAttribute('min-byte-size')) || null;
  }
}
