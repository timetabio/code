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
 * @template T
 * @constructor
 */
export function Signal () {
}

/**
 *
 * @param {(function(value: T))} callbackFn
 */
Signal.prototype.addListener = function (callbackFn) {
  if (this._listeners == null) {
    this._listeners = new Set()
  }

  this._listeners.add(callbackFn)
}

Signal.prototype.removeListener = function (callbackFn) {
  if (this._listeners == null) {
    return
  }

  this._listeners.delete(callbackFn)
}

/**
 *
 * @param {T} [value]
 */
Signal.prototype.dispatch = function (value) {
  if (this._listeners == null) {
    return
  }

  this._listeners.forEach((listener) => listener(value))
}
