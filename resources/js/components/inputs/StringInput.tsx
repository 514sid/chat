import { forwardRef } from "react"

type StringInputType = "text" | "password" | "email"

interface ComponentProps {
	placeholder?: string;
	type: StringInputType;
}

export const StringInput = forwardRef<HTMLInputElement, ComponentProps>(
	(
		{
			placeholder = "",
			type = "text"
		},
		ref
	) => {
		return (
			<input
				placeholder={placeholder}
				ref={ref}
				type={type}
				className="h-12 px-3 block w-full border border-gray-200 rounded text-sm focus:border-blue-500 focus:ring-blue-500 focus:outline-none"
			/>
		)
	})