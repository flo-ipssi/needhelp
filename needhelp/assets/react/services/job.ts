import axios from "axios";

export const getJobs = async () => {
    try {
        const response = await axios.get('http://localhost:8000/jobs');
        return response.data;
    } catch (error) {
        return false;
    }
}