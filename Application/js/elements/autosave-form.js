/**
 * Copyright (c) 2017 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
import { debounce } from '../dom/time'
import { getCsrfToken } from '../dom/environment'
import { rejectHttpErrors } from '../dom/fetch'
import { formData } from '../dom/form'
import { handleAjaxError, handleAjaxResponse } from '../app/ajax'

export class AutosaveForm extends HTMLElement {
  constructor () {
    super()

    this._onInput = debounce(this._onInput.bind(this))
  }

  connectedCallback () {
    this.addEventListener('input', this._onInput)
    this.addEventListener('change', this._onInput)
  }

  disconnectedCallback () {
    this.removeEventListener('input', this._onInput)
    this.removeEventListener('change', this._onInput)
  }

  /**
   *
   * @param {Event} event
   * @private
   */
  _onInput (event) {
    const target = event.target

    const uri = target.getAttribute('save-uri')
    const data = formData({ [target.name]: target.value, token: getCsrfToken() })

    fetch(uri, { method: 'post', data })
      .then(rejectHttpErrors)
      .then((resp) => resp.json())
      .then((data) => handleAjaxResponse(data))
      .catch(() => handleAjaxError())
  }
}

