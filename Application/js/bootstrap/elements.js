/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */

import { AjaxForm } from '../elements/ajax-form'
import { AjaxSelect } from '../elements/ajax-select'
import { FormError } from '../elements/form-error'
import { AutoTextarea } from '../elements/auto-textarea'
import { AjaxButton } from '../elements/ajax-button'
import { FileDrop } from '../elements/file-drop'
import { FileUpload } from '../elements/file-upload'
import { PostAttachment } from '../elements/post-attachment'
import { FilePick } from '../elements/file-pick'
import { ValidatedInput } from '../elements/validated-input'
import { LocalTimeElement, TimeAgoElement, TimeUntilElement, RelativeTimeElement } from '../elements/time-elements'
import { PaginatedView } from '../elements/paginated-view'
import { PaginatedList } from '../elements/paginated-list'
import { PaginationButton } from '../elements/pagination-button'
import { ToastMessage } from '../elements/toast-message'
import { UserMenu } from '../elements/user-menu'
import { UserMenuButton } from '../elements/user-menu-button'

window.customElements.define('ajax-form', AjaxForm, { extends: 'form' })
window.customElements.define('ajax-select', AjaxSelect, { extends: 'select' })
window.customElements.define('form-error', FormError)
window.customElements.define('auto-textarea', AutoTextarea, { extends: 'textarea' })
window.customElements.define('ajax-button', AjaxButton, { extends: 'button' })
window.customElements.define('file-drop', FileDrop)
window.customElements.define('file-pick', FilePick)
window.customElements.define('validated-input', ValidatedInput, { extends: 'input' })
window.customElements.define('toast-message', ToastMessage)

// pagination
window.customElements.define('paginated-view', PaginatedView)
window.customElements.define('paginated-list', PaginatedList)
window.customElements.define('pagination-button', PaginationButton, { extends: 'button' })

window.customElements.define('user-menu', UserMenu)
window.customElements.define('user-menu-button', UserMenuButton, { extends: 'button' })

window.customElements.define('file-upload', FileUpload)
window.customElements.define('post-attachment', PostAttachment)

window.customElements.define('relative-time', RelativeTimeElement)
window.customElements.define('time-ago', TimeAgoElement)
window.customElements.define('time-until', TimeUntilElement)
window.customElements.define('local-time', LocalTimeElement)
