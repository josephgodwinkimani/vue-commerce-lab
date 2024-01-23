import { format } from 'date-fns'

/**
 * Format date string to a readable format.
 *
 * @see https://date-fns.org/docs/format
 */
export function formatDate(dateString: string, formatStr = 'PP') {
    return format(new Date(dateString), formatStr)
}
