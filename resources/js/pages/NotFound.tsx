import { useAuth } from "@/hooks"
import { AuthLayout } from "@/pages"
import { ArrowPathIcon } from "@heroicons/react/24/outline"
import { useState } from "react"

const quotes = [
	{
		movie: "Scarface",
		quote: "Say hello to my little error."
	},
	{
		movie: "Fight Club",
		quote: "The first rule of page not found: You do not talk about page not found."
	},
	{
		movie: "The Godfather",
		quote: "Leave the page, take the cannoli."
	},
	{
		movie: "The Dark Knight",
		quote: "Why so page not found?"
	},
	{
		movie: "Star Wars: Episode IV - A New Hope",
		quote: "May the page not found be with you."
	},
	{
		movie: "The Social Network",
		quote: "You don't get to 500 pages without encountering a few errors."
	},
	{
		movie: "Finding Nemo",
		quote: "Just keep swimming... until you find the right page."
	},
	{
		movie: "Harry Potter and the Sorcerer's Stone",
		quote: "You're a wizard, Harry... but even wizards can't find this page."
	},
	{
		movie: "The Lion King",
		quote: "Hakuna Matata! It means no page found."
	},
	{
		movie: "The Hangover",
		quote: "What happens in Vegas stays in Vegas... including this page."
	},
	{
		movie: "The Hunger Games",
		quote: "May the odds be ever in your favor... in finding the right page."
	},
	{
		movie: "The Wolf of Wall Street",
		quote: "I'm not leaving this page! I'm not leaving it!"
	},
	{
		movie: "Inception",
		quote: "We need to go deeper... into finding this page."
	},
	{
		movie: "The Matrix",
		quote: "There is no page."
	},
	{
		movie: "Apollo 13",
		quote: "Houston, we have a problem... with this page."
	},
]

const getQuote = () => quotes[Math.floor(Math.random() * quotes.length)]

const NotFoundComponent = () => {
	const [quote, setQuote] = useState(getQuote)

	return (
		<div className="w-full h-screen flex items-center justify-center bg-gradient-to-t from-white via-slate-50 to-slate-100">
			<div className="text-center w-full max-w-prose">
				<div className="text-xl font-bold">{quote.quote}</div>
				<div className="mt-3 text-neutral-400">{quote.movie}</div>
				<button
					className="mt-5"
					onClick={() => setQuote(getQuote)}
				>
					<ArrowPathIcon className="w-6 h-6 text-neutral-200 hover:text-neutral-300 transition"/>
				</button>
			</div>
		</div>
	)
}

export const NotFound = () => {
	const auth = useAuth()

	if (auth.user) {
		return (
			<AuthLayout>
				<NotFoundComponent />
			</AuthLayout>
		)
	} else {
		return (
			<NotFoundComponent />
		)
	}
}
