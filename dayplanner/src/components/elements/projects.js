// Projects dropdown
import React, {useState} from "react";
import axios from "axios";
import PhpUrl from "./phpurl";

export default function Projects(props){
    const [data, setData] = useState();
    const [loaded, setLoaded] = useState(false);
    const url = PhpUrl() + 'php/projects.php';
    const selected = props.selected;
    const uid = props.uid;

    if(!loaded){
        axios.get(url+`?uid=`+uid).then(response => {
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
            <select name="project" id="project" value={selected} onChange={e => props.newProject(e.target.value)}>
                <option value={null} value> </option>
                {data.map((item, key) => {
                    return (
                        <option key={key} value={item.id}>{item.title}</option>
                    );
                })}
            </select>
        );
    }

}