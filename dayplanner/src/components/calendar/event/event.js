import React from "react";

function getClasses(start, end){
    let classes = "time-slot ";
    start = new Date(start);
    end = new Date(end);

    //get day of week
    let dayClass = start.getDay();
    switch(dayClass) {
        case 0: classes += "sunday "; break;
        case 1: classes += "monday "; break;
        case 2: classes += "tuesday "; break;
        case 3: classes += "wednesday "; break;
        case 4: classes += "thursday "; break;
        case 5: classes += "friday "; break;
        case 6: classes += "saturday "; break;
        default: classes += "day";
    }

    //get start class
    classes += "item-" + start.getHours() + "00-start ";

    //get end class
    classes += "item-" + end.getHours() + "00-end ";

    return classes;
}

function getTimeFormatted(date){
    let time = "";
    date = new Date(date);
    // console.log("Date:");
    // console.log(date);
    let hour = date.getHours();
    let minutes = date.getMinutes().toString();
    //prepend 0 if needed
    if (minutes.length <2) {
        minutes = "0" + minutes;
    }
    if (hour<12){
        //am
        if(hour===0){
            //midnight
            time += "12:" + minutes + "am";
        } else {
            time += hour + ":" + minutes + "am";
        }

    } else if (hour>=12) {
        //pm
        if (hour === 12) {
            //noon
            time += "12:" + minutes + "pm";
        } else {
            time += (hour-12).toString() + ":" + minutes + "pm";
        }
    }
    return time;
}

//props getting passed to the Event component:
// item: the item data to display
// openModal: function to reference in onclick

export default function Event(props){

    return(
        <div className={getClasses(props.item.startDateTime, props.item.endDateTime)} onClick={() => props.openModal(props.item.id)}>
            <div className={"title"}>{props.item.title}</div>
            <div className={"time-range"}>
                {getTimeFormatted(props.item.startDateTime)} - {getTimeFormatted(props.item.endDateTime)}
            </div>
        </div>
    )


}