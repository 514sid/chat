import { Auth } from "@/types/types"
import axios from "axios"

const sendGetCurrentUserRequest = async (): Promise<Auth> => {
	const result = await axios.get("/api/user")
	return result.data
}

export const getCurrentUser = () => ({
	queryKey: ["auth"],
	queryFn: async () => await sendGetCurrentUserRequest(),
})