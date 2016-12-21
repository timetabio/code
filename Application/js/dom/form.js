/**
 * (c) 2016 Ruben Schmidmeister
 */

/**
 *
 * @param {{}} data
 * @returns {FormData}
 */
export function formData (data) {
  const formData = new FormData()

  Object.entries(data)
    .forEach((entry) => formData.append(...entry))

  return formData
}
