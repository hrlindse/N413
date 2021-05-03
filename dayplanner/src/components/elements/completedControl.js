import React, {useState} from "react";
import axios from "axios";
import {IoCheckmarkOutline, IoCloseOutline} from "react-icons/io5";
import PhpUrl from "./phpurl";

export default function CompletedControl(props) {
    // const [data, setData] = useState();
    const [complete, setComplete] = useState(props.complete);
    const [loaded, setLoaded] = useState(true);

    const url = PhpUrl() + 'php/tasks.php';

    // if (!loaded) {
    //     // console.log("Checkbox props:");
    //     // console.log(props);
    //     setLoaded(true);
    // }

    function markComplete() {
        setLoaded(false);
        axios.post(url, {id: props.id, completed: 1}).then(response => {
            // setData(response.data);
            // console.log("mark complete Data: ");
            // console.log(data);
            setComplete(true);
            setLoaded(true);
        });

    }

    function markIncomplete() {
        setLoaded(false);
        axios.post(url, {id: props.id, completed: 0}).then(response => {
            // setData(response.data);
            // console.log("Data: ");
            // console.log(data);
            setComplete(false);
            setLoaded(true);
        });
    }

    if(!loaded) {
        return (
            <div className={"action"}>
                <IoCloseOutline className={"icon incomplete"} />
                Mark Incomplete
            </div>
        )
    } else {
        if (complete === "1" || complete === true) {
            return (
                <div className={"action"}>
                    <IoCloseOutline onClick={markIncomplete} className={"icon incomplete"} />
                    Mark Incomplete
                </div>
            )
        } else {
            return (
                <div className={"action"}>
                    <IoCheckmarkOutline onClick={markComplete} className={"icon complete"} />
                    Mark Complete
                </div>
            )
        }
    }
}