import DropDown from '@/Components/Atoms/DropDown/DropDown.vue'
import { mount } from '@vue/test-utils'

describe('DropDown', () => {
    /**
     * Mount the component.
     */
    const wrapper = mount(DropDown, {
        slots: {
            trigger: '<button>Trigger</button>',
            content: '<div>Content</div>'
        }
    })

    /**
     * Assert the component renders.
     */
    test('renders', () => {
        expect(wrapper.exists()).toBeTruthy()
    })

    /**
     * Assert the dropdown opens and closes correctly.
     */
    test('opens and closes', async () => {
        // Cast the element to HTMLElement to access the style property.
        const dropdownElement = wrapper.find('.absolute').element as HTMLElement

        // Initially, the dropdown should be closed.
        expect(
            dropdownElement.style.display === 'none' ||
                dropdownElement.style.display === ''
        ).toBe(true)

        // Simulate a click to open the dropdown.
        await wrapper.find('button').trigger('click')
        await wrapper.vm.$nextTick()
        expect(dropdownElement.style.display).not.toBe('none')

        // Simulate another click to close the dropdown.
        await wrapper.find('.fixed.inset-0').trigger('click')
        await wrapper.vm.$nextTick()
        expect(
            dropdownElement.style.display === 'none' ||
                dropdownElement.style.display === ''
        ).toBe(true)
    })

    /**
     * Assert the component matches the snapshot.
     */
    test('matches snapshot', () => {
        expect(wrapper.html()).toMatchSnapshot()
    })
})
