import React, { useEffect, useState } from "react";
// import JobListComponent from "../components/JobListComponent";
import { useNavigate } from "react-router-dom";
import { getJobs } from "../../services/JobService";
import JobDetails from "./JobDetails";
import useToken from "../../utils/token";
import JobListComponent from "./JobListComponent";
import LoaderFullScreen from "../Loader/LoaderFullScreen";

interface Props { }

const JobList: React.FC<Props> = () => {
    const navigate = useNavigate();
    const [joblist, setJobList] = useState<any[]>();

    const { token, setToken } = useToken();

    const handleClick = (job: any) => {
        navigate("/details", { state: { id: job.id, details: job } });
    };

    useEffect(() => {
        const fetchJobs = async () => {
            getJobs().then((res) => setJobList(res));
        };

        fetchJobs();
    }, []);

    if (!joblist) {
        return <LoaderFullScreen /> 
    }

    return (
        <>
            <div className="flex h-screen overflow-y-scroll items-center justify-center bg-white px-6 md:px-60">
                <div className="space-y-6 border-l-2 border-dashed">
                    {joblist
                        ? joblist.map((job, index) => (
                            <JobListComponent
                                key={index}
                                customer={job.customer}
                                title={job.title}
                                status={job.status}
                                createdAt={job.createdAt}
                                onClick={() => handleClick(job)} />
                        ))
                        : null}
                </div>
            </div>
        </>
    );
};

export default JobList;
