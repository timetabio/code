/**
 * (c) 2016 Ruben Schmidmeister
 */

export class FormError extends window.HTMLElement {
  set error (error) {
    let empty = false

    if (error == null) {
      empty = true
    }

    this.innerText = error || ''
    this.empty = empty
  }

  /**
   *
   * @param {boolean} empty
   */
  set empty (empty) {
    if (empty) {
      this.setAttribute('empty', '')
    } else {
      this.removeAttribute('empty')
    }
  }

  /**
   *
   * @returns {boolean}
   */
  get empty () {
    return this.hasAttribute('empty')
  }
}
