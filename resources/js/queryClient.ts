import { MutationCache, QueryCache, QueryClient } from "@tanstack/react-query"
import { isAxiosError } from "axios"
import { router } from "./router"
import { isUnauthorizedError } from "./helpers"

const handleError = (error: Error) => {
	if (isUnauthorizedError(error)) {
		queryClient.removeQueries()
		router.navigate("/login")
	}
}

export const queryClient = new QueryClient({
	defaultOptions: {
		queries: {
			// Custom retry policy by RodolfoSilva (https://github.com/RodolfoSilva)
			// Source: https://github.com/TanStack/query/discussions/372#discussioncomment-6023276
			retry: (failureCount, error) => {
				if (failureCount > 3) {
					return false
				}

				if (isAxiosError(error) && [400, 401, 403, 404].includes(error.response?.status || 0)) {
					return false
				}

				return true
			},
		},
	},
	queryCache: new QueryCache({
		onError: handleError
	}),
	mutationCache: new MutationCache({
		onError: handleError
	})
})