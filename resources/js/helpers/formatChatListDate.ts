import dayjs from "dayjs";

export function formatChatListDate(datetimeString: string): string {
	const inputDate = dayjs(datetimeString);
	const today = dayjs();
	const is24HourFormat = is24HourTimeFormat();

	if (isToday(inputDate, today)) {
		return formatTime(inputDate, is24HourFormat);
	}

	if (isWithinLastWeek(inputDate, today)) {
		return formatDayOfWeek(inputDate);
	}

	return formatDate(inputDate);
}

function is24HourTimeFormat(): boolean {
	const hr = new Intl.DateTimeFormat(undefined, { hour: "numeric" }).format();
	return Number.isInteger(Number(hr));
}

function isToday(inputDate: dayjs.Dayjs, today: dayjs.Dayjs): boolean {
	return inputDate.isSame(today, "day");
}

function isWithinLastWeek(inputDate: dayjs.Dayjs, today: dayjs.Dayjs): boolean {
	return inputDate.isAfter(today.subtract(7, "day"));
}

function formatTime(inputDate: dayjs.Dayjs, is24HourFormat: boolean): string {
	return inputDate.format(is24HourFormat ? "HH:mm" : "h:mm A");
}

function formatDayOfWeek(inputDate: dayjs.Dayjs): string {
	return inputDate.format("ddd");
}

function formatDate(inputDate: dayjs.Dayjs): string {
	return inputDate.format("MM/DD/YY");
}
