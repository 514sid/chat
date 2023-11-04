import { BotResource } from "@/types/types"
import axios from "axios"

const sendGetBotsRequest = async (): Promise<BotResource[]> => {
	const result = await axios.get("/api/bots")
	return result.data.data
}

export const getBots = () => ({
	queryKey: ["bots"],
	queryFn: async () => await sendGetBotsRequest(),
})