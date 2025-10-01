import { useNavigate } from "react-router-dom"

export const NoDataFound = () => {
    const navigate = useNavigate();
    const handleNavigateBackClick = () => navigate('/');

    return (
        <div className="flex flex-col justify-center items-center gap-10">
            <div className="flex flex-row gap-2 items-center">
                <div className="text-6xl">⚠️</div>
                <div className="text-2xl">No Data Found!</div>
            </div>
            <button onClick={handleNavigateBackClick} className="bg-blue-500 text-white p-2 px-10"> Return Home </button>
        </div>
    )

}