import { ChatCollectionResource } from "@/types/types"
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
