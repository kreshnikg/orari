import React, {useState, useEffect} from 'react';
import Cookies from "js-cookie";
import SidebarItem from "./SidebarItem";

export default function Sidebar(props) {

    useEffect(() => {
    }, []);

    return (
        <div id="sidebar" className="sidebar border-0">
            <ul className="p-0">
                <li className="d-flex justify-content-center my-3">
                    <img alt="logo" src="/storage/img/clock-logo-white.png" width="100"/>
                </li>

                <SidebarItem url="/schedule" forRoles={["teacher","student"]} title="Orari" icon="far fa-calendar-alt"/>

                <SidebarItem url="/schedules" forRoles={["admin"]} title="Terminet" icon="far fa-clock"/>

                <SidebarItem url="/subjects" title="Lëndët" icon="fas fa-book-open"/>

                <SidebarItem url="/students" forRoles={["admin","teacher"]} title="Studentët" icon="fas fa-user-graduate"/>

                <SidebarItem url="/teachers" forRoles={["admin"]} title="Ligjëruesit" icon="fas fa-chalkboard-teacher"/>

                <SidebarItem url="/admins" forRoles={["admin"]} title="Administratorët" icon="fas fa-user-cog"/>

                <SidebarItem url="/classrooms" forRoles={["admin"]} title="Klasat" icon="fas fa-chalkboard"/>

                <li className="sidebar-item position-absolute w-100 text-center" style={{bottom : "20px"}}>
                    <a className="sidebar-link" href="/logout">
                        <i className="fas fa-sign-out-alt fa-fw"/>
                        <span className="ml-2">Çkyçu</span>
                    </a>
                </li>
            </ul>
        </div>

    )
}
