import React, {useEffect, useState} from "react";
import axios from "axios";
import { useHistory} from "react-router-dom";

export default function Register() {
    const [data, setData] = useState();
    const [loaded, setLoaded] = useState(true);
    const [username, setUsername] = useState("");
    const [email, setEmail] = useState("");
    const [password, setPassword] = useState("");
    const [username_length, setUsername_length] = useState("");
    const [username_exists, setUsername_exists] = useState("");
    const [email_exists, setEmail_exists] = useState("");
    const [email_validate, setEmail_validate] = useState("");
    const [password_length, setPassword_length] = useState("");
    const url = 'http://localhost/N413/dayplanner/src/php/register.php';
    const history= useHistory();

    function handleSubmit() {
        setLoaded(false);
        axios.post(url, {
            username: username,
            email: email,
            password: password
        }).then(response => {
            console.log("Response: ");
            // console.log(response);
            setData(response.data);
            console.log("Data: ");
            console.log(data);

        });
    }
    if(!loaded) {
        if (data != undefined) {
            if (data.status == "1") {
                localStorage.setItem("token", JSON.stringify(data.token));
                history.push(`/success/2`);
            } else {
                if(data.username_length !== undefined) {setUsername_length(data.username_length)}
                if(data.username_exists !== undefined) {setUsername_exists(data.username_exists)}
                if(data.email_exists !== undefined) {setEmail_exists(data.email_exists)}
                if(data.email_validate !== undefined) {setEmail_validate(data.email_validate)}
                if(data.password_length !== undefined) {setPassword_length(data.password_length)}
                setLoaded(true);
            }
        }
    }



    useEffect(() => {
        const listener = event => {
            if (event.code === "Enter" || event.code === "NumpadEnter") {
                console.log("Enter key was pressed. Run your function.");
                event.preventDefault();
                handleSubmit();
            }
        };
        document.addEventListener("keydown", listener);

        return () => {
            document.removeEventListener("keydown", listener);
        };
    }, []);

    if (!loaded) {
        return (
            <div> Loading... </div>
        )
    } else {
        return (
            <div className={"account logout loading"}>
                <h1>Register</h1>
                <div id="form-container" >
                    <form id="register_form" >
                        <label htmlFor="username">User Name: </label>
                        <input type="text" id="username" name="username" className="form-control"
                                           value={username} onChange={e => setUsername(e.target.value)}
                                           placeholder="Enter User Name" required/>

                        <div id="username_length" className="error_msg">{username_length}</div>
                        <div id="username_exists" className="error_msg">{username_exists}</div>
                        <label htmlFor="email">E-mail: </label>
                        <input type="email" id="email" name="email"
                                                         className="form-control" value={email}
                                                         onChange={e => setEmail(e.target.value)}
                                                         placeholder="Enter E-mail" required/>
                        <div id="email_exists" className="error_msg">{email_exists}</div>
                        <div id="email_validate" className="error_msg">{email_validate}</div>
                        <label htmlFor="password">Password: </label>
                        <input type="password" id="password" name="password"
                                                           className="form-control" value={password}
                                                           onChange={e => setPassword(e.target.value)}
                                                           placeholder="Enter Password" required />
                        <div id="password_length" className="error_msg">{password_length}</div>

                        <div onClick={handleSubmit} id="submit" className="btn btn-info float-right">Submit</div>

                    </form>
                </div>

            </div>
        );
    }
}