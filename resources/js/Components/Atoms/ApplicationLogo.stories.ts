import ApplicationLogo from '@/Components/Atoms/ApplicationLogo.vue'
import type { Meta, StoryObj } from '@storybook/vue3'

/**
 * Scaffold the component.
 */
const meta: Meta<typeof ApplicationLogo> = {
    title: 'Atoms/ApplicationLogo',
    component: ApplicationLogo
}

export default meta
type Story = StoryObj<typeof meta>

/**
 * A basic story showing the logo.
 *
 * @see https://storybook.js.org/docs/api/csf
 */
export const Logo: Story = {
    render: (args) => ({
        components: { ApplicationLogo },
        setup() {
            return { args }
        },
        template: '<ApplicationLogo />'
    }),
    args: {}
}
