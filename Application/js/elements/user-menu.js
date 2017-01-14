/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */

import { EventName } from '../dom/custom-events'

/**
 *
 * @param {Element} element
 * @param {string} attribute
 * @param {string} value
 */
function toggleAttribute (element, attribute, value = '') {
  if (element.hasAttribute(attribute)) {
    element.removeAttribute(attribute)
  } else {
    element.setAttribute(attribute, value)
  }
}

export class UserMenu extends HTMLElement {
  constructor () {
    super()

    this._onToggle = this._onToggle.bind(this)
    this._onBodyClick = this._onBodyClick.bind(this)
  }

  connectedCallback () {
    this.addEventListener(EventName.userMenuToggle, this._onToggle)
    document.body.addEventListener('click', this._onBodyClick)
  }

  disconnectedCallback () {
    this.removeEventListener(EventName.userMenuToggle, this._onToggle)
    document.body.removeEventListener('click', this._onBodyClick)
  }

  _onToggle () {
    this.classList.toggle('-open')
    toggleAttribute(this._$nav, 'inert')
  }

  /**
   *
   * @param {Event} event
   * @private
   */
  _onBodyClick (event) {
    if (this.contains(event.target)) {
      return
    }

    this.classList.remove('-open')
  }

  /**
   *
   * @returns {Element}
   * @private
   */
  get _$nav () {
    return this.querySelector('.nav')
  }
}
