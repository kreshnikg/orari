import React, {useState, useEffect} from 'react';
import moment from "moment";

export default function Clock(props) {

    const [state, setState] = useState(null);

    useEffect(() => {
        if(!state){
            setTime();
        }
        setInterval(setTime, 1000);
    }, []);

    const setTime = () => {
        let time = moment().format("dddd, D MMMM YYYY, H:mm:ss");
        let timeAl = calendarToAl(time);
        setState(timeAl)
    };

    return (
        <>{state}</>
    )
}

