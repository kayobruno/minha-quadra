import axios, { AxiosResponse } from 'axios'
import { Response } from '../response/response.ts';

export class CustomerSerive {

    static async getCustomerByName(name: string): Promise<Response> {
      try {
        const response: AxiosResponse<Response> = await axios.get(`/api/customers?name=${name}`);
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
