import DangerButton from '@/Components/Atoms/DangerButton.vue'
import type { Meta, StoryObj } from '@storybook/vue3'

/**
 * Scaffold the component.
 */
const meta: Meta<typeof DangerButton> = {
    title: 'Atoms/DangerButton',
    component: DangerButton,
    argTypes: {
        buttonText: {
            control: 'text',
            defaultValue: 'Click Me'
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
        buttonText: 'Click Me'
    },
    render: (args) => ({
        components: { DangerButton },
        setup() {
            return { args }
        },
        template: '<DangerButton>{{ args.buttonText }}</DangerButton>'
    })
}
