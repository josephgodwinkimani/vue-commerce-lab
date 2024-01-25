import Checkbox from '@/Components/Atoms/Checkbox/Checkbox.vue'
import { mount } from '@vue/test-utils'

/**
 * Define a test suite.
 */
describe('Checkbox', () => {
    /**
     * Mount the component.
     */
    const wrapper = mount(Checkbox, {
        props: {
            checked: false
        }
    })

    /**
     * Assert the component input renders correctly.
     */
    test('renders a checkbox input', () => {
        const checkbox = wrapper.find('input[type="checkbox"]')
        expect(checkbox.exists()).toBe(true)
    })

    /**
     * Assert component toggles its state and emits an event on state change.
     */
    test('toggles checked state and emits update:checked event', async () => {
        const checkbox = wrapper.find('input[type="checkbox"]')
        if (checkbox.element instanceof HTMLInputElement) {
            // Checkbox: checked
            await checkbox.setValue(true)
            expect(checkbox.element.checked).toBe(true)
            expect(wrapper.emitted('update:checked')).toBeTruthy()
            expect(wrapper.emitted('update:checked')?.[0]).toEqual([true])

            // Checkbox: unchecked
            await checkbox.setValue(false)
            expect(checkbox.element.checked).toBe(false)
            expect(wrapper.emitted('update:checked')?.[1]).toEqual([false])
        }
    })

    /**
     * Assert the component matches the snapshot.
     */
    test('checkbox matches snapshot', () => {
        expect(wrapper.html()).toMatchSnapshot()
    })
})
