module.exports = {
	root: true,
	env: { browser: true, es2020: true },
	extends: [
		"eslint:recommended",
		"plugin:@typescript-eslint/recommended",
		"plugin:react-hooks/recommended",
	],
	ignorePatterns: ["dist", ".eslintrc.cjs"],
	parser: "@typescript-eslint/parser",
	plugins: [
		"react-refresh",
		"@typescript-eslint",
		"react"
	],
	rules: {
		"react-refresh/only-export-components": [
			"warn",
			{ allowConstantExport: true },
		],
		"indent": [
			"error",
			"tab"
		],
		"semi": [
			"error",
			"never"
		],
		"quotes": [
			"error",
			"double"
		],
		"react/jsx-first-prop-new-line": [
			"error",
			"multiline"
		],
		"react/jsx-max-props-per-line": [
			"error",
			{ "maximum": 1, "when": "always" }
		],
		"react/react-in-jsx-scope": "off",
		"react/jsx-uses-react": "off",
	},
}
