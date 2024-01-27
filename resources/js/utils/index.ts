import { format } from 'date-fns'

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
 * Format a number to a currency string.
 *
 * @param value The number to format.
 *
 * @returns The formatted currency string.
 */
export function formatCurrency(value: number): string {
    return new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD'
    }).format(value)
}

/**
 * Format a number to a string.
 *
 * @param value The number to format.
 *
 * @returns The formatted string.
 */
export function formatNumber(value: number): string {
    return new Intl.NumberFormat('en-US').format(value)
}
