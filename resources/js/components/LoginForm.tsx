import { StringInput } from "@/components/inputs"
import { BaseButton } from "@/components/buttons"
import { useLoginMutation } from "@/api/mutations/authMutations"
import { SubmitHandler, useForm } from "react-hook-form"
import { LoginData } from "@/types/types"
import { useEffect } from "react"
import { useLaravelValidationErrors } from "@/hooks"

const CreateRootCommand = ({ isVisible }: { isVisible: boolean }) => {
	if (isVisible) {
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
	const login = useLoginMutation()

	const validationErrors = useLaravelValidationErrors<LoginData>(login.error)

	const { register, handleSubmit, setError, formState: { errors } } = useForm<LoginData>()

	const onSubmit: SubmitHandler<LoginData> = data => login.mutate(data)

	useEffect(() => {
		if(validationErrors) {
			Object.keys(validationErrors).forEach((field) => {
				setError(field as keyof LoginData, {
					type: "manual",
					message: validationErrors[field][0],
				})
			})
		}
	}, [validationErrors, setError])

	return (
		<div className="w-[336px]">
			<form onSubmit={handleSubmit(onSubmit)}>
				<div className="grid grid-cols-1 gap-5">
					<StringInput
						type="text"
						placeholder="Username"
						{...register("username")}
					/>
					<StringInput
						type="password"
						placeholder="Password"
						{...register("password")}
					/>
					<BaseButton>
						Continue
					</BaseButton>
				</div>
			</form>
			<CreateRootCommand isVisible={true} />
		</div>
	)
}
