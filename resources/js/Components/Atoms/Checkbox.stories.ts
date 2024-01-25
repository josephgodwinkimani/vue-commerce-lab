import Checkbox from '@/Components/Atoms/Checkbox.vue'
import type { Meta, StoryObj } from '@storybook/vue3'

/**
 * Scaffold the component.
 */
const meta: Meta<typeof Checkbox> = {
    title: 'Atoms/Checkbox',
    component: Checkbox,
    argTypes: {
        checked: {
            control: { type: 'boolean' },
            defaultValue: false
        },
        value: {
            control: 'text',
            defaultValue: ''
        }
    }
}

export default meta
type Story = StoryObj<typeof meta>

/**
 * A basic story showing the component.
 */
export const Component: Story = {
    render: (args) => ({
        components: { Checkbox },
        setup() {
            return { args }
        },
        template: '<Checkbox v-bind="args" />'
    }),
    args: {
        checked: false,
        value: 'basic-example'
    }
}

/**
 * Checked checkbox.
 */
export const Checked: Story = {
    render: (args) => ({
        components: { Checkbox },
        setup() {
            return { args }
        },
        template: '<Checkbox v-bind="args" />'
    }),
    args: {
        checked: true,
        value: 'checked-example'
    }
}

/**
 * Unchecked checkbox.
 */
export const Unchecked: Story = {
    render: (args) => ({
        components: { Checkbox },
        setup() {
            return { args }
        },
        template: '<Checkbox v-bind="args" />'
    }),
    args: {
        checked: false,
        value: 'unchecked-example'
    }
}
