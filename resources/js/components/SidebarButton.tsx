import { ReactNode } from "react"
import { NavLink } from "react-router-dom"

interface ComponentProps {
	to: string;
	children: ReactNode;
}

export const SidebarButton = ({to, children}: ComponentProps) => {
	return (
		<NavLink
			to={to}
			className={({ isActive }) => [
				"w-10 h-10 flex items-center justify-center rounded",
				isActive ? "bg-slate-800 text-blue-600" : "hover:bg-slate-800 text-slate-700 hover:text-blue-600",
			].join(" ")}
			draggable={false}
		>
			{children}
		</NavLink>
	)
}
