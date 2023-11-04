import { ChatList } from "@/components"
import { Outlet } from "react-router-dom"

export const Home = () => {
	return (
		<>
			<div className="w-[368px] border-r">
				<ChatList />
			</div>
			<div className="flex-1">
				<Outlet />
			</div>
		</>
	)
}
