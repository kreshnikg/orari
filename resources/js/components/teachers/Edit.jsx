import React, {useState, useEffect, useRef} from 'react';
import axios from "axios";
import swal from "@sweetalert/with-react";

export default function Create(props) {
    const teacherId = props.match.params.teacher_id;
    const API_BASE_URL = `/api/admin/teachers/${teacherId}`;

    let firstName = useRef(null);
    let lastName = useRef(null);
    let email = useRef(null);
    let teacherType = useRef(null);

    const [state,setState] = useState({
        teacherTypes: []
    })

    useEffect(() => {
        const getData = () => {
            axios.get(API_BASE_URL + '/edit')
            .then((response) => {
                let data = response.data;
                setState({
                    teacherTypes: data.teacherTypes
                })
                firstName.current.value = data.teacher.user.first_name;
                lastName.current.value = data.teacher.user.last_name;
                email.current.value = data.teacher.user.email;
                teacherType.current.value = data.teacher.teacher_type_id;
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
            props.history.push('/admin/teachers')
        })
    }

    const appendData = () => {
        let data = new FormData();
        data.append("first_name",firstName.current.value);
        data.append("last_name",lastName.current.value);
        data.append("email",email.current.value);
        data.append("teacher_type",teacherType.current.value);
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
                <label htmlFor="teacher_type">Roli</label>
                <select ref={teacherType} className="form-control" name="teacher_type" id="teacher_type" required>
                    <option value="" disabled selected>Zgjidh një opsion</option>
                    {state.teacherTypes.map((teacherType) => {
                        return(
                            <option value={teacherType.teacher_type_id}>{teacherType.description}</option>
                        )
                    })}
                </select>
            </div>
            <button type="button" onClick={updateHandler} className="btn btn-primary">Ruaj</button>
        </div>
    )
}
