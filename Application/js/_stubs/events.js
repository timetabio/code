/**
 *
 * @extends {MouseEvent}
 * @extends {Event}
 */
function DragEvent () {}

/**
 *
 * @type {DataTransfer}
 */
DragEvent.prototype.dataTransfer = null;

/**
 * @typedef {{bubbles?: boolean, cancelable?: boolean, scoped?: boolean, composed?: boolean, detail?: {}}} CustomEventInit
 */

/**
 @param {string} type
 @param {CustomEventInit} [eventInitDict]
 @constructor
 */
function CustomEvent(type,eventInitDict) {}
