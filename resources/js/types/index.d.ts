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
    order_count: number
    orders: Order[]
    orders: Order[]
    phone: string
    state: string
    total_spent: number
    updated_at: string
    zip: string
}

export interface OrderItem {
    id: number
    order_id: number
    price: number
    product: Product
    product_id: number
    quantity: number
}

export interface Order {
    billing_address: string
    created_at: string
    credit_card_last_four: string
    credit_card_type: string
    customer: Customer
    customer_id: number
    customer_note?: string
    id: number
    items: OrderItem[]
    shipping_address: string
    status: string
    total_amount: number
    updated_at: string
}

export interface TopCustomer extends Customer {
    total_spent: number
}

export type PageProps<
    T extends Record<string, unknown> = Record<string, unknown>
> = T & {
    auth: {
        user: User
    }
    ziggy: Config & { location: string }
}
