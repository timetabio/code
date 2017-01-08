/**
 *
 * @returns void
 */
HTMLElement.prototype.remove = function () {
}

/**
 *
 * @param {...Node} nodes
 */
HTMLElement.prototype.replaceWith = function (...nodes) {

}

/**
 * @typedef {{capture?: boolean, once?: boolean, passive?: boolean}} EventListenerOptions
 */

/**
 @param {string} type
 @param {EventListener|Function} listener
 @param {EventListenerOptions|boolean} [options]
 */
EventTarget.prototype.addEventListener = function (type, listener, options = false) {
}
