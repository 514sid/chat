export interface BotResource {
	name: string;
	username: string;
	description: string | null;
	short_description: string | null;
	updates_retrieved_at: string | null;
}

export type ChatStatus = "kicked" | "member"

export interface ChatStatusUpdateItem {
	status: ChatStatus;
}

export type ChatHistoryItems = ChatStatusUpdateItem

export type ChatHistoryItemType = "chat_status_update"

export interface ChatHistoryItemResource {
	id: number;
	date: string;
	item: ChatHistoryItems;
	item_type: ChatHistoryItemType;
}

export interface ChatCollectionResource {
	id: number;
	status: ChatStatus
	bot: BotResource;
	first_name: string;
	last_name: string | null;
	latest_update: ChatHistoryItemResource;
}

