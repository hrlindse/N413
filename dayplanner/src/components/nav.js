import React, {useEffect, useState} from "react";
import {
    Link
} from "react-router-dom";

export default function Nav(props) {
    const [loaded, setLoaded] = useState(false);

    if (!loaded) {
        props.checkLogin();
        setLoaded(true);
    }


    useEffect(() => {
        // Update the logged in status
        console.log("in nav");
        return props.checkLogin();
    });

    if (!loaded) {
        return (
            <div> Loading... </div>
        )
    } else {
        return (
            <div className="nav">
                <Link to={"/"} className={"brand-link"}>
                    <div className="brand">Day Planner</div>
                </Link>
                <ul>
                    {!props.loggedin ? [
                            <li>
                                <Link to="/home">Home</Link>
                            </li>,
                            <li>
                                <Link to="/login">Login</Link>
                            </li>,
                            <li>
                                <Link to="/register">Register</Link>
                            </li>
                        ]
                        :
                        [
                            <li>
                                <Link to="/week">Week</Link>
                            </li>,
                            <li>
                                <Link to="/logout">Logout</Link>
                            </li>
                        ]
                    }

                </ul>
            </div>
        );
    }
}
