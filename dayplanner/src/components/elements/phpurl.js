import React from "react";

export default function PhpUrl() {

    // for localhost
    if(window.location.href.includes("localhost")) {
        return "http://localhost/N413/dayplanner/src/";
    }

    //for web4
    if(window.location.href.includes("in-info-web4.informatics.iupui.edu")) {
        return "/~hrlindse/dayplanner/";
    }
}