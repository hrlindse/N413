import React, {useState} from "react";
import axios from "axios";
import { Link, useHistory} from "react-router-dom";
import { IoIosClose, IoMdCheckmark } from "react-icons/io";
import Projects from "../elements/projects";

// function toISO(dateObj) {
//     //convert date to ISO for Date input
//     let newDate = "";
//     newDate += dateObj.getFullYear()+"-";
//     newDate += (dateObj.getMonth()+1).toString().padStart(2, '0')+"-";
//     newDate += dateObj.getDate().toString().padStart(2, '0')+"T";
//     newDate += dateObj.getHours().toString().padStart(2, '0')+":";
//     newDate += dateObj.getMinutes().toString().padStart(2, '0');
//     return newDate;
// }

export default function Add(props) {
    const [data, setData] = useState();
    const [loaded, setLoaded] = useState(true);
    const url = 'http://localhost/N413/dayplanner/src/php/tasks.php';
    const history= useHistory();



    // state management for form fields
    const [title, setTitle] = useState();
    const [description, setDescription] = useState();
    const [date, setDate] = useState();
    const [project, setProject] = useState();
    const [tags, setTags] = useState();
    const [priority, setPriority] = useState();


    function handleSubmit() {
        console.log('Submission: ' + title);
        setLoaded(false);
        axios.post(url, {
            title: title,
            description: description,
            date: date,
            project: project,
            tags: tags,
            priority: priority
        }).then(response => {
            console.log("Response: ");
            console.log(response);
            setData(response.data);
            console.log("Data: ");
            console.log(data);
            history.push(`/task/list/`);
        });


    }


    if (!loaded) {
        return (
            <div> Loading... </div>
        )
    } else {
        return (
            <div className="edit-task-container">
                <div className={"edit-bar"}>
                    <Link to={`/task/list`}><IoIosClose/> Cancel</Link>
                    <div id="submit-form" onClick={handleSubmit} ><IoMdCheckmark/> Save</div>
                </div>
                <h2>Edit Task</h2>
                <div className={"task-edit-form"}>
                    <form>
                        <label htmlFor="title">Title:</label>
                        <input type="text" id="title" name="title" value={title}
                               onChange={e => setTitle(e.target.value)}/>
                        <label htmlFor="description">Description:</label>
                        <input type="text" id="description" name="description" value={description}
                               onChange={e => setDescription(e.target.value)}/>
                        <label htmlFor="date">Date: </label>
                        <input type="date" id="date" name="date" value={date}
                               onChange={e => setDate(e.target.value)}/>
                        <label htmlFor="project">Project:</label>
                        <Projects uid={1} selected={project} newProject={setProject} />
                        <label htmlFor="tags">Tags:</label>
                        <input type="text" id="tags" name="tags" value={tags}
                               onChange={e => setTags(e.target.value)}/>
                        <label htmlFor="priority">Priority:</label>
                        <input type="text" id="priority" name="priority" value={priority}
                               onChange={e => setPriority(e.target.value)}/>
                    </form>
                </div>
            </div>
        );

    }
}