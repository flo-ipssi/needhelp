import axios from "axios";
import { API_URL } from "../helpers/client";

const axiosInstance = axios.create({
    baseURL: API_URL,
    headers: {
        'Content-Type': 'application/json',
    },
});

// axiosInstance.interceptors.response.use(
//     response => response,
//     error => {
//         if (error.response && error.response.status === 401) {
//             // localStorage.removeItem('token');
//             // window.location.href = '/login'; 
//         }
//         return Promise.reject(error);
//     }
// );

export default axiosInstance;
