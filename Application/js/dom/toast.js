/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */

import { ToastMessage } from '../elements/toast-message'
import { AjaxButton } from '../elements/ajax-button'
import { createIcon } from '../app/icon'

/**
 *
 * @param {string} message
 * @param {number} ttl
 * @param {{ icon?: string, label: string, uri: string, data: {} }|null} action
 * @returns {ToastMessage}
 */
export function createToastMessage({ message, ttl = 3000, action = null }) {
  const $message = new ToastMessage()

  $message.toastTtl = ttl

  console.log(action)

  if (action !== null) {
    const $button = new AjaxButton()

    $button.className = 'action'
    $button.postUri = action.uri
    $button.postData = action.data

    $message.appendChild($button)

    const $inner = document.createElement('span')
    $inner.className = 'inner'
    $button.appendChild($inner)

    const $icon = createIcon(action.icon)
    $inner.appendChild($icon)

    const $label = document.createElement('span')
    $label.className = 'label'
    $label.innerText = action.label
    $inner.appendChild($label)
  }

  const $text = document.createElement('span')
  $text.className = 'message'
  $text.innerText = message
  $message.appendChild($text)

  return $message
}
