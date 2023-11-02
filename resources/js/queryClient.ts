import { MutationCache, QueryCache, QueryClient } from "@tanstack/react-query"
import axios, { AxiosError } from "axios"
// import { router } from "./router"

const handleAxiosError = (error: AxiosError) => {
	if (error.response && error.response.status === 401) {
		queryClient.removeQueries()
		// router.navigate("/login")
	}
}

export const queryClient = new QueryClient({
	queryCache: new QueryCache({
		onError: (error) => {
			if (axios.isAxiosError(error)) {
				handleAxiosError(error as AxiosError)
			}
		},
	}),
	mutationCache: new MutationCache({
		onError: (error) => {
			if (axios.isAxiosError(error)) {
				handleAxiosError(error as AxiosError)
			}
		},
	})
})
