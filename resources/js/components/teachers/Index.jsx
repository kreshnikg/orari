import React, {useState, useEffect} from 'react';
import {Link} from "react-router-dom";
import axios from "axios";
import swal from "@sweetalert/with-react";
import Spinner from "../includes/Spinner";

export default function Index(props) {

    const API_BASE_URL = "/api/admin/teachers";

    const [state, setState] = useState({
        teachers: [],
        loader: true
    })

    useEffect(() => {
        getData();
    }, []);

    const getData = () => {
        axios.get(API_BASE_URL).then((response) => {
            setState({
                teachers: response.data.teachers,
                loader: false
            })
        })
    }

    const deleteHandler = (teacherId) => {
        axios.post(`${API_BASE_URL}/${teacherId}/delete`)
            .then((response) => {
                swal({
                    icon: 'success',
                    timer: 1500,
                });
                getData();
            })
    };

    const deleteAlert = (teacherId) => {
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
                deleteHandler(teacherId);
            }
        });
    };

    return (
        <>
            <div className="d-flex align-items-center mb-4">
                <h4 className="mb-0">Ligjëruesit</h4>
                <Link to="/admin/teachers/create" className="btn btn-primary ml-auto my-btn-primary-color my-shadow">Shto
                    ligjërues</Link>
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
                                <th scope="col">Roli</th>
                                <th scope="col"/>
                            </tr>
                            </thead>
                            <tbody>
                            {state.teachers.map((teacher,index) => {
                                return (
                                    <tr key={teacher.teacher_id}>
                                        <th className="text-center" scope="row">{index + 1}</th>
                                        <td>{teacher.user.first_name} {teacher.user.last_name}</td>
                                        <td>{teacher.user.email}</td>
                                        <td>{teacher.teacher_type.description}</td>
                                        <td>
                                            <Link className="btn btn-link btn-sm" style={{color: "#5e676f"}}
                                                  to={`/admin/teachers/${teacher.teacher_id}/edit`}>
                                                <i className="fas fa-pen px-1"/>
                                            </Link>
                                            <button
                                                className="btn btn-link btn-sm"
                                                style={{color: "#5e676f"}}
                                                onClick={() => deleteAlert(teacher.teacher_id)}>
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
