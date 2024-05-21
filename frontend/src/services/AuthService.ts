import axios from "axios";
import { API_URL } from "../helpers/client";

export const AuthService = {


    async login(credentials: { email: string; password: string }) {
        try {
            const response = await axios.post(API_URL + "/login_check", credentials, {
                headers: {
                    "Content-Type": "application/json",
                },
            });
            
            return response.data;
        } catch (error) {
            console.error(
                "Une erreur s'est produite lors de l'authenrification :",
                error
            );
            return [];
        }
    },
    
};
