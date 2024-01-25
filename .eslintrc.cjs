module.exports = {
    extends: [
        'eslint:recommended',
        'plugin:@typescript-eslint/recommended',
        'plugin:vue/vue3-recommended',
        'plugin:storybook/recommended',
        'prettier'
    ],
    parser: 'vue-eslint-parser',
    parserOptions: {
        parser: '@typescript-eslint/parser',
        ecmaVersion: 'latest',
        sourceType: 'module'
    },
    plugins: ['@typescript-eslint', 'vue'],
    env: {
        browser: true,
        node: true,
        es6: true
    },
    root: true,
    globals: {
        route: 'readonly'
    },
    rules: {
        'vue/multi-word-component-names': 'off'
    }
}
