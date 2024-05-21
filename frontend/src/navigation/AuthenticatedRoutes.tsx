
import React from 'react';
import { Navigate, Route, Routes } from 'react-router-dom';
import JobList from '../components/Job/JobList';
import JobDetails from '../components/Job/JobDetails';
import useToken from '../utils/token';
import Login from '../components/Login/Login';

const AuthenticatedRoutes = () => {
  
  const { token, setToken } = useToken();
  
  if (!token) {
    return <Login handleToken={setToken} />;
  }
  
  return (
    <Routes>
      <Route path="/login" element={<Navigate to="/jobs" />} />
      <Route path="/" element={<Navigate to="/jobs" />} />
      <Route path="/jobs" element={<JobList />} />
      <Route path="/details" element={<JobDetails />} />
    </Routes>
  );
};

export default AuthenticatedRoutes;