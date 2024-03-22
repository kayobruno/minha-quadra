export interface BookingParams {
    customer_name: string,
    customer_document: string,
    when: string,
    start_time: string,
    end_time: string,
    court_id: number,
    sport: string,
    status: string,
    note?: string | null,
}
