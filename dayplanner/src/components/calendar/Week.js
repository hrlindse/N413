import React, {useState} from "react";
import Modal from 'react-modal';
import axios from "axios";
import Details from "./event/details";
import Edit from "./event/edit";
import Add from "./event/add";
import Event from "./event/event";
import {
    BrowserRouter,
    Switch,
    Route
} from "react-router-dom";
import { createBrowserHistory } from "history";

function dayMatch(date, dayOfWeek){
    //check if date matches day of week
    date = new Date(date).getDay();

    if (date === dayOfWeek) {
        return true;
    } else {return false;}
}


export default function Week() {
    const [data, setData] = useState();
    const [loaded, setLoaded] = useState(false);
    const [modalIsOpen,setIsOpen] = useState(false);
    const [modalID,setModalID] = useState();
    const modalHistory = createBrowserHistory();

    function openModal(id) {
        console.log("opening modal: "+ id);
        setIsOpen(true);
        setModalID(id);
    }

    function afterOpenModal() {
        // references are now sync'd and can be accessed.
    }

    function closeModal(){
        //close modal
        setIsOpen(false);
        setModalID("");
        // set loaded to false to trigger axios get again
        setLoaded(false);
    }

    const url = 'http://localhost/N413/dayplanner/src/php/calendar.php';

    if(!loaded){
        axios.get(url).then(response => {
            setData(response.data);
            // console.log("Data: ");
            // console.log(data);
            setLoaded(true);
        });
    }


    if (!loaded) {
        return (
            <div> Loading... </div>
        )
    } else {
        return (
            <div className="week">
                <div className="monday day-header">
                    <h3>Monday</h3>
                </div>

                {data.map((item, key) => {
                    if (dayMatch(item.startDateTime, 1)) {
                        return(
                            <Event item={item} openModal={openModal} />
                        )
                    }
                })}


                <div className="tuesday day-header">
                    <h3>Tuesday</h3>
                </div>

                {data.map((item, key) => {
                    if (dayMatch(item.startDateTime, 2)) {
                        return(
                            <Event key={key} item={item} openModal={openModal} />
                        )
                    }
                })}


                <div className="wednesday day-header">
                    <h3>Wednesday</h3>
                </div>

                {data.map((item, key) => {
                    if (dayMatch(item.startDateTime, 3)) {
                        return(
                            <Event key={key} item={item} openModal={openModal} />
                        )
                    }
                })}


                <div className="thursday day-header">
                    <h3>Thursday</h3>
                </div>

                {data.map((item, key) => {
                    if (dayMatch(item.startDateTime, 4)) {
                        return(
                            <Event key={key} item={item} openModal={openModal} />
                        )
                    }
                })}


                <div className="friday, day-header">
                    <h3>Friday</h3>
                </div>

                {data.map((item, key) => {
                    if (dayMatch(item.startDateTime, 5)) {
                        return(
                            <Event key={key} item={item} openModal={openModal} />
                        )
                    }
                })}


                <div className="saturday day-header">
                    <h3 >Saturday</h3>
                </div>

                {data.map((item, key) => {
                    if (dayMatch(item.startDateTime, 6)) {
                        return(
                            <Event key={key} item={item} openModal={openModal} />
                        )
                    }
                })}

                <div className="sunday, day-header">
                    <h3 >Sunday</h3>
                </div>

                {data.map((item, key) => {
                    if (dayMatch(item.startDateTime, 0)) {
                        return(
                            <Event key={key} item={item} openModal={openModal} />
                        )
                    }
                })}


                {/*<div onClick={() => openModal( "new")} className={"add-button"} >Add Event</div>*/}

                <Modal
                    className={"event-modal"}
                    isOpen={modalIsOpen}
                    onAfterOpen={afterOpenModal}
                    onRequestClose={closeModal}
                    contentLabel="Event Modal"
                    appElement={document.getElementById('root')}
                >
                    <BrowserRouter history={modalHistory}>
                        {/*<div className="buttonlist">*/}
                        {/*    <Link className="button" to="/daily">Daily</Link><br/>*/}
                        {/*    <Link className="button" to="/week">Week</Link><br/>*/}
                        {/*    <Link className="button" to="/month">Month</Link><br/><br/>*/}
                        {/*</div>*/}

                        <Switch>
                            <Route path="/event/edit/:id">
                                <Edit loadControl={setLoaded} loadGet={loaded} />
                            </Route>
                            <Route path="/event/add/">
                                <Edit loadControl={setLoaded} loadGet={loaded} />
                            </Route>
                            <Route>
                                <Details eventID={modalID} />
                            </Route>
                        </Switch>
                    </BrowserRouter>
                </Modal>


                {/*<div className={"monday, day-col"}>*/}
                {/*    <div className="day-header">*/}
                {/*        <h3>Monday</h3>*/}
                {/*    </div>*/}

                {/*    <div className="item-800am time-slot">8:00am</div>*/}
                {/*    <div className="item-200pm time-slot">2:00pm</div>*/}
                {/*</div>*/}
                {/*<div className={"tuesday, day-col"}>*/}
                {/*    <div className="day-header">*/}
                {/*        <h3>Tuesday</h3>*/}
                {/*    </div>*/}

                {/*    <div className="item-1000am time-slot">10:00am</div>*/}
                {/*    <div className="item-500pm time-slot">5:00pm</div>*/}

                {/*</div>*/}
                {/*<div className={"wednesday, day-col"}>*/}
                {/*    <div className="day-header">*/}
                {/*        <h3>Wednesday</h3>*/}
                {/*    </div>*/}

                {/*</div>*/}
                {/*<div className={"thursday, day-col"}>*/}
                {/*    <div className="day-header">*/}
                {/*        <h3>Thursday</h3>*/}
                {/*    </div>*/}
                {/*    <div className="item-200pm time-slot">2:00pm</div>*/}
                {/*</div>*/}
                {/*<div className={"friday, day-col"}>*/}
                {/*    <div className="day-header">*/}
                {/*        <h3>Friday</h3>*/}
                {/*    </div>*/}

                {/*</div>*/}
                {/*<div className={"saturday, day-col"}>*/}
                {/*    <div className="day-header">*/}
                {/*        <h3 >Saturday</h3>*/}
                {/*    </div>*/}

                {/*</div>*/}
                {/*<div className={"sunday, day-col"}>*/}
                {/*    <div className="day-header">*/}
                {/*        <h3 >Sunday</h3>*/}
                {/*    </div>*/}

                {/*</div>*/}
            </div>
        );
    }

}
