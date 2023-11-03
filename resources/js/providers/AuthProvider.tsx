import { Auth, UserResource } from "@/types/types"
import React, { ReactNode, createContext } from "react"

type ProviderProps = {
	user: UserResource | null
	children: ReactNode
}

export const AuthContext = createContext<Auth | undefined>(undefined)

export const AuthProvider: React.FC<ProviderProps> = ({ user, children }) => {
	return (
		<AuthContext.Provider value={{ user }}>
			{children}
		</AuthContext.Provider>
	)
}
