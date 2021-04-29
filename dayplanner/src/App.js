import React, {useState, useEffect} from 'react';
import './App.css';
import Nav from './components/nav';
import Calendar from './components/calendar';
import Taskbar from './components/taskbar';
import Home from './components/home';
import Login from "./components/account/login";
import Register from "./components/account/register";
import Logout from "./components/account/logout";
import Success from "./components/account/success";
//Axios for get request
import {BrowserRouter, Switch, Route, Link} from "react-router-dom";
import { createBrowserHistory } from "history";
import axios from "axios";
import Account from "./components/account/Account";

export default function App() {
    const history = createBrowserHistory();
    const [data, setData] = useState();
    const [loggedin, setLoggedin] = useState(false);
    const [loaded, setLoaded] = useState(false);

    const url = 'http://localhost/N413/dayplanner/src/php/auth.php';

    function checkLogin(){
        if(localStorage.getItem("token") !== null && localStorage.getItem("token") != undefined) {
            console.log("loggedin");
            console.log(localStorage.getItem("token"));
            setLoggedin(true);
        } else {
            console.log("not logged in");
            setLoggedin(false);
        }
    }
    if(!loaded){
        checkLogin();
        setLoaded(true);
    }

    // useEffect(() => {
    //     // Update the logged in status
    //     return checkLogin();
    // });

    return (
        <div className="App">
            <BrowserRouter history={history}>
                {!loaded ?
                    [
                        <div className="nav">
                            <div className="brand">Day Planner</div>
                        </div>,
                        <div className="components">
                            Loading...
                        </div>
                    ]
                    :
                        [
                            <Nav loggedin={loggedin} checkLogin={checkLogin}/>,
                            <Switch>
                                <Route path="/success/:id">
                                    <Success/>
                                </Route>
                                {!loggedin ?
                                    [
                                        <Route path="/home">
                                            <Home/>
                                        </Route>,
                                        <Route path="/login">
                                            <Login/>
                                        </Route>,
                                        <Route path="/register">
                                            <Register/>
                                        </Route>,
                                        <Route>
                                            <Home/>
                                        </Route>
                                    ]
                                    : [
                                    <Route path="/logout">
                                        <Logout/>
                                    </Route>,
                                    <Route>
                                        <div className="components">
                                            <Taskbar/>
                                            <Calendar/>
                                        </div>
                                    </Route>
                                    ]
                                }
                            </Switch>
                 ]
                }
            </BrowserRouter>
        </div>
    );
}

