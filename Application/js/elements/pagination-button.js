/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */

import { EventName } from '../dom/custom-events'
import { State } from './paginated-view'

export class PaginationButton extends HTMLButtonElement {
  constructor () {
    super()

    this._onClick = this._onClick.bind(this)
  }

  connectedCallback () {
    this.addEventListener('click', this._onClick)
  }

  disconnectedCallback () {
    this.removeEventListener('click', this._onClick)
  }

  _onClick () {
    this.dispatchEvent(new CustomEvent(EventName.nextPage, { bubbles: true }))
  }

  /**
   *
   * @param {number} state
   */
  setState (state) {
    let text = this.idleText
    let disabled = false

    if (state === State.loading) {
      text = this.loadingText
      disabled = true
    }

    if (state === State.complete) {
      this.style.display = 'none'
    }

    this.innerText = text
    this.disabled = disabled
  }

  /**
   *
   * @returns {string}
   */
  get loadingText () {
    return this.getAttribute('loading-text')
  }

  /**
   *
   * @returns {string}
   */
  get idleText () {
    return this.getAttribute('idle-text')
  }
}
