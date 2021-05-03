import React, {useState} from "react";
import axios from "axios";
import { Link, useParams} from "react-router-dom";
import { IoChevronBackOutline, IoCreateOutline } from "react-icons/io5";
import CompletedControl from "../elements/completedControl";
import PhpUrl from "../elements/phpurl";

export default function Details() {
    const [data, setData] = useState();
    const [loaded, setLoaded] = useState(false);

    const url = PhpUrl() + 'php/tasks.php';
    let { id } = useParams();

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
        <div className="task-details-container">
            <div className={"back-bar"}>
                <Link to={`/task/list`}><IoChevronBackOutline className={"back-arrow"} /> Back</Link>
            </div>
            {!loaded ? (
                <div> Loading... </div>
            ) : (
                data.map((item, key) => {
                    let date = new Date(item.date);
                    return (
                            <div key ={key} className={"task-details"}>
                                <div className={"details-top"}>
                                    <div className={"actions"}>
                                        <CompletedControl complete={item.completed} id={item.id} />
                                        <Link title={"Edit task details"} to={{
                                            pathname: `/task/edit/`+ id,
                                            state: { title: item.title, description: item.description, date: date,
                                                project: item.projectID, tags: item.tags, priority: item.priority }
                                            }} >
                                            <div className={"action"}>
                                                <IoCreateOutline className={"icon edit"} />
                                                Edit Details
                                            </div>
                                        </Link>
                                        {/*<div title={"Push due date forward one day"} className={"action"}>*/}
                                        {/*    <IoArrowForwardOutline className={"icon push"} />*/}
                                        {/*    Push Date*/}
                                        {/*</div>*/}
                                    </div>
                                    <div className={"details-top-text"}>
                                        <div className={"task-title"}>{item.title}</div>
                                        <div className={"task-desc"}>{item.description}</div>
                                    </div>
                                </div>
                                <div className={"details-bottom"}>
                                    <div className={"main-bottom-details"}>
                                        <div className={"date"}>Date: {date.toLocaleString().substring(0, date.toLocaleString().indexOf(","))}</div>
                                        {/*<div className={"due"}>Due: {item.title}</div>*/}
                                        <div className={"project"}>Project: {!(item.projectTitle==null) ? (item.projectTitle) : "None" }</div>
                                        <div className={"tags"}>Tags: {!(item.tags=="null") ? (item.tags) : "None" }</div>
                                    </div>
                                    <div className={"priority"}>Priority: {!(item.priority==null) ? (item.priority) : "None" }</div>
                                </div>
                            </div>
                    );
                })
            )}
        </div>
    );
}

