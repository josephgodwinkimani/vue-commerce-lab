import { mount } from '@vue/test-utils'
import ApplicationLogo from '@/Components/Atoms/ApplicationLogo.vue'

/**
 * Assert the component exists.
 *
 * Note: Only necessary in the first test.
 */
test('Logo component exists', () => {
    expect(ApplicationLogo).toBeTruthy()
})

/**
 * Assert the component renders.
 */
test('Logo renders', () => {
    const wrapper = mount(ApplicationLogo)
    expect(wrapper).toBeTruthy()
})

/**
 * Assert the component is a SVG.
 */
test('Logo is SVG', () => {
    const wrapper = mount(ApplicationLogo)
    wrapper.find('svg')
})

/**
 * Assert the component matches the snapshot.
 */
test('Logo matches snapshot', () => {
    const wrapper = mount(ApplicationLogo)
    expect(wrapper.html()).toMatchSnapshot()
})
