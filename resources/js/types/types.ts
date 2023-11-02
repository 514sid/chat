export interface BotResource {
	name: string;
	username: string;
	description: string | null;
	short_description: string | null;
	updates_retrieved_at: string | null;
}

export type ChatStatus = "kicked" | "member"

export interface ChatCollectionResource {
	id: number;
	status: ChatStatus
	bot: BotResource;
	first_name: string;
	last_name: string | null;
	// TODO: add latest update
}