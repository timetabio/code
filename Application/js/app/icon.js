/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */

/**
 *
 * @param {string} iconName
 * @param {string} [className]
 * @returns {Element}
 */
export function createIcon (iconName, className = 'icon') {
  const $svg = document.createElementNS('http://www.w3.org/2000/svg', 'svg')
  $svg.classList.add(className)

  const $use = document.createElementNS('http://www.w3.org/2000/svg', 'use')
  $use.setAttributeNS('http://www.w3.org/1999/xlink', 'href', `/icons/${iconName}.svg#icon`)
  $svg.appendChild($use)

  return $svg
}
