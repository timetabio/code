/**
 * (c) 2016 Ruben Schmidmeister
 */

/**
 *
 * @param {Response} response
 */
export function rejectHttpErrors(response) {
  const status = response.status

  if (status >= 200 && status < 400) {
    return response
  }

  return Promise.reject(new Error(`http status code ${status} is an error`))
}

