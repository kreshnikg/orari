import React, {useState, useEffect} from 'react';
import Clock from "../../includes/Clock";

export default function Topbar(props) {

    useEffect(() => {

    }, []);

    return (
        <div id="topbar" className="topbar my-shadow">
            <div className="searchbar">
                <form method="GET" action="">
                    <input type="text" name="search" placeholder="Kërko" className="searchbar-input"/>
                    <button className="searchbar-button px-3" type="submit"><i className="fa fa-search"/></button>
                </form>
            </div>

            <ul className="profile-container">
                <Clock />
                <li>
                    <div className="topbar-divider"/>
                </li>
                <li className="profile-img">
                    <img src="/storage/img/profile-image.png" alt="profile image"/>
                </li>
            </ul>
        </div>
    )
}
