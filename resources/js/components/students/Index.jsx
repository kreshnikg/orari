import React, {useState, useEffect, useCallback} from 'react';
import {Link} from "react-router-dom";
import axios from "axios";
import swal from "@sweetalert/with-react";
import Spinner from "../includes/Spinner";

export default function Index(props) {

    const API_BASE_URL = "/api/admin/students";

    const [state, setState] = useState({
        students: [],
        loader: true
    })

    useEffect(() => {
        getData();
    }, []);

    const getData = () => {
        axios.get(API_BASE_URL).then((response) => {
            setState({
                ...state,
                students: response.data.students,
                loader: false
            })
        })
    }

    const deleteHandler = (studentId) => {
        axios.post(`${API_BASE_URL}/${studentId}/delete`)
            .then((response) => {
                swal({
                    icon: 'success',
                    timer: 1500,
                });
                getData();
            })
    };

    const deleteAlert = (studentId) => {
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
                deleteHandler(studentId);
            }
        });
    };

    return (
        <>
            <div className="d-flex align-items-center mb-4">
                <h4 className="mb-0">Studentët</h4>
                <Link to="/admin/students/create" className="btn btn-primary ml-auto my-btn-primary-color my-shadow">Shto
                    student</Link>
            </div>
            <div className="row">
                <div className="col-sm-12 col-md-12">
                    <div className="card my-shadow border-0">
                        <table className="table my-table">
                            <thead>
                            <tr>
                                <th scope="col"/>
                                <th scope="col">Emri</th>
                                <th scope="col">Email</th>
                                <th scope="col">Semestri</th>
                                <th scope="col"/>
                            </tr>
                            </thead>
                            <tbody>
                            {state.students.map((student,index) => {
                                return (
                                    <tr key={student.student_id}>
                                        <th className="text-center" scope="row">{index + 1}</th>
                                        <td>{student.user.first_name} {student.user.last_name}</td>
                                        <td>{student.user.email}</td>
                                        <td>{student.semester.description}</td>
                                        <td>
                                            <Link className="btn btn-link btn-sm" style={{color: "#5e676f"}}
                                                  to={`/admin/students/${student.student_id}/edit`}>
                                                <i className="fas fa-pen px-1"/>
                                            </Link>
                                            <button
                                                className="btn btn-link btn-sm"
                                                style={{color: "#5e676f"}}
                                                onClick={() => deleteAlert(student.student_id)}>
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
