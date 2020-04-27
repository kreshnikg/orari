import React, {useState, useEffect} from 'react';
import {Link} from "react-router-dom";
import axios from "axios";
import swal from "@sweetalert/with-react";
import Spinner from "../includes/Spinner";

export default function Index(props) {

    const API_BASE_URL = "/api/admin/subjects";

    const [state, setState] = useState({
        subjects: [],
        loader: true
    })

    useEffect(() => {
        const getData = () => {
            axios.get(API_BASE_URL).then((response) => {
                setState({
                    subjects: response.data.subjects,
                    loader: false
                })
            })
        }

        getData();
    }, []);

    const deleteHandler = (subjectId) => {
        axios.post(`${API_BASE_URL}/${subjectId}/delete`)
            .then((response) => {
                swal({
                    icon: 'success',
                    timer: 1500,
                });
            })
    };

    const deleteAlert = (subjectId) => {
        swal({
            title: "A jeni të sigurtë ?",
            text: "Pas fshierjes, nuk do të jeni në gjendje ta riktheni!",
            icon: "warning",
            buttons: {
                cancel: {
                    text: "Anulo",
                    visible: true,
                },
                confirm: {
                    text: "Fshi",
                }
            },
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                deleteHandler(subjectId);
            }
        });
    };

    return (
        <>
            <div className="d-flex align-items-center mb-4">
                <h4 className="mb-0">Lëndët</h4>
                <Link to="/admin/subjects/create" className="btn btn-primary ml-auto my-btn-primary-color my-shadow">Shto
                    lëndë</Link>
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
                                <th scope="col">ECTS</th>
                                <th scope="col">Obligative/Zgjedhore</th>
                                <th scope="col"/>
                            </tr>
                            </thead>
                            <tbody>
                            {state.subjects.map((subject,index) => {
                                return (
                                    <tr key={subject.subject_id}>
                                        <th className="text-center" scope="row">{index + 1}</th>
                                        <td>{subject.title}</td>
                                        <td>{subject.code}</td>
                                        <td>{subject.ects_credits}</td>
                                        <td>{subject.subject_type.description}</td>
                                        <td>
                                            <Link className="btn btn-link btn-sm" style={{color: "#5e676f"}}
                                               to={`/admin/subjects/${subject.subject_id}/edit`}>
                                                <i className="fas fa-pen px-1"/>
                                            </Link>
                                            <button
                                                className="btn btn-link btn-sm"
                                                style={{color: "#5e676f"}}
                                                onClick={() => deleteAlert(subject.subject_id)}>
                                                <i className="fas fa-trash px-1"/>
                                            </button>
                                        </td>
                                    </tr>
                                )
                            })}
                            </tbody>
                        </table>
                        {state.loader &&
                            <div className="container">
                                <div className="row">
                                    <div className="col-12 text-center my-5">
                                        <Spinner loading={state.loader}/>
                                    </div>
                                </div>
                            </div>}
                    </div>
                </div>
            </div>
        </>
    )
}
