import { ChatCollectionResource, ChatResource } from "@/types/types"
import axios from "axios"

const sendGetChatsRequest = async (): Promise<ChatCollectionResource[]> => {
	const result = await axios.get("/api/chats")
	return result.data.data
}

export const getChats = () => ({
	queryKey: ["chats"],
	queryFn: async () => await sendGetChatsRequest(),
	refetchInterval: 3000,
})

const sendGetChatRequest = async (id: number): Promise<ChatResource> => {
	const result = await axios.get(`/api/chat/${id}`)
	return result.data
}

export const getChat = (id: number) => ({
	queryKey: ["chat", { id }],
	queryFn: async () => await sendGetChatRequest(id),
})