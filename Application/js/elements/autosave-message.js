/**
 * Copyright (c) 2017 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */

import { AutosaveState } from './autosave-form'
import { createIcon } from '../app/icon'

const states = {
  [AutosaveState.Initial]() {
    return {
      icon: 'info',
      text: 'All Changes will be saved automatically.'
    }
  },
  [AutosaveState.Saving]() {
    return {
      icon: 'info',
      text: 'Your changes are being saved...'
    }
  },
  [AutosaveState.Error]() {
    return {
      icon: 'info',
      text: this._error
    }
  },
  [AutosaveState.Saved]() {
    return {
      icon: 'check',
      text: 'Your changes have been saved.'
    }
  }
}

export class AutosaveMessage extends HTMLElement {
  constructor () {
    super()

    this._initDom()
    this.state = AutosaveState.Initial
  }

  /**
   *
   * @param {number} state
   */
  set state (state) {
    this._state = state
    this._render()
  }

  /**
   *
   * @param {string} error
   */
  set error (error) {
    this._error = error
    this.state = AutosaveState.Error
  }

  _initDom () {
    const $status = this.appendChild(document.createElement('div'))
    $status.className = 'status'

    this._$icon = $status.appendChild(document.createTextNode(''))

    this._$text = this.appendChild(document.createElement('div'))
    this._$text.className = 'text'
  }

  /**
   *
   * @private
   */
  _render () {
    const values = states[this._state].call(this)
    const $icon = createIcon(values.icon)

    this._$icon.replaceWith($icon)
    this._$text.textContent = values.text

    this._$icon = $icon
  }
}
