/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */

import { createToastMessage } from '../dom/toast'
import { getCsrfToken } from '../dom/environment'
import { sessionStorage, StorageKey } from '../dom/storage'

/**
 *
 * @type {string}
 */
export const genericErrorMessage = 'Oops. Something went wrong. Please retry a little later.'

/**
 * @typedef {{ message: string, ttl?: number, reload: boolean, action?: { icon?: string, label: string, uri: string, data: {} } }} JsonToast
 */

/**
 *
 * @param {FormData} formData
 * @returns {FormData}
 */
export function addCsrfToken(formData) {
  formData.append('token', getCsrfToken())
  return formData
}

/**
 *
 * @returns {Promise}
 */
export function handleAjaxError () {
  return createToastMessage({ message: genericErrorMessage, ttl: 4000 })
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

  return createToastMessage({ message: error, ttl: 4000 })
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
 * @param {JsonToast} toast
 * @returns {Promise}
 */
function handleToast (toast) {
  if (toast.reload) {
    return handleReloadToast(toast)
  }

  return createToastMessage(toast)
    .show()
}

/**
 *
 * @param {JsonToast} toast
 * @returns {Promise}
 */
function handleReloadToast (toast) {
  sessionStorage.set(StorageKey.Toast, toast)

  handleReload()

  return Promise.resolve()
}

function handleReload () {
  window.location.reload()
}
