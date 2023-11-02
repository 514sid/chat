import { getChats } from "@/api/queries"
import { useQuery } from "@tanstack/react-query"

export const ChatList = () => {
	const { data: chats } = useQuery(getChats())
	
	return (
		<>
			{chats && (
				chats.map((chat) => {
					return (
						<div>
							{chat.first_name}
						</div>
					)
				})
			)}
		</>
	)
}
