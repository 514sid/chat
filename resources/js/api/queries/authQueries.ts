import { Auth } from "@/types/types"
import axios from "axios"

const sendGetCurrentUserRequest = async (): Promise<Auth> => {
	const result = await axios.get("/api/user")
	return {
		user: result.data ?? null
	}
}

export const getCurrentUser = () => ({
	queryKey: ["auth"],
	queryFn: async () => await sendGetCurrentUserRequest(),
})