import { useState } from 'react';

export default function useToken() {
    // Get function
    const getToken = () => {
        const tokenUser = localStorage.getItem('token');
        const rolesUser = localStorage.getItem('roless');

        if (!tokenUser) {
            return null;
        }
        const userToken = JSON.parse(tokenUser);
        return userToken?.token
    };

    // Set function
    const [token, setToken] = useState(getToken());

    const saveToken = (userToken: { token: any; }) => {
        localStorage.setItem('token', JSON.stringify(userToken));
        setToken(userToken.token);
    };

    return {
        setToken: saveToken,
        token
    }
}