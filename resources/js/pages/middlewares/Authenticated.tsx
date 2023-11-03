import { useAuth } from "@/hooks"
import { Navigate, Outlet } from "react-router-dom"

export const Authenticated = () => {
	const auth = useAuth()

	if(!auth.user) {
		return <Navigate to="/login" />
	} else {
		return <Outlet />
	}
}
