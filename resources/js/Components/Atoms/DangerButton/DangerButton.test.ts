import DangerButton from '@/Components/Atoms/DangerButton/DangerButton.vue'
import { mount } from '@vue/test-utils'

describe('DangerButton', () => {
    // Slot content.
    const content = 'Click me!'

    /**
     * Mount the component.
     */
    const wrapper = mount(DangerButton, {
        slots: {
            default: content
        }
    })

    /**
     * Assert the component renders.
     */
    test('renders', () => {
        expect(wrapper).toBeTruthy()
    })

    /**
     * Assert the component renders the slot content.
     */
    test('renders the slot content', () => {
        expect(wrapper.text()).toContain(content)
    })

    /**
     * Assert the component matches the snapshot.
     */
    test('matches snapshot', () => {
        expect(wrapper.html()).toMatchSnapshot()
    })
})
