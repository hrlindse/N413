import React, {useState} from "react";
import axios from "axios";
import {Link} from "react-router-dom";
import Checkbox from "../elements/checkbox";

export default function TaskList() {
    const [data, setData] = useState();
    const [day, setDay] = useState(new Date());
    const [loaded, setLoaded] = useState(false);


    const url = 'http://localhost/N413/dayplanner/src/php/tasks.php';

    if(!loaded){
        axios.get(url, {date: day}).then(response => {
            setData(response.data);
            // console.log("Data: ");
            // console.log(data);
            setLoaded(true);
        });
    }

    return (
        <div className="tasklist-container">
            <div className={"tasklist-top"}>
                <h2>Today's tasks</h2>
                <div className="tasklist">
                    {/*{JSON.stringify(data)}*/}

                    {!loaded ? (
                        <div> Loading... </div>
                    ) : (
                        data.map((item, key) => {
                            return (
                                <div key={key} className={"task-container"} >
                                    <Checkbox complete={item.completed} id={item.id} />
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
                    )}
                </div>
            </div>
            <div className={"tasklist-bottom"}>
                <Link className={"add-button"} to={"/task/add"}><div className={"add-button"} >Add Task</div></Link>
            </div>

        </div>
    );
}
