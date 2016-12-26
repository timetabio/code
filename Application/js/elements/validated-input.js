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

/**
 *
 * @typedef {{property: string, validate: (function($: ValidatedInput): string)}} Validator
 */

/**
 *
 * @type {Validator}
 */
const maxByteSize = {
  property: 'maxByteSize',
  validate ($) {
    if (getByteSize($.value) > $.maxByteSize) {
      return `max size of ${$.maxByteSize} exceeded`
    }

    return ''
  }
}

/**
 *
 * @type {Validator}
 */
const minByteSize = {
  property: 'minByteSize',
  validate ($) {
    if (getByteSize($.value) < $.minByteSize) {
      return `min size of ${$.minByteSize} not reached`
    }

    return ''
  }
}

/**
 *
 * @type {Validator}
 */
const stringMatch = {
  property: 'stringMatch',
  validate ($) {
    return $.value.toLowerCase() !== $.stringMatch.toLowerCase()
      ? `Value does not match ${$.stringMatch}`
      : '';
  }
}

/**
 *
 * @type {Array<Validator>}
 */
const validators = [
  maxByteSize, minByteSize, stringMatch
]

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
    const result = validators
      .filter((validator) => this[ validator.property ])
      .find((validator) => validator.validate(this))

    return result || ''
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

  /**
   *
   * @returns {string|null}
   */
  get stringMatch () {
    return this.getAttribute('string-match');
  }
}
