/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */

export class FormError extends window.HTMLElement {
  set error (error) {
    let empty = false

    if (error == null) {
      empty = true
    }

    this.innerText = error || ''
    this.empty = empty
  }

  /**
   *
   * @param {boolean} empty
   */
  set empty (empty) {
    if (empty) {
      this.setAttribute('empty', '')
    } else {
      this.removeAttribute('empty')
    }
  }

  /**
   *
   * @returns {boolean}
   */
  get empty () {
    return this.hasAttribute('empty')
  }
}
