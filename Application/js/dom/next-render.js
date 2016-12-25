/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */

let waitingNextRender = false
let afterNextRenderQueue = []

/**
 *
 * Calls the given function after the next render has occurred.
 *
 * @param {Function} callbackFn
 */
export function defer (callbackFn) {
  watchNextRender()
  afterNextRenderQueue.push(callbackFn)
}

function watchNextRender () {
  if (!waitingNextRender) {
    waitingNextRender = true

    const fn = () => {
      afterNextRenderQueue.forEach((callbackFn) => callbackFn())
      afterNextRenderQueue = []
      waitingNextRender = false
    }

    // noinspection JSCheckFunctionSignatures
    window.requestAnimationFrame(() => setTimeout(fn))
  }
}
