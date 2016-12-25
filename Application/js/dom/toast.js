/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */

import { ToastMessage } from '../elements/toast-message'

/**
 *
 * @param {string} message
 * @param {number} ttl
 * @returns {ToastMessage}
 */
export function createToastMessage(message, { ttl = 3000 } = {}) {
  const $message = new ToastMessage()

  $message.innerText = message
  $message.toastTtl = ttl

  return $message
}
