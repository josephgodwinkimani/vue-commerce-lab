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
 * Show a checked checkbox.
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
 * Show an unchecked checkbox.
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
