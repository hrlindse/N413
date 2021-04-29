import React from "react";
import {
    BrowserRouter,
    Switch,
    Route
} from "react-router-dom";
import { createBrowserHistory } from "history";
import List from './task/list';
import Add from './task/add';
import Edit from './task/edit';
import Details from './task/details';

export default function Taskbar() {
    const taskbarHistory = createBrowserHistory();

    return (
        <div className="taskbar">
            <BrowserRouter history={taskbarHistory}>
                <Switch>
                    <Route path="/task/list">
                        <List />
                    </Route>
                    <Route path="/task/edit/:id" component={ Edit } />
                    <Route path="/task/edit">
                        <Edit />
                    </Route>
                    <Route path="/task/add">
                        <Add />
                    </Route>
                    <Route path="/task/details/:id">
                        <Details />
                    </Route>
                    <Route path="/task/details">
                        <Details />
                    </Route>
                    <Route >
                        <List />
                    </Route>
                </Switch>
            </BrowserRouter>
        </div>
    );
}
