/**
 * (c) 2016 Ruben Schmidmeister
 */

/**
 *
 * @returns {string}
 */
export function getCsrfToken () {
  return document
    .querySelector('meta[name="csrf-token"]')
    .getAttribute('content')
}
