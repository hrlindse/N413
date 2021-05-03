import React, {useEffect, useState} from "react";
import axios from "axios";
import {IoIosCheckbox, IoIosSquareOutline, IoIosSquare} from "react-icons/io";
import PhpUrl from "./phpurl";

export default function Checkbox(props) {
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
        console.log("updating: "+ props.itemid);
        axios.post(url, {id: props.itemid, completed: 1}).then(response => {
            // setData(response.data);
            // console.log("mark complete Data: ");
            // console.log(data);
            setComplete(true);
            setLoaded(true);
        });

    }

    function markIncomplete() {
        setLoaded(false);
        console.log("updating: "+ props.itemid);
        axios.post(url, {id: props.itemid, completed: 0}).then(response => {
            // setData(response.data);
            // console.log("Data: ");
            // console.log(data);
            setComplete(false);
            setLoaded(true);
        });
    }

    useEffect(() => {
        axios.get(url+`?id=`+props.itemid).then(response => {
            console.log(response);
            setComplete(response.data[0].completed);
        });
    }, [props.itemid]);

    if(!loaded) {
        return (
            <IoIosSquare/>
        )
    } else {
        if (complete === "1" || complete === true) {
            return (<IoIosCheckbox onClick={markIncomplete} className={"checkbox "+ props.itemid}/>)
        } else {
            return (<IoIosSquareOutline onClick={markComplete} className={"checkbox "+ props.itemid}/>)
        }
    }
}