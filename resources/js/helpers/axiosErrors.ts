import axios, { AxiosError } from "axios"

export const isNotFoundError = (error: Error): error is AxiosError => {
	if (axios.isAxiosError(error)) {
		return error.response?.status === 404
	}

	return false
}

export const isUnauthorizedError = (error: Error): error is AxiosError => {
	if (axios.isAxiosError(error)) {
		return error.response?.status === 401
	}

	return false
}
