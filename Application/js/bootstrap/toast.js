/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */

import { sessionStorage, StorageKey } from '../dom/storage'
import { createToastMessage } from '../dom/toast'

(() => {
  if (!sessionStorage.has(StorageKey.Toast)) {
    return
  }

  const toast = sessionStorage.get(StorageKey.Toast)

  sessionStorage.delete(StorageKey.Toast)

  return createToastMessage(toast).show()
})()