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
