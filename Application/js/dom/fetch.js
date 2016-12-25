/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */

/**
 *
 * @param {Response} response
 */
export function rejectHttpErrors(response) {
  const status = response.status

  if (status >= 200 && status < 400) {
    return response
  }

  return Promise.reject(new Error(`http status code ${status} is an error`))
}

