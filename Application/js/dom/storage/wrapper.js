/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */

export class StorageWrapper {
  /**
   *
   * @param {Storage} storage
   */
  constructor (storage) {
    /**
     *
     * @type {Storage}
     * @private
     */
    this._storage = storage
  }

  /**
   *
   * @param {string} key
   */
  get (key) {
    let item = this._storage.getItem(key)

    if (item === null) {
      return null
    }

    return JSON.parse(item)
  }

  /**
   *
   * @param {string} key
   * @param {*} value
   */
  set (key, value) {
    this._storage.setItem(key, JSON.stringify(value))
  }

  /**
   *
   * @param {string} key
   */
  delete (key) {
    this._storage.removeItem(key)
  }

  /**
   *
   * @param {string} key
   * @returns {boolean}
   */
  has (key) {
    return this._storage.getItem(key) !== null
  }

  clear () {
    this._storage.clear()
  }

  /**
   *
   * @returns {number}
   */
  get size () {
    return this._storage.length
  }
}
