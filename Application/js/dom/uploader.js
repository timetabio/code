/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
import { Signal } from '../event/signal'

export class Uploader {
  constructor () {
    /**
     *
     * @type {Signal<{ loaded: number, total: number }>}
     */
    this.onProgress = new Signal()

    /**
     *
     * @type {XMLHttpRequest}
     * @private
     */
    this._xhr = null
  }

  cancel () {
    if (this._xhr) {
      this._xhr.abort()
    }
  }

  /**
   *
   * @param {string} url
   * @param {FormData} data
   * @returns {Promise}
   */
  execute (url, data) {
    return new Promise((resolve, reject) => {
      const xhr = new XMLHttpRequest()

      this._xhr = xhr

      xhr.addEventListener('load', () => {
        resolve()
      })

      xhr.upload.addEventListener('progress', (event) => {
        this.onProgress.dispatch({ loaded: event.loaded, total: event.total })
      })

      xhr.addEventListener('abort', () => {
        reject()
      })

      xhr.open('POST', url)
      xhr.send(data)
    })
  }
}
