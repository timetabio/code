/**
 * (c) 2016 Ruben Schmidmeister
 */

import { getCsrfToken } from '../dom/environment'
import { EventName } from '../dom/custom-events'
import { rejectHttpErrors } from '../dom/fetch'
import { handleAjaxError, handleAjaxResponse } from '../app/ajax'

export class AjaxForm extends window.HTMLFormElement {
  constructor () {
    super()

    this._onSubmit = this._onSubmit.bind(this)
    this._onInput = this._onInput.bind(this)
    this._onChange = this._onChange.bind(this)
    this._onValidityChange = this._onValidityChange.bind(this)
    this._onFilesAdded = this._onFilesAdded.bind(this)
    this._onError = this._onError.bind(this)
  }

  connectedCallback () {
    this.addEventListener('submit', this._onSubmit)
    this.addEventListener('input', this._onInput)
    this.addEventListener('change', this._onChange)
    this.addEventListener(EventName.formValidityChange, this._onValidityChange)
    this.addEventListener(EventName.filesAdded, this._onFilesAdded)
  }

  disconnectedCallback () {
    this.removeEventListener('submit', this._onSubmit)
    this.removeEventListener('input', this._onInput)
    this.removeEventListener('change', this._onChange)
    this.removeEventListener(EventName.formValidityChange, this._onValidityChange)
    this.removeEventListener(EventName.filesAdded, this._onFilesAdded)
  }

  _onSubmit (event) {
    event.preventDefault()

    this._submit()
  }

  _onValidityChange () {
    this._validate()
  }

  _onChange () {
    // Well... Thank you chrome for not firing 'input' events for changing radio buttons.
    // Love ya chrome, you're the sweetest
    this._validate()
  }

  _onInput () {
    this._validate()
  }

  _validate () {
    const submitButton = this.querySelector('[type="submit"]')
    const isValid = this.checkValidity()

    submitButton.disabled = !isValid
  }

  /**
   *
   * @param {CustomEvent} event
   * @private
   */
  _onFilesAdded (event) {
    event.stopPropagation()

    this.querySelector('file-drop').addFiles(event.detail.files)
  }

  /**
   *
   * @returns {Promise}
   * @private
   */
  _submit () {
    const data = new window.FormData(this)

    data.append('token', getCsrfToken())

    const params = {
      method: 'post',
      credentials: 'same-origin',
      body: data
    }

    return window.fetch(this.action, params)
      .then(rejectHttpErrors)
      .then((resp) => resp.json())
      .then((data) => handleAjaxResponse(data, this._onError))
      .catch(() => handleAjaxError())
  }

  /**
   *
   * @param {string} error
   * @returns {boolean}
   * @private
   */
  _onError (error) {
    const $error = this.$error

    if (!$error) {
      return false
    }

    $error.error = error

    return true
  }

  /**
   *
   * @returns {FormError}
   */
  get $error () {
    // noinspection JSValidateTypes
    return this.querySelector('form-error')
  }
}
