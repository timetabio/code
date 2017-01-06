/**
 * Copyright (c) 2017 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */

/**
 *
 * @param {(function(...*))} callbackFn
 * @param {number} [delay]
 */
export function debounce (callbackFn, delay = 500) {
  let timer

  return (...args) => {
    if (timer !== null) {
      clearTimeout(timer)
    }

    timer = setTimeout(() => callbackFn(...args), delay)
  }
}
