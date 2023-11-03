import { CSSProperties } from "react"

interface ComponentProps {
	first_name: string;
	last_name: string | null;
	size?: number;
}

export const Avatar = ({
	first_name,
	last_name,
	size = 45,
}: ComponentProps) => {
	const firstNameInitial = first_name.charAt(0).toUpperCase()
	const lastNameInitial = last_name ? last_name.charAt(0).toUpperCase() : ""

	const avatarStyle: CSSProperties = {
		width: `${size}px`,
		height: `${size}px`,
	}

	return (
		<div
			className={"rounded-full flex items-center justify-center text-lg leading-3 text-white bg-blue-400"}
			style={avatarStyle}
		>
			<div>{`${firstNameInitial}${lastNameInitial}`}</div>
		</div>
	)
}