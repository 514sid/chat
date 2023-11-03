import { ChatHistoryItemType, ChatHistoryItems, ChatStatusUpdateItem } from "@/types/types"

interface ChatHistoryItemPreviewProps {
	type: ChatHistoryItemType;
	item: ChatHistoryItems;
}

export const ChatHistoryItemPreview = ({
	type,
	item
}: ChatHistoryItemPreviewProps) => {
	switch (type) {
	case "chat_status_update":
		return (
			<ChatStatusUpdate item={item} />
		)
	}
}

interface ChatStatusUpdateProps {
	item: ChatStatusUpdateItem;
}

const ChatStatusUpdate = ({ item }: ChatStatusUpdateProps) => {
	let message

	switch (item.status) {
	case "member":
		message = "User has joined the chat"
		break
	case "kicked":
		message = "User has left the chat"
		break
	default:
		message = "Unknown status update"
		break
	}

	return (
		<>{message}</>
	)
}