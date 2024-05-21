import React, { useEffect, useState } from "react";
import { useLocation, useNavigate } from "react-router-dom";
import { applyToJob } from "../../services/JobService";
import Loader from "../Loader/Loader";
interface Props { }

type JobFormat = {
  id: number;
  title: string;
  status: string;
  description: string | null;
  createdAt: string;
};

const JobDetails: React.FC<Props> = () => {
  const location = useLocation();
  const navigate = useNavigate();
  const [job, setJob] = useState<JobFormat>();
  const [amount, setAmount] = useState("");
  const [isSubmitting, setIsSubmitting] = useState<boolean>(false);


  const handleClick = () => {
    navigate(-1);
  };

  const handleApply = async (jobId: any) => {
    if (!amount) {
      alert("amount missing");
      return false;
    }
    setIsSubmitting(true);
    try {
      await applyToJob(jobId, amount);
      alert("Offer send successfully");
    } catch (error) {
      alert("Failed to apply");
    }
    setIsSubmitting(false);
  };

  useEffect(() => {
    setJob(location.state.details);
  }, [location]);

  if (!job) {
    return <div>Chargement...</div>;
  }

  return (
    <>
      <div className="flex h-screen items-center justify-center  px-6 md:px-60">
        <div className="space-y-6 border-l-2 border-dashed">
          <div className="max-w-md w-full p-6 bg-white rounded-lg shadow-lg">
            <div className="flex justify-center mb-8">
              <img
                src="https://img.freepik.com/vecteurs-libre/vecteur-degrade-logo-colore-oiseau_343694-1365.jpg?size=338&ext=jpg&ga=GA1.1.1413502914.1714953600&semt=sph"
                alt="Logo"
                className="w-30 h-20"
              />
            </div>
            <h1 className="text-2xl font-semibold text-center text-gray-500 mt-8 mb-6">
              {job?.title}
            </h1>
            <p className="text-sm text-gray-600 text-justify mt-8 mb-6">
              {job?.description}
            </p>

            <div className="text-sm text-center text-gray-600  mt-8 mb-6">
              <input
                type="number"
                placeholder="Faites une offre pour postuler"
                value={amount}
                onChange={(e) => setAmount(e.target.value)}
              />
            </div>
            {isSubmitting ? <Loader /> :
              <div className="flex justify-center space-x-4 my-4">
                <button
                  onClick={() => handleClick()}
                  className="bg-gradient-to-r from-cyan-400 to-cyan-600 text-white px-4 py-2 rounded-md w-1/3"
                >
                  Retour
                </button>
                {job?.status === "en cours" ? null : (
                  <button onClick={() => handleApply(job.id)} className="bg-gradient-to-r from-cyan-400 to-cyan-600 text-white px-4 py-2 rounded-md w-1/3">
                    Postuler
                  </button>
                )}
              </div>}
            <div className="text-center">
              <span className="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">
                {job?.status}
              </span>
            </div>
            <p className="text-xs text-gray-600 text-center mt-8">
              {job?.createdAt
                ? new Date(job?.createdAt).toLocaleDateString("fr-FR")
                : null}
            </p>
          </div>
        </div>
      </div>
    </>
  );
};

export default JobDetails;
