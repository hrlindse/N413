import React, {useState} from "react";
import axios from "axios";
import { useHistory, useParams} from "react-router-dom";

export default function Success() {
    const [data, setData] = useState();
    const [loaded, setLoaded] = useState(false);
    const [message, setMessage] = useState("");
    let { id } = useParams();


    if(!loaded){
        switch (id) {
            case "1": setMessage("Successful login")
                break;
            case "2": setMessage("Registered and logged in")
                break;
            case "3": setMessage("Successfully logged out")
                break;
            default:
                setMessage("Success")
        }
        setLoaded(true);
    }

    const history= useHistory();

    return (
        <div className={"success"}>
            {!loaded ?
                <div className={"loading"}>
                    Loading...
                </div>
            :
                <div className={"successMessage"}>
                    {message}
                </div>
            }
        </div>
    );
    // }
}