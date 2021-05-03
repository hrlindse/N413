import React, {useState, useEffect} from "react";
import axios from "axios";
import {Link} from "react-router-dom";
import Checkbox from "../elements/checkbox";
import PhpUrl from "../elements/phpurl";
import { IoChevronBack, IoChevronForward } from "react-icons/io5";

export default function TaskList() {
    const [loaded, setLoaded] = useState(false);
    const [data, setData] = useState();
    const [day, setDay] = useState(new Date());
    const [uid, setUid] = useState((localStorage.getItem("token")).substring(1,(localStorage.getItem("token").length-1)));
    const url = PhpUrl() + 'php/tasks.php';


    if(!loaded){
        console.log(uid);
        axios.get(url, {params : {day: day, uid: uid}}).then(response => {
            setData(response.data);
            console.log("Data: ");
            console.log(data);
            if (Array.isArray(data)){
                console.log("data length:");
                console.log( data.length);
            }
            setLoaded(true);
        });

    }


    function dayBack(){
        let newDay = day.getDate()-1;
        let newFullDate = new Date(day.setDate(newDay));
        setDay(newFullDate);
        console.log("Back a day:");
        console.log(day);
    }

    function dayForward(){
        let newDay = day.getDate()+1;
        let newFullDate = new Date(day.setDate(newDay));
        setDay(newFullDate);
        console.log("Forward a day:");
        console.log(day);
    }

    useEffect(() => {
        axios.get(url, {params : {day: day, uid: uid}}).then(response => {
            setData(response.data);
            console.log("In useeffect ");
            console.log(day.toDateString());
            console.log(data);
        });
    }, [day]);
    return (
        <div className="tasklist-container">
            <div className={"tasklist-top"}>
                <div className={"tasklist-topbar"}>
                    <div className={"icon"} onClick={dayBack}>
                        <IoChevronBack />
                    </div>
                    <h2>{day.getMonth()+1}/{day.getDate()}/{day.getFullYear()}</h2>
                    <div className={"icon"} onClick={dayForward}>
                        <IoChevronForward />
                    </div>
                </div>
                <div className="tasklist">
                    {/*{JSON.stringify(data)}*/}

                    {!loaded ? (
                        <div> Loading... </div>
                    ) : (
                        (data.length == 0) ?  (
                            <div className={"task-container"} >
                                <div className={"empty"}>
                                    You have no tasks today
                                </div>
                            </div>
                        ) : (
                            data.map((item, key) => {
                                return (
                                    <div key={key} className={"task-container"} >
                                        <Checkbox complete={item.completed} itemid={item.id} />
                                        {/*{item.completed ? (<IoIosSquareOutline onClick={markComplete} className={"checkbox"} />) :*/}
                                        {/*    (<IoIosCheckbox onClick={markIncomplete} className={"checkbox"} />)}*/}
                                        <Link title={"View task details"} to={`/task/details/`+ item.id}>
                                            <div className={"taskname"}>
                                                {item.title}<br/>
                                            </div>
                                        </Link>
                                    </div>
                                );
                            })
                        )
                    )}
                </div>
            </div>
            <div className={"tasklist-bottom"}>
                <Link className={"add-button"} to={"/task/add"}><div className={"add-button"} >Add Task</div></Link>
            </div>

        </div>
    );
}
