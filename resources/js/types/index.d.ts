import { Config } from 'ziggy-js'

export interface User {
    id: number
    name: string
    email: string
    email_verified_at: string
}

export interface Product {
    created_at: string
    description: string
    id: number
    image: string
    name: string
    price: number
    quantity: number
    sku: string
    updated_at: string
}

export interface Customer {
    address: string
    city: string
    created_at: string
    email: string
    id: number
    name: string
    phone: string
    state: string
    updated_at: string
    zip: string
}

export interface Order {
    billing_address: string
    created_at: string
    credit_card_late_four: string
    credit_card_type: string
    customer: Customer
    product: Product
    customer_id: number
    customer_note?: string
    id: number
    next_page_url: string
    prev_page_url: string
    product_id: number
    quantity: number
    shipping_address: string
    status: string
    total_amount: number
    updated_at: string
}

export type PageProps<
    T extends Record<string, unknown> = Record<string, unknown>
> = T & {
    auth: {
        user: User
    }
    ziggy: Config & { location: string }
}
