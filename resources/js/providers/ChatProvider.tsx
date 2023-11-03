import { ChatResource } from "@/types/types"
import React, { ReactNode, createContext } from "react"

type ProviderProps = {
	chat: ChatResource
	children: ReactNode
}

type ContextProps = {
	chat: ChatResource
}

export const ChatContext = createContext<ContextProps | undefined>(undefined)

export const ChatProvider: React.FC<ProviderProps> = ({ chat, children }) => {
	return (
		<ChatContext.Provider value={{ chat }}>
			{children}
		</ChatContext.Provider>
	)
}
