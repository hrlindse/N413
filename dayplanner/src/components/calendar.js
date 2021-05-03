import React from "react";
import {
    BrowserRouter,
    Switch,
    Route
} from "react-router-dom";
import Daily from '../components/calendar/Daily';
import Week from '../components/calendar/Week';
import Month from '../components/calendar/Month';


function Calendar() {
        return (
            <div className="calendar">
                <BrowserRouter basename={process.env.PUBLIC_URL}>
                    {/*<div className="buttonlist">*/}
                    {/*    <Link className="button" to="/daily">Daily</Link><br/>*/}
                    {/*    <Link className="button" to="/week">Week</Link><br/>*/}
                    {/*    <Link className="button" to="/month">Month</Link><br/><br/>*/}
                    {/*</div>*/}

                    <Switch>
                        <Route path="/daily">
                            <Daily />
                        </Route>
                        <Route path="/week">
                            <Week />
                        </Route>
                        <Route path="/month">
                            <Month />
                        </Route>
                        <Route >
                            <Week />
                        </Route>
                    </Switch>
                </BrowserRouter>

            </div>
        );
}

export default Calendar;