import Dropdown from '@/Components/Atoms/Dropdown/Dropdown.vue'
import type { Meta, StoryObj } from '@storybook/vue3'

const meta: Meta<typeof Dropdown> = {
    title: 'Atoms/Dropdown',
    component: Dropdown,
    argTypes: {
        align: {
            control: { type: 'select', options: ['left', 'right'] },
            defaultValue: 'right'
        },
        width: {
            control: 'text',
            defaultValue: '48'
        },
        contentClasses: {
            control: 'text',
            defaultValue: 'py-1 bg-white dark:bg-gray-700'
        }
    }
}

export default meta
type Story = StoryObj<typeof meta>

export const Component: Story = {
    args: {
        align: 'right',
        width: '48',
        contentClasses: 'py-1 bg-white dark:bg-gray-700'
    },
    render: (args) => ({
        components: { Dropdown },
        setup() {
            return { args }
        },
        template: `
            <Dropdown v-bind="args">
                <template #trigger="{ open }">
                    <button :class="{ 'bg-gray-200': open }">Click Me</button>
                </template>
                <template #content>
                    <div class="p-4">
                        <p>Dropdown Content Here</p>
                    </div>
                </template>
            </Dropdown>
        `
    })
}
