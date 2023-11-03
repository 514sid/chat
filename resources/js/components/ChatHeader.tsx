import { useChat } from "@/hooks"

const ChatUsername = ({ username }: { username: string | null }) => {
	if (username) {
		return (
			<a
				href={`https://t.me/${username}`}
				target="_blank"
				className="text-sm text-blue-600"
			>
				@{username}
			</a>
		)
	} else {
		return (
			<div className="text-sm text-neutral-400">
				This user has no username
			</div>
		)
	}
}

export const ChatHeader = () => {
	const chat = useChat()

	return (
		<div className="border-b p-2">
			<div className="grid grid-cols-1 gap-1">
				<div>{chat.first_name}</div>
				<ChatUsername username={chat.username} />
			</div>
		</div>
	)
}