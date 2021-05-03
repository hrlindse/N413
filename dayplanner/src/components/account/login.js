import React, {useState, useEffect} from "react";
import axios from "axios";
import { useHistory} from "react-router-dom";
import PhpUrl from "../elements/phpurl";

export default function Login(props) {
    const [data, setData] = useState();
    const [loaded, setLoaded] = useState(true);
    const [username, setUsername] = useState("");
    const [password, setPassword] = useState("");
    const [failed, setFailed] = useState("");
    const url = PhpUrl() + 'php/auth.php';
    const history= useHistory();

    function handleSubmit() {
        setLoaded(false);
        axios.post(url, {
            username: username,
            password: password
        }, { withCredentials: true }).then(response => {
            // console.log("Response: ");
            console.log(response);
            setData(response.data);
            // console.log("Data: ");
            // console.log(data);
            if (response.data.status == 1) {
                localStorage.setItem("token", JSON.stringify(response.data.token));
                props.setLogin(true);
                history.push(`/success/1`);
        }}).catch(() => {
            console.log('Incorrect Login Info');
            history.push(`/error/login`);
        });
    }

    if(!loaded) {
        if (data != undefined) {
            if (data.status == "1") {
                localStorage.setItem("token", JSON.stringify(data.token));
                history.push(`/success/1`);
            } else {
                if(data.failed !== undefined) {setFailed(data.failed)}
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
            <div className={"account login"}>
                <h1>Login</h1>
                <div id="form-container">
                    <form>
                        <label htmlFor="username">User Name: </label>
                        <input type="text" id="username" name="username"
                               className="form-control" value={username} onChange={e => setUsername(e.target.value)}
                               placeholder="Enter User Name" required/><br/>
                        <label htmlFor="password">Password: </label>
                        <input type="password" id="password" name="password"
                               className="form-control" value={password}
                               onChange={e => setPassword(e.target.value)} placeholder="Enter Password" required/><br/>
                        <div id="failed" className="error_msg">{failed}</div>
                       <div onClick={handleSubmit} id="submit" className="btn btn-info float-right">Submit</div>
                    </form>
                </div>
            </div>
        );
    }
}