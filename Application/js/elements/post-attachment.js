/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */

import { EventName } from '../dom/custom-events'
import { createIcon } from '../app/icon'
import { S3Uploader } from '../app/upload'
import { createToastMessage } from '../dom/toast'

export class PostAttachment extends HTMLElement {

  constructor () {
    super()

    this._onProgress = this._onProgress.bind(this)
    this._uploader = new S3Uploader({ onProgress: this._onProgress })

    this.classList.add('post-attachment')
  }

  /**
   *
   * @param {File} file
   * @returns {Promise}
   */
  upload (file) {
    this._render(file)

    return this._uploader.upload(file)
      .then((data) => this._onDone(...data))
      .catch((error) => this._onError(error))
  }

  /**
   *
   * @private
   */
  _render (file) {
    this.appendChild(createIcon('attachment'))

    const $name = document.createElement('span')
    $name.classList.add('name')
    $name.innerText = file.name

    this.appendChild($name)

    this._renderInput()
    this._renderUpload()
  }

  /**
   *
   * @private
   */
  _renderInput () {
    const $input = document.createElement('input')

    $input.type = 'text'
    $input.hidden = true
    $input.required = true
    $input.name = `attachments[]`

    this._$input = $input

    this.appendChild($input)

    setTimeout(() => {
      // This timeout delays the event dispatch until the element is attached to the dom,
      // so it can bubble up to the <ajax-form />
      this.dispatchEvent(new CustomEvent(EventName.formValidityChange, { bubbles: true }))
    })
  }

  _renderUpload () {
    const $progress = document.createElement('div')
    $progress.classList.add('progress')
    this.appendChild($progress)

    const $bar = document.createElement('div')
    $bar.classList.add('bar')
    $progress.appendChild($bar)

    const $svg = document.createElementNS('http://www.w3.org/2000/svg', 'svg')
    $svg.classList.add('done')
    $progress.appendChild($svg)

    const $use = document.createElementNS('http://www.w3.org/2000/svg', 'use')
    $use.setAttributeNS('http://www.w3.org/1999/xlink', 'href', '/icons/done.svg#icon')
    $svg.appendChild($use)

    this._$bar = $bar
  }

  /**
   *
   * @param {{loaded: number, total: number}} progress
   * @private
   */
  _onProgress (progress) {
    this._$bar.style.backgroundSize = `${100 / progress.total * progress.loaded}% 100%`
  }

  /**
   *
   * @param {{}} data
   * @private
   */
  _onDone (data) {
    this.classList.add('-uploaded')
    this._$input.value = data[ 'public_id' ]
    this._dispatchFormValidityChange()
  }

  /**
   *
   * @param {Error} error
   * @returns {Promise}
   * @private
   */
  _onError (error) {
    this._$input.parentNode.removeChild(this._$input)
    this._dispatchFormValidityChange()

    return createToastMessage({ message: error.message })
      .show()
  }

  _dispatchFormValidityChange () {
    this.dispatchEvent(new CustomEvent(EventName.formValidityChange, { bubbles: true }))
  }
}
