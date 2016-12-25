/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
import { getCsrfToken } from '../dom/environment'

export class FollowButton extends window.HTMLButtonElement {
  constructor () {
    super()
    this._onClick = this._onClick.bind(this)
  }

  connectedCallback () {
    this.addEventListener('click', this._onClick)
  }

  disconnectedCallback () {
    this.removeEventListener('click', this._onClick)
  }

  _onClick (event) {
    this._fetch()
      .then((resp) => resp.json())
      .then((data) => {
        this.isFollowing = data.following
        this.innerText = this._getLabel()
      })
  }

  _fetch () {
    const data = new window.FormData()

    data.append('token', getCsrfToken())
    data.append('feed_id', this.feedId)

    return window.fetch(this._getEndpoint(), {
      method: 'post',
      credentials: 'same-origin',
      body: data
    })
  }

  /**
   *
   * @returns {string}
   * @private
   */
  _getEndpoint () {
    return this.isFollowing
      ? '/action/unfollow'
      : '/action/follow'
  }

  /**
   *
   * @returns {string}
   * @private
   */
  _getLabel () {
    return this.isFollowing
      ? this.getAttribute('unfollow-label')
      : this.getAttribute('follow-label')
  }

  /**
   *
   * @returns {boolean}
   */
  get isFollowing () {
    return this.hasAttribute('is-following')
  }

  /**
   *
   * @param {boolean} _isFollowing
   */
  set isFollowing (_isFollowing) {
    if (_isFollowing) {
      this.setAttribute('is-following', '')
    } else {
      this.removeAttribute('is-following')
    }
  }

  /**
   *
   * @returns {string}
   */
  get feedId () {
    return this.getAttribute('feed-id')
  }
}
