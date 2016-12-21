/**
 * (c) 2016 Ruben Schmidmeister
 */

import { EventName } from '../dom/custom-events'

/**
 *
 * @param {string} html
 * @returns {DocumentFragment}
 */
function parseHtml (html) {
  const range = document.createRange()

  range.selectNode(document.body)

  return range.createContextualFragment(html)
}

export const State = {
  idle: 0,
  loading: 1,
  complete: 2
}

export class PaginatedView extends HTMLElement {
  constructor () {
    super()

    this._page = 1

    this._onNextPage = this._onNextPage.bind(this)
  }

  connectedCallback () {
    this.addEventListener(EventName.nextPage, this._onNextPage)
    this._setState(State.idle)
  }

  disconnectedCallback () {
    this.removeEventListener(EventName.nextPage, this._onNextPage)
  }

  _onNextPage () {
    if (this._state !== State.idle) {
      return Promise.resolve()
    }

    this._setState(State.loading)

    return fetch(`${this.endpointUri}?page=${this._page + 1}`, { credentials: 'same-origin' })
      .then((resp) => resp.text())
      .then((body) => parseHtml(body))
      .then((result) => this._onResponse(result))
  }

  /**
   *
   * @param {DocumentFragment} fragment
   * @private
   */
  _onResponse (fragment) {
    this._page += 1

    let state = State.idle

    if (this._page >= this.totalPages) {
      state = State.complete
    }

    this.$list.appendChild(fragment)

    this._setState(state)
  }

  /**
   *
   * @param {number} state
   * @private
   */
  _setState (state) {
    this._state = state

    if (this.$button) {
      this.$button.setState(state)
    }
  }

  /**
   *
   * @returns {string}
   */
  get endpointUri () {
    return this.getAttribute('endpoint-uri')
  }

  /**
   *
   * @returns {number}
   */
  get totalPages () {
    return Number.parseInt(this.getAttribute('total-pages'))
  }

  /**
   *
   * @returns {Element}
   */
  get $list () {
    return this.querySelector('paginated-list')
  }

  /**
   *
   * @returns {Element}
   */
  get $button () {
    return this.querySelector('button[is="pagination-button"]')
  }
}
