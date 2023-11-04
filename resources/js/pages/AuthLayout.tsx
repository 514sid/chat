import { useAuth } from "@/hooks"
import { Outlet } from "react-router-dom"
import { SidebarButton } from "@/components"
import { ChatBubbleLeftRightIcon, Cog6ToothIcon, UsersIcon } from "@heroicons/react/24/outline"
import { ReactNode } from "react"

interface ComponentProps {
	children?: ReactNode
}

export const AuthLayout = ({ children }: ComponentProps) => {
	const auth = useAuth()

	return (
		<div className="flex w-full min-h-screen">
			<div className="w-[60px] p-[10px] bg-black flex flex-col gap-3">
				<SidebarButton to="/">
					<ChatBubbleLeftRightIcon className="h-6 w-6" />
				</SidebarButton>
				{auth.user!.role === "root" && (
					<>
						<SidebarButton to="/bots">
							<Cog6ToothIcon className="h-6 w-6" />
						</SidebarButton>
						<SidebarButton to="/users">
							<UsersIcon className="h-6 w-6" />
						</SidebarButton>
					</>
				)}
			</div>
			{children || <Outlet />}
		</div>
	)
}
