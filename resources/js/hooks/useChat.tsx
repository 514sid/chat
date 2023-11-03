import { ChatContext } from "@/providers/ChatProvider"
import { useContext } from "react"

export const useChat = () => {
	const context = useContext(ChatContext)

	if (context === undefined) {
		throw new Error("useChat must be used within a ChatProvider")
	}

	return context.chat
}