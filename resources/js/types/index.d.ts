import { Config } from 'ziggy-js'

export interface User {
    id: number
    name: string
    email: string
    email_verified_at: string
}

export interface Product {
    id: number
    name: string
    sku: string
    description: string
    price: number
    quantity: number
    image: string
    createdAt: string
    updatedAt: string
}

export interface Customer {
    id: number
    name: string
    email: string
    phone: string
    address: string
    city: string
    state: string
    zip: string
    createdAt: string
    updatedAt: string
}

export interface Order {
    id: number
    customerId: number
    productId: number
    status: string
    shippingAddress: string
    billingAddress: string
    creditCardType: string
    creditCardLastFour: string
    customerNote?: string
    quantity: number
    totalAmount: number
    createdAt: string
    updatedAt: string
}

export type PageProps<
    T extends Record<string, unknown> = Record<string, unknown>
> = T & {
    auth: {
        user: User
    }
    ziggy: Config & { location: string }
}
