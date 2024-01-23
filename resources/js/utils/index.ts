import { format } from 'date-fns'
import DOMPurify from 'dompurify'

/**
 * Format date string to a readable format.
 *
 * @see https://date-fns.org/docs/format
 *
 * @param dateString The date string to format.
 * @param formatStr The format string to use.
 *
 * @returns The formatted date string.
 */
export function formatDate(dateString: string, formatStr = 'PP'): string {
    return format(new Date(dateString), formatStr)
}

/**
 * Sanitize form fields.
 *
 * @param value The value to sanitize.
 * @param allowedTags Optional allowed tags for sanitizing HTML content.
 *
 * @returns The sanitized string.
 */
export function sanitizeInput(
    value: string,
    allowedTags: string[] = []
): string {
    return DOMPurify.sanitize(value, { ALLOWED_TAGS: allowedTags })
}
