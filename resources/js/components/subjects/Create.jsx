import React, {useState, useEffect, useRef} from 'react';
import axios from "axios";
import swal from "@sweetalert/with-react";

export default function Create(props) {

    const API_BASE_URL = '/api/admin/subjects';

    let title = useRef(null);
    let code = useRef(null);
    let subjectType = useRef(null);
    let ects = useRef(null);

    const [state,setState] = useState({
        subjectTypes: []
    })

    useEffect(() => {
        const getData = () => {
            axios.get(API_BASE_URL + '/create')
            .then((response) => {
                setState({
                    subjectTypes: response.data.subjectTypes
                })
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
            props.history.push('/admin/subjects')
        })
    }

    const appendData = () => {
        let data = new FormData();
        data.append("title",title.current.value);
        data.append("code",code.current.value);
        data.append("subject_type",subjectType.current.value);
        data.append("ects_credits",ects.current.value);
        return data;
    }

    return (
        <div className="w-25">
            <div className="form-group">
                <label htmlFor="title">Emërtimi</label>
                <input ref={title} className="form-control" type="text" name="title" id="title" required/>
            </div>
            <div className="form-group">
                <label htmlFor="code">Kodi</label>
                <input ref={code} className="form-control" type="text" name="code" id="code" required/>
            </div>
            <div className="form-group">
                <label htmlFor="subject_type">Lloji</label>
                <select ref={subjectType} className="form-control" name="subject_type" id="subject_type" required>
                    <option value="" disabled selected>Zgjidh një opsion</option>
                    {state.subjectTypes.map((subjectType) => {
                        return(
                            <option value={subjectType.subject_type_id}>{subjectType.description}</option>
                        )
                    })}
                </select>
            </div>
            <div className="form-group">
                <label htmlFor="ects_credits">ECTS kreditë</label>
                <input ref={ects} className="form-control" type="number" name="ects_credits" id="ects_credits"/>
            </div>
            <button type="button" onClick={updateHandler} className="btn btn-primary">Ruaj</button>
        </div>
    )
}
