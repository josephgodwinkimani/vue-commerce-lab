import DangerButton from '@/Components/Atoms/DangerButton.vue'
import type { Meta, StoryObj } from '@storybook/vue3'

/**
 * Scaffold the component.
 */
const meta: Meta<typeof DangerButton> = {
    title: 'Atoms/DangerButton',
    component: DangerButton,
    // Adding argTypes for dynamically changing the slot content
    argTypes: {
        buttonText: {
            control: 'text',
            defaultValue: 'Click Me' // Default text for the button
        }
    }
}

export default meta
type Story = StoryObj<typeof meta>

/**
 * A basic story showing the component.
 *
 * @see https://storybook.js.org/docs/api/csf
 */
export const Component: Story = {
    args: {
        buttonText: 'Click Me' // Default value for the button text
    },
    render: (args) => ({
        components: { DangerButton },
        setup() {
            return { args }
        },
        template: '<DangerButton>{{ args.buttonText }}</DangerButton>'
    })
}
