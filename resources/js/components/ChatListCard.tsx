import { formatChatListDate } from "@/helpers"
import { ChatHistoryItemPreview } from "./ChatHistoryItemPreview"
import { Avatar } from "./Avatar"
import { NavLink } from "react-router-dom"
import { ChatCollectionResource } from "@/types/types"

interface ComponentProps {
	chat: ChatCollectionResource;
}

interface CardContentProps {
	chat: ChatCollectionResource;
	isActive: boolean;
}

const CardContent = ({ chat, isActive }: CardContentProps) => (
	<>
		<div className="shrink-0">
			<Avatar
				first_name={chat.first_name}
				last_name={chat.last_name} />
		</div>
		<div className="flex-1 min-w-0 w-auto">
			<div className="flex justify-between items-center">
				<div className="font-medium">
					{chat.first_name} {chat.last_name}
				</div>
				<div className={`${isActive ? "text-white" : "text-neutral-500"}`}>
					{formatChatListDate(chat.latest_update.date)}
				</div>
			</div>
			<div className={`${isActive ? "text-white" : "text-neutral-500"} mt-0.5 whitespace-nowrap overflow-hidden truncate ...`}>
				<ChatHistoryItemPreview
					type={chat.latest_update.item_type}
					item={chat.latest_update.item} />
			</div>
		</div>
	</>
)

export const ChatListCard = ({ chat }: ComponentProps) => {
	return (
		<NavLink
			to={`/chat/${chat.id}`}
			key={chat.id}
			draggable="false"
			className={({ isActive }) => [
				"p-3 text-sm flex items-center w-full gap-3 rounded select-none",
				isActive ? "bg-blue-600 text-white" : "hover:bg-neutral-100",
			].join(" ")}
		>
			{({ isActive }) => {
				return (
					<CardContent
						chat={chat}
						isActive={isActive}
					/>
				)
			}}
		</NavLink>
	)
}
