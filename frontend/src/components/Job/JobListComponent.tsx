import React from "react";

interface Props {
  title: string;
  status: string;
  customer: {
    username : string;
  };
  createdAt?: string;
  onClick?(): void;
}

const JobListComponent: React.FC<Props> = ({
  title,
  status,
  customer,
  createdAt,
  onClick,
}) => {

  
  const statusClassColor = {
    className: status === "en cours" ? "text-red-500" : "text-blue-500",
  };

  return (
    <div className="relative w-full">
      <svg
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 24 24"
        fill="currentColor"
        className={`absolute -top-0.5 z-10 -ml-3.5 h-7 w-7 rounded-full  ${statusClassColor.className}`}
      >
        <path
          fillRule="evenodd"
          d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z"
          clipRule="evenodd"
        />
      </svg>
      <div className="ml-6">
        <h4 className={`font-bold capitalize  ${statusClassColor.className}`}>
          {title}
        </h4>
        
        <h3 className={`font-bold capitalize  ${statusClassColor.className}`}>
          Client : {customer?.username}
        </h3>
        {createdAt ? (
          <span
            className={`mt-1 block text-sm font-semibold   ${statusClassColor.className}`}
          >
            {new Date(createdAt).toLocaleDateString("fr-FR")}
          </span>
        ) : null}

        {status === "en cours" ? null : (
          <button
            onClick={onClick}
            className="bg-transpaent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded"
          >
            Voir
          </button>
        )}
      </div>
    </div>
  );
};

export default JobListComponent;
