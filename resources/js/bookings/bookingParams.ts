export interface BookingParams {
    name: string,
    phone: string,
    when: string,
    start_time: string,
    end_time: string,
    court_id: number,
    sport: string,
    status: string,
    note?: string | null,
}
