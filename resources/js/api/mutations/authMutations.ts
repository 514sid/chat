import { LoginData, UserResource } from "@/types/types"
import { useMutation, useQueryClient } from "@tanstack/react-query"
import axios, { AxiosResponse } from "axios"
import { useNavigate } from "react-router-dom"
import { getCurrentUser } from "@/api/queries"

export const sendLoginUserRequest = async ({ username, password }: LoginData): Promise<UserResource> => {
	const response: AxiosResponse<UserResource> = await axios.post("/login", { username, password })
	return response.data
}

export function useLoginMutation() {
	const queryClient = useQueryClient()
	const navigate = useNavigate()

	const mutation = useMutation({
		mutationFn: (data: LoginData) => sendLoginUserRequest(data),
		onSuccess: (data) => {
			queryClient.setQueryData(getCurrentUser().queryKey, { user: data })
			navigate("/")
		}
	})

	return mutation
}