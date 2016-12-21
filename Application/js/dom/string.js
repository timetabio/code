/**
 * (c) 2016 Ruben Schmidmeister
 */

/**
 *
 * @param {string} string
 * @returns {number}
 */
export function getByteSize(string) {
  if (window.TextEncoder) {
    return (new TextEncoder()).encode(string).length
  }

  return string.length
}
