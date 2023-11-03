import { getChat } from "@/api/queries"
import { ChatDetails, ChatHeader, ChatNotFound, ChatLoader } from "@/components"
import { isNotFoundError } from "@/helpers"
import { ChatProvider } from "@/providers"
import { useQuery } from "@tanstack/react-query"
import { useParams } from "react-router-dom"

export const Chat = () => {
	const { chat_id } = useParams()
	const { data: chat, error, isLoading } = useQuery(getChat(parseInt(chat_id!)))

	const renderChatContent = () => {
		if (isLoading) {
			return <ChatLoader />
		}

		if (chat) {
			return (
				<ChatProvider chat={chat}>
					<div className="w-full flex">
						<div className="flex-1">
							<ChatHeader />
						</div>
						<div className="w-[336px] border-l h-screen p-2">
							<ChatDetails />
						</div>
					</div>
				</ChatProvider>
			)
		}

		if (error) {
			if (isNotFoundError(error)) {
				return <ChatNotFound />
			}
		}
	}

	return <>{renderChatContent()}</>
}