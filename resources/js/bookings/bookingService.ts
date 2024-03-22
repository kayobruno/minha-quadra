import axios, { AxiosResponse } from 'axios'
import { BookingParams } from './bookingParams'
import { Response } from '../response/response.ts';

export class BookingService {

    static async getBookings(start: string | null, end: string | null): Promise<Response> {
      try {
        const response: AxiosResponse<Response> = await axios.get('/api/bookings', {
            params: { start, end }
        });
    
        return response.data.data;
      } catch (error) {
        return {
          success: false,
          message: error.response.data.message,
          data: error.response.data.data
        };
      }
    }

    static async getBooking(bookingId: string): Promise<Response> {
      try {
        const response: AxiosResponse<Response> = await axios.get(`/api/bookings/${bookingId}`);
    
        return response.data.data;
      } catch (error) {
        return {
          success: false,
          message: error.response.data.message,
          data: error.response.data.data
        };
      }
    }

    static async saveBooking(bookingParams: BookingParams): Promise<Response> {
      try {
        const response: AxiosResponse<Response> = await axios.post('/api/bookings', bookingParams);
        return response.data.data;
      } catch (error) {
        return {
            success: false,
            message: error.response.data.message,
            data: error.response.data.data
        };
      }
    }
}
