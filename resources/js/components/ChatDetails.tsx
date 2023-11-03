import { useChat } from "@/hooks"
import dayjs from "dayjs"
import relativeTime from "dayjs/plugin/relativeTime"

dayjs.extend(relativeTime)

export const ChatDetails = () => {
	const chat = useChat()

	return (
		<>
			<div className="grid grid-cols-1 gap-2">
				<div>
					<div className="text-sm text-neutral-500">Created</div>
					{dayjs(chat.created_at).fromNow()}
				</div>
				<div>
					<div className="text-sm text-neutral-500">Bot</div>
					<div>
						{chat.bot.name}
					</div>
					<div className="text-sm">
						<a
							href={`https://t.me/${chat.bot.username}`}
							target="_blank"
							className="text-blue-600"
						>
							@{chat.bot.username}
						</a>
					</div>
				</div>
			</div>
		</>
	)
}
