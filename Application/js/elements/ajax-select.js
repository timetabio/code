/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */

import { getCsrfToken } from '../dom/environment'
import { rejectHttpErrors } from '../dom/fetch'
import { handleAjaxError, handleAjaxResponse } from '../app/ajax'


export class AjaxSelect extends HTMLSelectElement {

  constructor () {
    super()
    this._onChange = this._onChange.bind(this)
  }

  connectedCallback () {
    this.addEventListener('change', this._onChange)
  }

  disconnectedCallback () {
    this.removeEventListener('change', this._onChange)
  }

  _onChange () {
    this._fetch()
      .then(rejectHttpErrors)
      .then((resp) => resp.json())
      .then((data) => handleAjaxResponse(data))
      .catch(() => handleAjaxError())
  }

  /**
   *
   * @returns {Promise<Response>}
   * @private
   */
  _fetch () {
    const postData = this.postData
    const data = new window.FormData()

    Object.entries(postData)
      .forEach(([key, value]) => {
        data.append(key, value)
      })

    data.append('token', getCsrfToken())
    data.append(this.name, this.value)

    return window.fetch(this.postUri, {
      method: 'post',
      credentials: 'same-origin',
      body: data
    })
  }

  /**
   *
   * @returns {string}
   */
  get postUri () {
    return this.getAttribute('post-uri')
  }

  /**
   *
   * @returns {{}}
   */
  get postData () {
    return JSON.parse(this.getAttribute('post-data'))
  }
}
