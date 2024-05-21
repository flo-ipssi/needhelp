import { API_URL } from "../helpers/client";
import axiosInstance from "../utils/axiosConfig";

const getToken = () => {
  const token = localStorage.getItem("token");
  if (!token) {
    throw new Error("No token found");
  }
  return JSON.parse(token);
};

export const getJobs = async () => {
  try {
    const { token } = getToken();

    const response = await axiosInstance.get(API_URL + "/jobs", {
      headers: {
        Authorization: `Bearer ${token}`,
      },
    });

    return response.data;
  } catch (error) {
    console.error("Error:", error);
    return false;
  }
};

export const applyToJob = async (jobId: any, price: any) => {
  try {
    const tokenUser = localStorage.getItem('token');
    if (!tokenUser) {
        return null;
    }
    const userToken = JSON.parse(tokenUser);

    const response = await axiosInstance.post(`/job/${jobId}/apply`, {
      price
    }, {
      headers: {
        Authorization: `Bearer ${userToken?.token}`
      }
    });
    return response.data;
  } catch (error) {
    console.error("Error applying to job:", error);
    throw error;
  }
}
