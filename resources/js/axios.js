import axios from "axios";
const axiosClient = axios.create({
    baseURL: "/api",
});

axiosClient.interceptors.request.use((config) => {
    config.headers.Authorization = `Bearer ${localStorage.getItem("TOKEN")}`;
    return config;
});

export default axiosClient;
