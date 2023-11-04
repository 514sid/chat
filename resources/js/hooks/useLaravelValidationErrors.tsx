import { AxiosError } from "axios"
import { isUnprocessableContentError } from "@/helpers"
import { LaravelValidationErrors, LaravelValidationErrorData } from "@/types/types"

export function useLaravelValidationErrors<T>(error: Error | null) {
	let errors: LaravelValidationErrors<T> | null = null

	if (error && isUnprocessableContentError(error)) {
		const axiosError = error as AxiosError
		const laravelValidationErrorData = axiosError.response?.data as LaravelValidationErrorData<T>
		errors = laravelValidationErrorData.errors
	}

	return errors
}