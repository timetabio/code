/**
 * (c) 2016 Ruben Schmidmeister
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
