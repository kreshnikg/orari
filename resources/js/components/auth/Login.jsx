import React, {useState, useEffect, useRef} from 'react';
import axios from "axios";
import {Link} from "react-router-dom";

export default function Login(props) {

    let [error, setError] = useState(null);

    let email = useRef(null);
    let password = useRef(null);

    const login = () => {
        let data = new FormData();
        data.append("email",email.current.value);
        data.append("password",password.current.value);
        if(error)
            setError(null);
        axios.post("/api/login", data).then((response) => {
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
                    <input type="email"
                           name="email"
                           className="form-control mb-3"
                           placeholder="Email"
                           ref={email}
                           required/>
                    <input type="password"
                           name="password"
                           className="form-control mb-3"
                           placeholder="Fjalkalimi"
                           ref={password}
                           required/>
                    <div className="form-group form-check">
                        <input type="checkbox" id="check" className="form-check-input"/>
                        <label className="form-check-label" htmlFor="check">Më mbaj në mend</label>
                    </div>
                    <button type="button" onClick={login} className="btn btn-block login-btn">Identifikohu</button>
                    <hr/>
                    <div className="text-center">
                        <Link className="small" to="/register">Nuk keni llogari? Regjistrohuni këtu!</Link>
                    </div>
                </div>
            </div>
        </div>
    )
}
