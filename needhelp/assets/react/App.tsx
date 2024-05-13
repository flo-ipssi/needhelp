
import React from 'react';
import { Routes, Route } from 'react-router-dom';
import JobList from './pages/JobList';
import JobDetails from './pages/JobDetails';
interface Props {
}
const App: React.FC<Props> = ({ }) => {
    return (
        <>
            <Routes>
                <Route path="/" element={<JobList />} />
                <Route path="/details" element={<JobDetails />} />
            </Routes>
        </>
    );
};

export default App;