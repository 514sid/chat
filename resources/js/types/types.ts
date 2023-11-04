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

export interface ChatResource {
	id: number;
	status: ChatStatus
	bot: BotResource;
	first_name: string;
	last_name: string | null;
	created_at: string;
	username: string | null;
}

export interface ChatCollectionResource extends Omit<ChatResource, "created_at"> {
	latest_update: ChatHistoryItemResource;
}

export type UserRole = "root" | "user"

export interface UserResource {
	id: number;
	username: string;
	role: UserRole;
}

export interface Auth {
	user: UserResource | null
}

export interface LoginData {
	username: string;
	password: string;
}

export type LaravelValidationErrors<T> = {
	[K in keyof T]: string[];
} & {
	[key: string]: string[];
};

export interface LaravelValidationErrorData<T> {
	message: string;
	errors: LaravelValidationErrors<T>
}

