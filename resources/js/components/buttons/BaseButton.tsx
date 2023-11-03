import { ReactNode, forwardRef } from "react"

interface ComponentProps {
	children: ReactNode
}

export const BaseButton = forwardRef<HTMLButtonElement, ComponentProps>(
	(
		{
			children
		},
		ref
	) => {
		return (
			<button
				ref={ref}
				className="py-3 px-4 inline-flex justify-center items-center gap-2 rounded-md border border-transparent font-semibold bg-blue-500 text-white hover:bg-blue-600 focus:outline-none transition-all text-sm">
				{children}
			</button>
		)
	})