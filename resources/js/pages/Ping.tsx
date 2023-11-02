import { pingQuery } from "@/api/queries/pingQuery"
import { useQuery } from "@tanstack/react-query"

export const Ping = () => {
	const { data: ping } = useQuery(pingQuery())

	return (
		<>
			{ping && (
				<div>Pong</div>
			)}
		</>
	)
}
