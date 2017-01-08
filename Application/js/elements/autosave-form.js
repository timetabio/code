/**
 * Copyright (c) 2017 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */

import { debounce } from '../dom/time'
import { rejectHttpErrors } from '../dom/fetch'
import { formData } from '../dom/form'
import { genericErrorMessage, handleAjaxResponse, addCsrfToken } from '../app/ajax'
import { preventReload } from '../dom/document'

export const AutosaveState = {
  Initial: 0,
  Saving: 1,
  Saved: 2,
  Error: 3
}

export class AutosaveForm extends HTMLElement {
  constructor () {
    super()

    this._onInput = debounce(this._onInput.bind(this))
    this._onSuccess = this._onSuccess.bind(this)
    this._onError = this._onError.bind(this)
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
    const body = addCsrfToken(formData(Object.assign(this.postData, { [target.name]: target.value })))

    this.$message.state = AutosaveState.Saving

    const complete = fetch(uri, { method: 'post', body, credentials: 'same-origin' })
      .then(rejectHttpErrors)
      .then((resp) => resp.json())
      .then((data) => handleAjaxResponse(data, this._onError))
      .then(() => this._onSuccess())
      .catch(() => this._onError(genericErrorMessage))


    preventReload(() => complete)
  }

  /**
   *
   * @private
   */
  _onSuccess () {
    this.$message.state = AutosaveState.Saved
  }

  /**
   *
   * @param {string} error
   * @returns boolean
   * @private
   */
  _onError (error) {
    this.$message.error = error
  }

  /**
   * @returns {{}}
   */
  get postData () {
    return JSON.parse(this.getAttribute('post-data'))
  }

  /**
   *
   * @returns {AutosaveMessage}
   */
  get $message () {
    // noinspection JSValidateTypes
    return this.querySelector('autosave-message')
  }
}

