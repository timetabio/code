/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
import { getCsrfToken } from '../dom/environment'
import { formData } from '../dom/form'
import { Uploader } from '../dom/uploader'
import { createReloadLock } from '../dom/document'

/**
 *
 * @param {*} params
 * @returns {Promise<*>}
 */
function jsonFetch (...params) {
  return fetch(...params)
    .then((resp) => resp.json())
}

/**
 *
 * @param {File} file
 * @returns {Promise<Response>}
 */
function createUpload (file) {
  return jsonFetch('/action/upload', {
    method: 'POST',
    credentials: 'same-origin',
    body: formData({
      filename: file.name,
      mime_type: file.type,
      token: getCsrfToken()
    })
  })
}

export class FileUpload extends HTMLElement {

  constructor () {
    super()

    this._onProgress = this._onProgress.bind(this)
  }

  connectedCallback () {
  }

  disconnectedCallback () {
  }

  /**
   *
   * @param {File} file
   */
  setFile (file) {
    this._file = file
    this._render()
  }

  /**
   * @returns {Promise}
   */
  upload () {
    this._renderUpload()
    this._renderInput()

    const lock = createReloadLock()

    const uploader = new Uploader()
    uploader.onProgress.addListener(this._onProgress)

    const credentials = createUpload(this._file)

    const upload = credentials.then((data) => {
      const form = formData(Object.assign(data.params, { file: this._file }))

      return uploader.execute(data.endpoint, form)
    })

    upload.then(() => {
      uploader.onProgress.removeListener(this._onProgress)
      this.classList.add('-uploaded')
    })

    Promise.all([ credentials, upload ])
      .then(([ data ]) => {
        lock.release()
        this._onDone(data)
      })
      .catch(() => {
        lock.release()
      })

    return upload
  }

  /**
   *
   * @param {{loaded: number, total: number}} progress
   * @private
   */
  _onProgress (progress) {
  }

  /**
   *
   * @private
   */
  _onDone () {
  }

  /**
   *
   * @private
   */
  _renderInput () {
  }

  /**
   *
   * @private
   */
  _render () {
  }

  /**
   *
   * @private
   */
  _renderUpload () {
  }
}
