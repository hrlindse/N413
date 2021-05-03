import React from "react";
import {Link} from "react-router-dom";

export default function Home() {
    return (
        <div className={"home"}>
            <h1>Home</h1>
            <div>
                Welcome to Day Planner!
            </div>
            <div>
                <Link to={"/login"}>Log in</Link> or <Link to={"/register"}>register</Link> to get started
            </div>
        </div>
    );
}

