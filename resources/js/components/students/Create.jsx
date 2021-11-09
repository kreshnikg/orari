import React, {useState, useEffect, useRef} from 'react';
import axios from "axios";
import swal from "@sweetalert/with-react";

export default function Create(props) {

    const API_BASE_URL = '/api/admin/students';

    let firstName = useRef(null);
    let lastName = useRef(null);
    let email = useRef(null);
    let password = useRef(null);
    let semester = useRef(null);

    useEffect(() => {
        const getData = () => {
            axios.get(API_BASE_URL + '/create')
            .then((response) => {
                let data = response.data;
                semester.current.value = data.semester.description;
            })
            .catch((error) => {

            });
        }

        getData()
    }, []);

    const updateHandler = () => {
        let data = appendData();
        axios.post(API_BASE_URL,data).then((response) => {
            swal({
                icon: 'success',
                timer: 1500,
            });
            props.history.push('/admin/students')
        })
    }

    const appendData = () => {
        let data = new FormData();
        data.append("first_name",firstName.current.value);
        data.append("last_name",lastName.current.value);
        data.append("email",email.current.value);
        data.append("password",password.current.value);
        return data;
    }

    return (
        <div className="w-25">
            <div className="form-group">
                <label htmlFor="first_name">Emri</label>
                <input ref={firstName} className="form-control" type="text" name="first_name" id="first_name" required/>
            </div>
            <div className="form-group">
                <label htmlFor="last_name">Mbiemri</label>
                <input ref={lastName} className="form-control" type="text" name="last_name" id="last_name" required/>
            </div>
            <div className="form-group">
                <label htmlFor="email">Email</label>
                <input ref={email} className="form-control" type="email" name="email1" id="email"/>
            </div>
            <div className="form-group">
                <label htmlFor="password">Fjalkalimi</label>
                <input ref={password} className="form-control" type="password" name="password1" id="password"/>
            </div>
            <div className="form-group">
                <label htmlFor="semester">Semestri</label>
                <input ref={semester} className="form-control" type="text" name="semester"
                       id="semester" readOnly disabled/>
            </div>
            <button type="button" onClick={updateHandler} className="btn btn-primary">Ruaj</button>
        </div>
    )
}
