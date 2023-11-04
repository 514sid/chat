import { ReactNode, forwardRef, ButtonHTMLAttributes, MouseEvent } from "react"
import { useNavigate } from "react-router-dom"

interface BaseButtonProps extends ButtonHTMLAttributes<HTMLButtonElement> {
  children: ReactNode;
  to?: string;
}

export const BaseButton = forwardRef<HTMLButtonElement, BaseButtonProps>(
	(
		{
			children,
			onClick,
			to,
			...rest
		},
		ref
	) => {
		const navigate = useNavigate()

		const handleClick = (e: MouseEvent<HTMLButtonElement>) => {
			if (to) {
				e.preventDefault()
				navigate(to)
			}

			if (onClick) {
				onClick(e)
			}
		}

		return (
			<button
				ref={ref}
				onClick={handleClick}
				className="py-3 px-4 inline-flex justify-center items-center gap-2 rounded-md border border-transparent font-semibold bg-blue-500 text-white hover:bg-blue-600 focus:outline-none transition-all text-sm"
				{...rest}
			>
				{children}
			</button>
		)
	}
)