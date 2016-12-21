/**
 * (c) 2016 Ruben Schmidmeister
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
