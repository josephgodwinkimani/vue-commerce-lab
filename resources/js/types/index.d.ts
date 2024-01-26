import { Config } from 'ziggy-js'

export interface User {
    email: string
    email_verified_at: string
    id: number
    name: string
}

export interface Product {
    created_at: string
    description: string
    id: number
    image: string
    lifetime_revenue: number
    lifetime_sales: number
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
    lifetime_orders: number
    lifetime_revenue: number
    name: string
    orders: Order[]
    phone: string
    state: string
    updated_at: string
    zip: string
}

export interface OrderItem {
    created_at: string
    customer_id: number
    id: number
    order_id: number
    product: Product
    product_id: number
    quantity: number
    total: number
    updated_at: string
}

export interface Order {
    billing_address: string
    created_at: string
    credit_card_last_four: string
    credit_card_type: string
    customer_id: number
    customer: Customer
    customer_note?: string
    id: number
    items: OrderItem[]
    quantity: number
    shipping_address: string
    status: string
    total_revenue: number
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
