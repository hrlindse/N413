import React, {useState} from "react";
import axios from "axios";
import {IoIosCheckbox, IoIosSquareOutline, IoIosSquare} from "react-icons/io";

export default function Checkbox(props) {
    // const [data, setData] = useState();
    const [complete, setComplete] = useState(props.complete);
    const [loaded, setLoaded] = useState(true);

    const url = 'http://localhost/N413/dayplanner/src/php/tasks.php';

    // if (!loaded) {
    //     // console.log("Checkbox props:");
    //     // console.log(props);
    //     setLoaded(true);
    // }

    function markComplete() {
        setLoaded(false);
        axios.patch(url, {id: props.id, completed: 1}).then(response => {
            // setData(response.data);
            // console.log("mark complete Data: ");
            // console.log(data);
            setComplete(true);
            setLoaded(true);
        });

    }

    function markIncomplete() {
        setLoaded(false);
        axios.patch(url, {id: props.id, completed: 0}).then(response => {
            // setData(response.data);
            // console.log("Data: ");
            // console.log(data);
            setComplete(false);
            setLoaded(true);
        });
    }

    if(!loaded) {
        return (
            <IoIosSquare/>
        )
    } else {
        if (complete === "1" || complete === true) {
            return (<IoIosCheckbox onClick={markIncomplete} className={"checkbox"}/>)
        } else {
            return (<IoIosSquareOutline onClick={markComplete} className={"checkbox"}/>)
        }
    }
}