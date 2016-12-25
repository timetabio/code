/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */

import { FileUpload } from './file-upload'
import { EventName } from '../dom/custom-events'

export class PostAttachment extends FileUpload {
  /**
   *
   * @private
   */
  _render () {
    this.classList.add('post-attachment')

    const $svg = document.createElementNS('http://www.w3.org/2000/svg', 'svg')
    $svg.classList.add('icon')
    this.appendChild($svg)

    const $use = document.createElementNS('http://www.w3.org/2000/svg', 'use')
    $use.setAttributeNS('http://www.w3.org/1999/xlink', 'href', '/icons/attachment.svg#icon')
    $svg.appendChild($use)

    const $name = document.createElement('span')
    $name.classList.add('name')
    $name.innerText = this._file.name
    this.appendChild($name)
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
    this._$input.value = data['public_id']
    this.dispatchEvent(new CustomEvent(EventName.formValidityChange, { bubbles: true }))
  }
}
