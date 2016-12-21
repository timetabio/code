/**
 * (c) 2016 Ruben Schmidmeister
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
