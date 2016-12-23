/**
 *
 * @type {string}
 */
const MESSAGE = 'This page contains unsaved changes. Are you sure you want to leave?'

/**
 *
 * @returns {{release: (function())}}
 */
export function createReloadLock () {
  const _listener = (event) => (event.returnValue = MESSAGE)

  window.addEventListener('beforeunload', _listener)

  return {
    release: () => window.removeEventListener('beforeunload', _listener)
  }
}
