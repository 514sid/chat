import { getChats } from "@/api/queries"
import { useQuery } from "@tanstack/react-query"
import { ChatListCard } from "./ChatListCard"

export const ChatList = () => {
	const { data: chats } = useQuery(getChats())

	return (
		<>
			<div className="py-2 px-5">
				Chats
			</div>
			<div className="p-2 py-0 grid grid-cols-1 gap-2">
				{chats && (
					chats.map((chat) => {
						return (
							<ChatListCard
								key={chat.id}
								chat={chat}
							/>
						)
					})
				)}
			</div>
		</>
	)
}
