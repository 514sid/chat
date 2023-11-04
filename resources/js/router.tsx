import { Home, Root, Chat, Login, AuthLayout } from "./pages"
import { createBrowserRouter } from "react-router-dom"
import { Authenticated } from "./pages/middlewares"
import { NotFound } from "./pages/NotFound"

export const router = createBrowserRouter([
	{
		element: <Root />,
		children: [
			{
				element: <Authenticated />,
				children: [
					{
						element: <AuthLayout />,
						children: [
							{
								path: "",
								element: <Home />,
								children: [
									{
										path: "chat/:chat_id",
										element: <Chat />,
									}
									
								]
							},
						]
					}
				]
			},
			{
				path: "login",
				element: <Login />
			},
			{
				path: "*",
				element: <NotFound />
			}
		],
	},
])