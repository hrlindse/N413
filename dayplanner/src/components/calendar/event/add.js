import React, {useEffect, useState} from "react";
import axios from "axios";
import { Link, useParams, useHistory} from "react-router-dom";
import { IoIosClose, IoMdCheckmark } from "react-icons/io";
import Projects from "../../elements/projects";
import PhpUrl from "../../elements/phpurl";

function toISO(dateObj) {
    //convert date to ISO for Date input
    let newDate = "";
    newDate += dateObj.getFullYear()+"-";
    newDate += (dateObj.getMonth()+1).toString().padStart(2, '0')+"-";
    newDate += dateObj.getDate().toString().padStart(2, '0')+"T";
    newDate += dateObj.getHours().toString().padStart(2, '0')+":";
    newDate += dateObj.getMinutes().toString().padStart(2, '0');
    return newDate;
}

export default function Add(props) {
    const [data, setData] = useState();
    const [loaded, setLoaded] = useState(true);
    const [uid, setUid] = useState((localStorage.getItem("token")).substring(1,(localStorage.getItem("token").length-1)));
    const url = PhpUrl() + 'php/calendar.php';
    let {id} = useParams();
    const history= useHistory();
    // state management for form fields
    const [title, setTitle] = useState("");
    const [description, setDescription] = useState("");
    const [start, setStart] = useState(null);
    const [end, setEnd] = useState(null);
    const [project, setProject] = useState(null);
    const [tags, setTags] = useState("");
    const [priority, setPriority] = useState(null);


    function handleSubmit() {
        console.log('Submission: ' + title);
        // console.log(props);
        if (title == "" ) {
            alert("Title cannot be empty");
            return false;
        }
        if (start == null ) {
            alert("Start date cannot be empty");
            return false;
        }
        if (end == null ) {
            alert("End date cannot be empty");
            return false;
        }
        setLoaded(false);
        axios.post(url, {
            uid: uid,
            title: title,
            description: description,
            startDateTime: start,
            endDateTime: end,
            project: project,
            tags: tags,
            priority: priority
        }).then(response => {
            console.log("Response: ");
            console.log(response);
            setData(response.data);
            console.log("Data: ");
            console.log(data);
            // set parent's loaded to false to trigger axios get again
            // to refresh parent component after edit/add inside modal
            props.loadControl(false);
            props.closeModal();
        });


    }

    useEffect(() => {
        let isMounted = true; // note this flag denote mount status

        return () => { isMounted = false; }; // use effect cleanup to set flag false, if unmounted
        // setTuesday(new Date.setDate(monday.getDate() + 1));
    }, [loaded]);

    if (!loaded) {
        return (
            <div> Loading... </div>
        )
    } else {
        return (
            <div className="edit-event-container">
                <div className={"edit-bar"}>
                    <div className={"action"}>
                        <div className={"close-button"} onClick={props.closeModal}><IoIosClose className={"icon"} /> Cancel</div>
                    </div>
                    <div className={"action"}>
                        <div id="submit-form" onClick={handleSubmit} ><IoMdCheckmark className={"icon"} /> Save</div>
                    </div>
                </div>
                <div className={"event-edit-form"}>
                    <form>
                        <label htmlFor="title">Title:</label>
                        <input type="text" id="title" name="title" value={title}
                               onChange={e => setTitle(e.target.value)}/>
                        <label htmlFor="description">Description:</label>
                        <textarea rows="4" id="description" name="description"
                                  onChange={e => setDescription(e.target.value)} value={description}></textarea>
                        <label htmlFor="start">Start: </label>
                        <input type="datetime-local" id="start" name="start" value={start}
                               onChange={e => setStart(e.target.value)}/>
                        <label htmlFor="end">End: </label>
                        <input type="datetime-local" id="end" name="end" value={end}
                               onChange={e => setEnd(e.target.value)}/>
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


