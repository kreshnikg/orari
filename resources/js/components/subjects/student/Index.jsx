import React, {useState, useEffect} from 'react';
import axios from "axios";

export default function Index(props) {

    const API_BASE_URL = '/api/student/subjects';

    const [state, setState] = useState({
        subjects: [],
        student: {},
        subjectsRegistered: false,
        loader: true
    })

    useEffect(() => {
        getData();
    }, []);

    const getData = () => {
        axios.get(API_BASE_URL)
            .then((response) => {
                let registered = response.data.student.subjects_registered == 1
                setState({
                    ...state,
                    subjects: response.data.subjects,
                    student: response.data.student,
                    subjectsRegistered: registered,
                    loader: false
                })
            })
            .catch((error) => {

            });
    }

    const checkIfRegistered = (subject) => {
        let registered = false;
        state.student.student_subject.map((studentSubject) => {
            if (studentSubject.subject_id == subject.subject_id)
                registered = true;
        })
        return registered;
    }

    const submitHandler = () => {
        axios.post(API_BASE_URL + "/submit").then((response) => {
            getData();
        })
    }

    const registerSubjectHandler = (subjectId) => {
        axios.post(`${API_BASE_URL}/${subjectId}/register`).then((response) => {
            getData();
        })
    }

    const cancelSubjectHandler = (subjectId) => {
        axios.post(`${API_BASE_URL}/${subjectId}/cancel`).then((response) => {
            getData();
        })
    }

    return (
        <>
            <div className="d-flex align-items-center mb-4">
                <h4 className="mb-0">Lëndët</h4>
                {
                    !state.loader &&
                    state.subjectsRegistered ?
                        <div className="alert alert-info ml-auto my-shadow mb-0" role="alert">
                            <i className="fas fa-info-circle mr-1"/> Lëndët janë regjistruar!
                        </div>
                        :
                        <button onClick={submitHandler} className="btn btn-blue ml-auto my-shadow">Përfundo</button>
                }
            </div>

            <div className="row">
                <div className="col-sm-12 col-md-12">
                    <div className="card my-shadow border-0">
                        <table className="table my-table">
                            <thead>
                            <tr>
                                <th scope="col"/>
                                <th scope="col">Emërtimi</th>
                                <th scope="col">Kodi</th>
                                <th scope="col">Obligative/Zgjedhore</th>
                                <th scope="col">ECTS</th>
                                {!state.subjectsRegistered && <th scope="col"/>}
                            </tr>
                            </thead>
                            <tbody>
                            {state.subjects.map((subject, index) => {
                                let registered = checkIfRegistered(subject);
                                if (state.subjectsRegistered && registered) {
                                    return (
                                        <tr key={subject.subject_id}>
                                            <th className="text-center" scope="row">{index + 1}</th>
                                            <td>{subject.title}</td>
                                            <td>{subject.code}</td>
                                            <td>{subject.subject_type.description}</td>
                                            <td>{subject.ects_credits}</td>
                                        </tr>
                                    )
                                } else if (!state.subjectsRegistered) {
                                    return (
                                        <tr key={subject.subject_id}>
                                            <th className="text-center" scope="row">{index + 1}</th>
                                            <td>{subject.title}</td>
                                            <td>{subject.code}</td>
                                            <td>{subject.subject_type.description}</td>
                                            <td>{subject.ects_credits}</td>
                                            <td>
                                                {registered ?
                                                    <a onClick={() => cancelSubjectHandler(subject.subject_id)}
                                                                    className="btn btn-sm btn-red">Anulo</a>
                                                    :
                                                    <a onClick={() => registerSubjectHandler(subject.subject_id)}
                                                            className="btn btn-sm btn-green">Regjistro</a>
                                                }
                                            </td>
                                        </tr>
                                    )
                                }
                            })}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </>
    )
}
