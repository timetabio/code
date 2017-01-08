/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */

import { Uploader } from '../dom/uploader'
import { preventReload } from '../dom/document'
import { getCsrfToken } from '../dom/environment'
import { formData } from '../dom/form'

/**
 *
 * @param {*} params
 * @returns {Promise<*>}
 */
function fetchJson (...params) {
  return fetch(...params)
    .then((resp) => resp.json())
}

/**
 *
 * @param {File} file
 * @returns {Promise<Response>}
 */
function createUpload (file) {
  return fetchJson('/action/upload', {
    method: 'POST',
    credentials: 'same-origin',
    body: formData({
      filename: file.name,
      mime_type: file.type,
      token: getCsrfToken()
    })
  })
}

/**
 *
 * @param {string} code
 * @returns {string}
 */
function translateErrorCode (code) {
  switch (code) {
    case 'EntityTooLarge':
      return 'The uploaded file exceeds the maximum file size of 25MiB'
  }

  return 'An unknown error occurred, please try again later'
}

/**
 *
 * @param {string} input
 */
function parseXml (input) {
  return new DOMParser().parseFromString(input, 'text/xml')
}

export class S3Uploader {
  /**
   *
   * @param {(function(value: { loaded: number, total: number }))} [onProgress]
   */
  constructor ({ onProgress } = {}) {
    this._uploader = new Uploader({ onProgress })
  }

  /**
   *
   * @param {File} file
   * @returns {Promise<Array<{}>>}
   */
  upload (file) {
    const uploader = this._uploader
    const credentials = createUpload(file)

    const upload = credentials
      .then((data) => {
        const form = formData(Object.assign(data.params, { file }))

        return uploader.execute(data.endpoint, form)
      })
      .then((response) => parseXml(response))
      .then((xml) => {
        if (xml.documentElement.tagName !== 'Error') {
          return
        }

        const code = xml.querySelector('Code').textContent
        const message = translateErrorCode(code)

        return Promise.reject(new Error(message))
      })

    preventReload(() => upload.catch(() => {}))

    return Promise.all([ credentials, upload ])
  }

  /**
   *
   * @returns {Signal<{loaded: number, total: number}>}
   */
  get onProgress () {
    return this._uploader.onProgress
  }
}
