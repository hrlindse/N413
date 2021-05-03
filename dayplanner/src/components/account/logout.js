import React, {useState} from "react";
import axios from "axios";
import { useHistory} from "react-router-dom";

export default function Success(props) {
    const [data, setData] = useState();
    const [loaded, setLoaded] = useState(true);

    const history= useHistory();

    if(localStorage.getItem("token") !== null && localStorage.getItem("token") != undefined) {
        console.log("Logging out");
        console.log(localStorage.removeItem("token"));
        props.setLogin(false);
        history.push(`/success/3`);

    } else {
        console.log("already logged out");
        props.setLogin(false);
        history.push(`/success/3`);

    }


    return (
        <div className={"account logout loading"}>
            Loading...
        </div>
    );
    // }
}