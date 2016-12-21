/**
 * (c) 2016 Ruben Schmidmeister
 */
import { defer } from '../dom/next-render.js'

export class AutoTextarea extends window.HTMLTextAreaElement {
  constructor () {
    super()

    this._resize = this._resize.bind(this)
    this._validate = this._validate.bind(this)

    defer(() => this._resize())
  }

  connectedCallback () {
    this.addEventListener('input', this._resize)
    this.addEventListener('input', this._validate)
  }

  disconnectedCallback () {
    this.removeEventListener('input', this._resize)
    this.removeEventListener('input', this._validate)
  }

  _resize () {
    this.style.height = 'auto'
    this.style.height = `${this.scrollHeight}px`
  }

  _validate () {
    const isValid = (this.value.length < this.maxSize)
    let message = ''

    if (!isValid) {
      message = 'Max size reached'
    }

    this.setCustomValidity(message)
  }

  get maxSize () {
    return Number.parseInt(this.getAttribute('max-size'))
  }
}
