import { Home, Root, Chat, Login } from "./pages"
import { createBrowserRouter } from "react-router-dom"
import { Authenticated } from "./pages/middlewares"

export const router = createBrowserRouter([
	{
		path: "/",
		element: <Root />,
		children: [
			{
				element: <Authenticated />,
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
			},
			{
				path: "login",
				element: <Login />
			}
		],
	},
])