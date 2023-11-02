import { RouterProvider } from "react-router-dom";
import { router } from "./router";
import { queryClient } from "./queryClient";
import { QueryClientProvider } from "@tanstack/react-query";
import { ReactQueryDevtools } from "@tanstack/react-query-devtools"

export function App() {
	return (
		<QueryClientProvider client={queryClient}>
			<RouterProvider
				router={router}
			/>
			<ReactQueryDevtools
				initialIsOpen={false}
				buttonPosition="bottom-left"/>
		</QueryClientProvider>
	)
}