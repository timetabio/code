/**
 * (c) 2016 timetab.io <www.timetab.io>
 */

if (!('entries' in Object)) {
  /**
   *
   * @param {{}} object
   * @returns {Array<Array<string|*>>}
   */
  Object.entries = function (object) {
    return Object.keys(object)
      .map(function (key) {
        return [ key, object[ key ] ]
      })
  }
}
