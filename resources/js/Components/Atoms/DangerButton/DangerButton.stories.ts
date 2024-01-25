import DangerButton from '@/Components/Atoms/DangerButton/DangerButton.vue'
import type { Meta, StoryObj } from '@storybook/vue3'

/**
 * Scaffold the component.
 */
const meta: Meta<typeof DangerButton> = {
    title: 'Atoms/DangerButton',
    component: DangerButton
}

export default meta
type Story = StoryObj<typeof meta>

/**
 * A basic story showing the component.
 *
 * @see https://storybook.js.org/docs/api/csf
 */
export const Component: Story = {
    render: () => ({
        components: { DangerButton },
        template: '<DangerButton>Click Me</DangerButton>'
    })
}
