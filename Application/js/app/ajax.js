/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */

import { createToastMessage } from '../dom/toast'

/**
 *
 * @returns {Promise}
 */
export function handleAjaxError () {
  return createToastMessage('Oops. Something went wrong. Please retry a little later.', { ttl: 4000 })
    .show()
}

/**
 *
 * @param {{}} data
 * @param {(function(string):boolean)} [errorFn]
 * @returns {Promise|null}
 */
export function handleAjaxResponse (data, errorFn = () => false) {
  Object.keys(data)
    .forEach((key) => {
      const value = data[ key ]

      switch (key) {
        case 'error':
          return handleError(value, errorFn)
        case 'redirect':
          return handleRedirect(value)
        case 'reload':
          return handleReload()
        case 'toast':
          return handleToast(value)
      }
    })
}

/**
 *
 * @param {string} error
 * @param {(function(string):boolean)} errorFn
 * @returns {Promise|null}
 */
function handleError (error, errorFn) {
  const result = errorFn(error)

  if (result) {
    return null
  }

  return createToastMessage(error, { ttl: 4000, error: true })
    .show()
}

/**
 *
 * @param {string} value
 */
function handleRedirect (value) {
  window.location.href = value
}

/**
 *
 * @param {{message: string, ttl?: number}} toast
 * @returns {Promise}
 */
function handleToast (toast) {
  return createToastMessage(toast.message, { ttl: toast.ttl })
    .show()
}

function handleReload () {
  window.location.reload()
}
