import { ChatList } from "@/components"
import { Outlet } from "react-router-dom"

export const Home = () => {
	return (
		<>
			<div className="flex w-full">
				<div className="w-[368px] border-r h-screen">
					<ChatList />
				</div>
				<div className="flex-1">
					<Outlet />
				</div>
			</div>
		</>
	)
}
