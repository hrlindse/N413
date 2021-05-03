import React, {useEffect, useState} from "react";
import Modal from 'react-modal';
import axios from "axios";
import Details from "./event/details";
import Edit from "./event/edit";
import Add from "./event/add";
import Event from "./event/event";
import PhpUrl from "../elements/phpurl";
import {
    BrowserRouter,
    Switch,
    Route,
    useHistory
} from "react-router-dom";
import { createBrowserHistory } from "history";
import { IoChevronBack, IoChevronForward } from "react-icons/io5";


function dayMatch(date, dayOfWeek){
    //check if date matches day of week
    date = new Date(date).getDay();

    if (date === dayOfWeek) {
        return true;
    } else {return false;}
}


export default function Week() {
    const [data, setData] = useState();
    // monday & sunday of selected week to base results on
    const [tuesday, setTuesday] = useState();
    const [wednesday, setWednesday] = useState();
    const [thursday, setThursday] = useState();
    const [friday, setFriday] = useState();
    const [saturday, setSaturday] = useState();
    const [sunday, setSunday] = useState();
    const [monday, setMonday] = useState(getMonday);
    const [uid, setUid] = useState((localStorage.getItem("token")).substring(1,(localStorage.getItem("token").length-1)));

    const [loaded, setLoaded] = useState(false);
    const [modalIsOpen,setIsOpen] = useState(false);
    const [modalID,setModalID] = useState();
    const modalHistory = createBrowserHistory( {basename: process.env.PUBLIC_URL});
    const history= useHistory();

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
        history.push(`/`);

    }

    const url = PhpUrl() + 'php/calendar.php';


    function updateWeek(newMonday){
        let tempTues = new Date(newMonday);
        let tempWed = new Date(newMonday);
        let tempThurs = new Date(newMonday);
        let tempFri = new Date(newMonday);
        let tempSat = new Date(newMonday);
        let tempSun= new Date(newMonday);
        tempTues.setDate(tempTues.getDate() + 1);
        tempWed.setDate(tempWed.getDate() + 2);
        tempThurs.setDate(tempThurs.getDate() + 3);
        tempFri.setDate(tempFri.getDate() + 4);
        tempSat.setDate(tempSat.getDate() + 5);
        tempSun.setDate(tempSun.getDate() + 6);
        setTuesday(tempTues);
        setWednesday(tempWed);
        setThursday(tempThurs);
        setFriday(tempFri);
        setSaturday(tempSat);
        setSunday(tempSun);
    }

    function getMonday(state, props)  {
        // get monday of current week
        let today = new Date();
        let day = today.getDay();
        let prevMonday = new Date();
        let nextSunday = new Date();
        if(today.getDay() == 1){
            // if monday, return today
            console.log("prev monday is today:");
            console.log(today);
            // setMonday(today);
            nextSunday.setDate(today.getDate() + 6);
            setSunday(nextSunday);
            updateWeek(today);
            return today;
        } else {
            if (today.getDay() == 0) {
                console.log("prev monday (today is sun):");
                prevMonday.setDate(today.getDate() - 6);
                console.log(prevMonday);
                // setMonday(prevMonday);
                setSunday(today);
            } else {
                console.log("prev monday:");
                prevMonday.setDate(today.getDate() - (day - 1));
                console.log(prevMonday);
                // setMonday(prevMonday);
                nextSunday.setDate(prevMonday.getDate() + 6);
                setSunday(nextSunday);
            }
            updateWeek(prevMonday);
            return prevMonday;
        }
        return true;
    }

    function weekBack(){
        let newWeek = monday.getDate()-7;
        let newMonday = new Date(monday.setDate(newWeek));
        setMonday(newMonday);
        console.log("Back a week:");
        console.log(monday);

        updateWeek(newMonday);

    }

    function weekForward(){
        let newWeek = monday.getDate()+7;
        let newMonday = new Date(monday.setDate(newWeek));
        setMonday(newMonday);
        console.log("Forward a week:");
        console.log(monday);
        updateWeek(newMonday);
    }



    useEffect(() => {
        let isMounted = true; // note this flag denote mount status
        axios.get(url, {params : {monday: monday, sunday: sunday, uid: uid}}).then(response => {
            if (isMounted) setData(response.data);
            console.log("In useeffect ");
            console.log(data);
            setLoaded(true);
        });
        return () => { isMounted = false }; // use effect cleanup to set flag false, if unmounted
        // setTuesday(new Date.setDate(monday.getDate() + 1));
    }, [monday, loaded]);


    if (!loaded) {
        return (
            <div> Loading... </div>
        )
    } else {
        return (
            <div className="week">
                <div className="monday day-header has-icon">
                    <div className={"icon"} onClick={weekBack}>
                        <IoChevronBack />
                    </div>
                    <div className={"day-label"}>
                        <h3>Monday</h3>
                        <div className={"date"}>
                            {monday.getMonth()+1}/{monday.getDate()}/{monday.getFullYear()}
                        </div>
                    </div>
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
                    <div className={"date"}>
                        {tuesday.getMonth()+1}/{tuesday.getDate()}/{tuesday.getFullYear()}
                    </div>
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
                    <div className={"date"}>
                        {wednesday.getMonth()+1}/{wednesday.getDate()}/{wednesday.getFullYear()}
                    </div>
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
                    <div className={"date"}>
                        {thursday.getMonth()+1}/{thursday.getDate()}/{thursday.getFullYear()}
                    </div>
                </div>

                {data.map((item, key) => {
                    if (dayMatch(item.startDateTime, 4)) {
                        return(
                            <Event key={key} item={item} openModal={openModal} />
                        )
                    }
                })}


                <div className="friday day-header">
                    <h3>Friday</h3>
                    <div className={"date"}>
                        {friday.getMonth()+1}/{friday.getDate()}/{friday.getFullYear()}
                    </div>
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
                    <div className={"date"}>
                        {saturday.getMonth()+1}/{saturday.getDate()}/{saturday.getFullYear()}
                    </div>
                </div>

                {data.map((item, key) => {
                    if (dayMatch(item.startDateTime, 6)) {
                        return(
                            <Event key={key} item={item} openModal={openModal} />
                        )
                    }
                })}

                <div className="sunday day-header has-icon">
                    <div className={"day-label"}>
                        <h3>Sunday</h3>
                        <div className={"date"}>
                            {sunday.getMonth()+1}/{sunday.getDate()}/{sunday.getFullYear()}
                        </div>
                    </div>
                    <div className={"icon"} onClick={weekForward}>
                        <IoChevronForward />
                    </div>
                </div>

                {data.map((item, key) => {
                    if (dayMatch(item.startDateTime, 0)) {
                        return(
                            <Event key={key} item={item} openModal={openModal} />
                        )
                    }
                })}


                <div onClick={() => openModal( "new")} className={"add-button"} >Add Event</div>

                <Modal
                    className={"event-modal"}
                    isOpen={modalIsOpen}
                    onAfterOpen={afterOpenModal}
                    onRequestClose={closeModal}
                    contentLabel="Event Modal"
                    appElement={document.getElementById('root')}
                >
                    <BrowserRouter basename={process.env.PUBLIC_URL} history={modalHistory}>

                        <Switch>
                            <Route path="/event/edit/:id">
                                <Edit loadControl={setLoaded} loadGet={loaded} />
                            </Route>
                            <Route path="/event/add/">
                                <Add closeModal={closeModal} loadControl={setLoaded} loadGet={loaded} />
                            </Route>
                            <Route>
                                <Details eventID={modalID} />
                            </Route>
                        </Switch>
                    </BrowserRouter>
                </Modal>


            </div>
        );
    }

}
