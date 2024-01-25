import ApplicationLogo from '@/Components/Atoms/ApplicationLogo/ApplicationLogo.vue'
import { mount } from '@vue/test-utils'

/**
 * Define a test suite.
 *
 * @see https://vitest.dev/api/#describe
 */
describe('ApplicationLogo', () => {
    /**
     * Mount the component.
     *
     * @see https://vue-test-utils.vuejs.org/api/#mount
     */
    const wrapper = mount(ApplicationLogo)

    /**
     * Assert the component renders.
     *
     * @see https://vitest.dev/api/expect.html
     */
    test('renders', () => {
        expect(wrapper).toBeTruthy()
    })

    /**
     * Assert the component is a SVG.
     */
    test('is SVG', () => {
        wrapper.find('svg')
    })

    /**
     * Assert the component matches the snapshot.
     *
     * @see https://vitest.dev/api/expect.html#tomatchsnapshot
     */
    test('matches snapshot', () => {
        expect(wrapper.html()).toMatchSnapshot()
    })
})
