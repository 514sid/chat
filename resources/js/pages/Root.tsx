import { Outlet } from "react-router-dom"
import { getCurrentUser } from "@/api/queries"
import { AuthProvider } from "@/providers"
import { useQuery } from "@tanstack/react-query"

export const Root = () => {
	const { data: auth } = useQuery(getCurrentUser())

	return (
		<>
			{auth && (
				<AuthProvider user={auth.user}>
					<Outlet />
				</AuthProvider>
			)}
		</>
	)
}
