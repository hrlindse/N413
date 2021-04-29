import React, {useState} from "react";
import axios from "axios";
import { Link, useParams, useHistory} from "react-router-dom";
import { IoCheckmarkOutline, IoCloseOutline } from "react-icons/io5";
import Projects from "../elements/projects";

function toISO(dateObj) {
    //convert date to ISO for Date input
    let newDate = "";
    newDate += dateObj.getFullYear()+"-";
    newDate += (dateObj.getMonth()+1).toString().padStart(2, '0')+"-";
    newDate += dateObj.getDate().toString().padStart(2, '0');
    return newDate;
}

export default function Edit(props) {
    const [data, setData] = useState();
    const [loaded, setLoaded] = useState(true);
    const url = 'http://localhost/N413/dayplanner/src/php/tasks.php';
    let {id} = useParams();
    const history= useHistory();

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

    // state management for form fields
    const [title, setTitle] = useState(props.location.state.title);
    const [description, setDescription] = useState(props.location.state.description);
    const [date, setDate] = useState(toISO(props.location.state.date));
    const [project, setProject] = useState(props.location.state.project);
    const [tags, setTags] = useState(props.location.state.tags);
    const [priority, setPriority] = useState(props.location.state.priority);



    function handleSubmit() {
        console.log('Submission: ' + title);
        setLoaded(false);
        axios.patch(url, {
            id: id,
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
            history.push(`/task/details/` + id);
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
                    <Link to={`/task/details/` + id}><IoCloseOutline className={"icon cancel"} /> Cancel</Link>
                    <div id="submit-form" onClick={handleSubmit} ><IoCheckmarkOutline className={"icon"} /> Save</div>
                </div>
                <h2>Edit Task</h2>
                <div className={"task-edit-form"}>
                    <form>
                        <label htmlFor="title">Title:</label>
                        <input type="text" id="title" name="title" value={title}
                               onChange={e => setTitle(e.target.value)}/>
                        <label htmlFor="description">Description:</label>
                        <textarea rows="4" id="description" name="description"
                                  onChange={e => setDescription(e.target.value)} value={description}></textarea>
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


