/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */

export class FileDrop extends HTMLElement {

  constructor () {
    super()

    this._onDrop = this._onDrop.bind(this)
    this._onDragOver = this._onDragOver.bind(this)
    this._onDragEnter = this._onDragEnter.bind(this)
    this._onDragLeave = this._onDragLeave.bind(this)
    this._onDragLeave = this._onDragLeave.bind(this)
  }

  connectedCallback () {
    this.addEventListener('drop', this._onDrop)
    this.addEventListener('dragover', this._onDragOver)
    this.addEventListener('dragenter', this._onDragEnter)
    this.addEventListener('dragleave', this._onDragLeave)
  }

  disconnectedCallback () {
    this.removeEventListener('drop', this._onDrop)
    this.removeEventListener('dragover', this._onDragOver)
    this.removeEventListener('dragenter', this._onDragEnter)
    this.removeEventListener('dragleave', this._onDragLeave)
  }

  /**
   *
   * @param {DragEvent} event
   * @private
   */
  _onDrop (event) {
    event.preventDefault()

    this.classList.remove('-drag-over')

    this.addFiles(event.dataTransfer.files)
  }

  /**
   *
   * @param {FileList} files
   */
  addFiles (files) {
    const $appendTo = this.querySelector(this.appendTo)

    Array.from(files).forEach((file) => {
      const $file = document.createElement(this.fileElement)

      $file.upload(file)

      $appendTo.appendChild($file)
    })
  }

  /**
   *
   * @param {DragEvent} event
   * @private
   */
  _onDragOver (event) {
    event.preventDefault()

    this.classList.add('-drag-over')
  }

  /**
   *
   * @param {DragEvent} event
   * @private
   */
  _onDragEnter (event) {
    event.preventDefault()
  }

  /**
   *
   * @param {DragEvent} event
   * @private
   */
  _onDragLeave (event) {
    event.preventDefault()

    this.classList.remove('-drag-over')
  }

  /**
   *
   * @returns {string}
   */
  get appendTo () {
    return this.getAttribute('append-to')
  }

  /**
   *
   * @returns {string}
   */
  get fileElement () {
    return this.getAttribute('file-element')
  }
}
