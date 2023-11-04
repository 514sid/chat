import { forwardRef, InputHTMLAttributes } from "react"

type StringInputType = "text" | "password" | "email";

interface ComponentProps extends InputHTMLAttributes<HTMLInputElement> {
	type?: StringInputType;
}

export const StringInput = forwardRef<HTMLInputElement, ComponentProps>(
	(
		{
			type = "text",
			...rest
		},
		ref
	) => {
		return (
			<input
				ref={ref}
				type={type}
				className="h-12 px-3 block w-full border border-gray-200 rounded text-sm focus:border-blue-500 focus:ring-blue-500 focus:outline-none"
				{...rest}
			/>
		)
	}
)