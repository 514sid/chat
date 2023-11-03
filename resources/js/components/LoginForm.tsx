import { StringInput } from "@/components/inputs"
import { BaseButton } from "@/components/buttons"

const CreateRootCommand = ({ isVisible }: { isVisible: boolean }) => {
	if(isVisible) {
		return (
			<div className="my-10">
				<div className="text-sm text-center mb-2">
					If you don't have login credentials, you can create a root user by executing this command in the root directory of this app:
				</div>
				<div className="bg-slate-900 rounded text-white font-mono px-3 py-2 text-sm h-12 flex items-center w-full justify-center">
					php artisan root:create
				</div>
			</div>
		)
	}
}

export const LoginForm = () => {
	return (
		<div className="w-[336px]">
			<div className="grid grid-cols-1 gap-5">
				<StringInput
					type="text"
					placeholder="Username"
				/>
				<StringInput
					type="password"
					placeholder="Password"
				/>
				<BaseButton>
					Continue
				</BaseButton>
			</div>
			<CreateRootCommand isVisible={true}/>
		</div>
	)
}
