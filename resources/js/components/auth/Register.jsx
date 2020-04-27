import React, {useState, useRef} from 'react';
import axios from "axios";
import {Link} from "react-router-dom";

export default function Register(props) {

    let [error, setError] = useState(null);

    let firstName = useRef(null);
    let lastName = useRef(null);
    let email = useRef(null);
    let password = useRef(null);

    const register = () => {
        let data = new FormData();
        data.append("first_name",firstName.current.value);
        data.append("last_name",lastName.current.value);
        data.append("email",email.current.value);
        data.append("password",password.current.value);
        if(error)
            setError(null);
        axios.post("/api/register", data).then((response) => {
            if (response.data === "success")
                window.location.href = "/";
        }).catch((error) => {
            if (error.response.status === 422)
                setError(error.response.data)

        })
    }

    let errorMessage = <div className="alert alert-danger" role="alert">
        {error}
    </div>;

    return (
        <div className="card shadow mx-auto my-auto login-card">
            <div className="card-body p-0">
                <div className="p-5">
                    <div className="text-center">
                        <img src="/storage/img/clock-logo.png" width="125"/>
                        <h4 className="h4 mb-4">Mirë se erdhët!</h4>
                    </div>
                    {error && errorMessage}
                    <input ref={firstName} type="text" name="first_name" className="form-control mb-3" placeholder="Emri" required/>
                    <input ref={lastName} type="text" name="last_name" className="form-control mb-3" placeholder="Mbiemri"
                           required/>
                    <input ref={email} type="email" name="email" className="form-control mb-3" placeholder="Email" required/>
                    <input ref={password} type="password" name="password" className="form-control mb-3" placeholder="Fjalkalimi"
                           required/>
                    <div className="form-group form-check">
                        <input type="checkbox" id="check" className="form-check-input"/>
                        <a href="#" target="_blank">Termat dhe kushtet e përdorimit</a>
                    </div>
                    <button type="button" onClick={register} className="btn btn-block login-btn">Regjistrohu</button>
                    <hr/>
                    <div className="text-center">
                        <Link className="small" to="/login">Keni llogari? Identifikohuni këtu!</Link>
                    </div>
                </div>
            </div>
        </div>
    )
}
