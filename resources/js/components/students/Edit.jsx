import React, {useState, useEffect, useRef} from 'react';
import axios from "axios";
import swal from "@sweetalert/with-react";

export default function Create(props) {
    const studentId = props.match.params.student_id;
    const API_BASE_URL = `/api/admin/students/${studentId}`;

    let firstName = useRef(null);
    let lastName = useRef(null);
    let email = useRef(null);
    let semester = useRef(null);

    const [state,setState] = useState({
        semesters: []
    })

    useEffect(() => {
        const getData = () => {
            axios.get(API_BASE_URL + '/edit')
            .then((response) => {
                let data = response.data;
                setState({
                    semesters: data.semesters
                })
                firstName.current.value = data.student.user.first_name;
                lastName.current.value = data.student.user.last_name;
                email.current.value = data.student.user.email;
                semester.current.value = data.student.semester_id;
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
        data.append("semester",semester.current.value);
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
                <label htmlFor="semester">Gjenerata</label>
                <select ref={semester} className="form-control" name="semester" id="semester" required>
                    <option value="" disabled selected>Zgjidh një opsion</option>
                    {state.semesters.map((semester) => {
                        return(
                            <option value={semester.semester_id}>{semester.description}</option>
                        )
                    })}
                </select>
            </div>
            <button type="button" onClick={updateHandler} className="btn btn-primary">Ruaj</button>
        </div>
    )
}
