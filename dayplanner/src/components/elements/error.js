import React, {useState} from "react";
import { Link, useHistory, useParams} from "react-router-dom";

export default function Error() {
    const [loaded, setLoaded] = useState(false);
    const [message, setMessage] = useState("");

    let { id } = useParams();

    if(id == "login"){
        return (
            <div className={"error"}>
                <h1>Login error</h1>
                There seems to have been an issue logging in.
                <Link to={"/login"}>Return to login</Link>
                <Link to={"/"}>Return to home</Link>
            </div>
        )
    } else if(id == "register") {
        return (
            <div className={"error"}>
                <h1>Registration error</h1>
                There seems to have been an issue creating your account.
                <Link to={"/register"}>Return to register</Link>
                <Link to={"/"}>Return to home</Link>
            </div>
        )
    } else {
        return (
            <div className={"error"}>
                <h1>Something went wrong</h1>
                <Link to={"/"}>Return to home</Link>
            </div>

        )
    }

}