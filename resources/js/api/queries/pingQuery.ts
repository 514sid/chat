import axios from "axios"

const sendPingRequest = async (): Promise<"pong"> => {
	const result = await axios.get("/api/ping")
	return result.data
}

export const pingQuery = () => ({
	queryKey: ["ping"],
	queryFn: async () => await sendPingRequest(),
})
