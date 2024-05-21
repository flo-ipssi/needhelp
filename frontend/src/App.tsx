import "./App.css";
import React, { useEffect } from "react";
import { BrowserRouter, Route, Routes, Navigate } from "react-router-dom";
import Login from "./components/Login/Login";
import useToken from "./utils/token";
import AuthenticatedRoutes from "./navigation/AuthenticatedRoutes";

function App() {
  const { token, setToken } = useToken();
  
  if (!token) {
    return <Login handleToken={setToken} />;
  }
  
  return (
    <BrowserRouter>
      <AuthenticatedRoutes />
    </BrowserRouter>
  );
}

export default App;
