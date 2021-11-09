import React, {useState, useEffect} from 'react';
import Sidebar from "./includes/Sidebar";
import Topbar from "./includes/Topbar";

export default function Main(props) {
    return (
        <>
            <Sidebar />
            <Topbar />
            <div className="content mb-5">
                <div className="container-fluid">
                    {props.children}
                </div>
            </div>
        </>
    )
}
