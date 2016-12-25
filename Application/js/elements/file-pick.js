/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */

import { EventName } from '../dom/custom-events'

export class FilePick extends HTMLElement {

  constructor () {
    super()
  }

  connectedCallback () {
    const $input = document.createElement('input')

    $input.type = 'file'
    $input.hidden = true
    $input.multiple = true

    $input.addEventListener('change', () => {
      this.dispatchEvent(new CustomEvent(EventName.filesAdded, { detail: { files: $input.files }, bubbles: true }))
    })

    this.addEventListener('click', () => {
      $input.click()
    })

    this.appendChild($input)
  }

}
