import React, {useState} from "react";
import axios from "axios";
import { Link, useHistory} from "react-router-dom";
import { IoCreateOutline } from "react-icons/io5";


export default function Details(props) {
    const [data, setData] = useState();
    const [loaded, setLoaded] = useState(false);

    const url = 'http://localhost/N413/dayplanner/src/php/calendar.php';
    console.log(props);
    const history= useHistory();
    let id = props.eventID;
    if (id==="new"){
        console.log("id is new");
        history.push(`/event/add/`);
    }

    function getDayString(date){
        switch(date) {
            case 0: return "Sunday";
            case 1: return "Monday ";
            case 2: return "Tuesday ";
            case 3: return "Wednesday ";
            case 4: return "Thursday ";
            case 5: return "Friday ";
            case 6: return "Saturday ";
            default: return "";
        }
    }

    function getTimeFormatted(date){
        let time = "";
        date = new Date(date);
        // console.log("Date:");
        // console.log(date);
        let hour = date.getHours();
        let minutes = date.getMinutes().toString();
        //prepend 0 if needed
        if (minutes.length <2) {
            minutes = "0" + minutes;
        }
        if (hour<12){
            //am
            if(hour===0){
                //midnight
                time += "12:" + minutes + " am";
            } else {
                time += hour + ":" + minutes + " am";
            }

        } else if (hour>=12) {
            //pm
            if (hour === 12) {
                //noon
                time += "12:" + minutes + " pm";
            } else {
                time += (hour-12).toString() + ":" + minutes + " pm";
            }
        }
        return time;
    }

    function getDateFormatted(date){
        let formatted = "";

        formatted += getDayString(date.getDay()) + " ";
        formatted += (date.getMonth()+1) + "/";
        formatted += date.getDate() + "/";
        formatted += date.getFullYear() ;

        return formatted;
    }

    if(!loaded){
        axios.get(url+`?id=`+id).then(response => {
            console.log("Response: ");
            console.log(response);
            setData(response.data);
            console.log("Data: ");
            console.log(data);
            setLoaded(true);
        });
    }
    return (
        <div className="event-details-container">
            {!loaded ? (
                <div> Loading... </div>
            ) : (

                data.map((item, key) => {
                    let start = new Date(item.startDateTime);
                    let end = new Date(item.endDateTime);
                    return (
                        <div key={key} className={"event-details"}>
                            <div className={"top-bar"}>
                                <Link className={"edit"} to={{
                                    pathname: '/event/edit/'+ id,
                                    state: { title: item.title, description: item.description, start: item.startDateTime,
                                        end: item.startDateTime, project: item.projectID, tags: item.tags, priority: item.priority }
                                }} >
                                    <div className={"action"}>
                                        <IoCreateOutline className={"icon edit"} />
                                        Edit Details
                                    </div>
                                </Link>
                                <div className={"details-top"}>
                                    <div className={"event-title"}>{item.title}</div>
                                    {   (start.getDate() === end.getDate()) ? (
                                        <div className={"event-time-date"}>
                                            <div className={"event-date"}>{getDateFormatted(start)}</div>
                                            <div className={"event-time-range"}>{getTimeFormatted(start)} - {getTimeFormatted(end)}</div>
                                        </div>
                                    ) : (
                                        <div className={"event-time-date"}>
                                            <div className={"event-date"}>{getDateFormatted(start)} {getTimeFormatted(start)} - </div>
                                            <div className={"event-date"}>{getDateFormatted(end)} {getTimeFormatted(end)}</div>
                                        </div>
                                    )}
                                </div>
                            </div>
                            <div className={"details-bottom"}>
                                    <div className={"description"}>{item.description}</div>
                                <hr />
                                    <div className={"project"}>Project: {item.projectTitle}</div>
                                    <div className={"tags"}>Tags: {item.tags}</div>
                                    <div className={"priority"}>Priority: {item.priority}</div>
                            </div>
                        </div>
                    );
                })
            )}
        </div>
    );
}

