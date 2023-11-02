import React from "react"
import ReactDOM from "react-dom/client"
import { App } from "./App"
import "../css/app.css"

const app = ReactDOM.createRoot(
	document.getElementById("app") as HTMLElement
)

app.render(
	<React.StrictMode>
		<App />
	</React.StrictMode >
)