/**
 * (c) 2016 Ruben Schmidmeister
 */

import { EventName } from '../dom/custom-events'

export class FilePick extends HTMLElement {

  constructor () {
    super()
  }

  connectedCallback () {
    const $input = document.createElement('input')

    $input.type = 'file'
    $input.hidden = true
    $input.multiple = true

    $input.addEventListener('change', () => {
      this.dispatchEvent(new CustomEvent(EventName.filesAdded, { detail: { files: $input.files }, bubbles: true }))
    })

    this.addEventListener('click', () => {
      $input.click()
    })

    this.appendChild($input)
  }

}
