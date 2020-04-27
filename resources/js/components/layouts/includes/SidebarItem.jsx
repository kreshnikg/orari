import React, {useState, useEffect} from 'react';
import {Link} from "react-router-dom";
import {useLocation} from "react-router-dom";
import Cookies from "js-cookie";

export default function SidebarItem(props) {
    const location = useLocation();
    const [active, setActive] = useState(false);
    const [access,setAccess] = useState(false);

    const userCookie = Cookies.get("user");
    const user = userCookie ? JSON.parse(userCookie) : {};
    const finalUrl = `/${user.role}${props.url}`

    useEffect(() => {
        if(location.pathname == finalUrl)
            setActive(true)
        else{
            if(active)
                setActive(false);
        }
    }, [location]);

    useEffect(() => {
        setAccess(userHasRole(props.forRoles))
    },[])

    const userHasRole = (roles) => {
        if(!roles)
            return true;
        let result = false;
        roles.map((role) => {
            if(user.role === role)
                result = true;
        })
        return result;
    }

    return (
        access ?
        <li className={`sidebar-item ${active ? 'active' : ''}`}>
            <Link className="sidebar-link" to={finalUrl}>
                <i className={`${props.icon} fa-fw`}/>
                <span className="ml-2">{props.title}</span>
            </Link>
        </li> : null
    )
}
