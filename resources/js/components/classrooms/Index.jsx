import React, {useState, useEffect} from 'react';
import {Link} from "react-router-dom";
import axios from "axios";
import swal from "@sweetalert/with-react";
import Spinner from "../includes/Spinner";

export default function Index(props) {

    const API_BASE_URL = "/api/admin/classrooms";

    const [state, setState] = useState({
        classrooms: [],
        loader: true
    })

    useEffect(() => {
        const getData = () => {
            axios.get(API_BASE_URL).then((response) => {
                setState({
                    classrooms: response.data.classrooms,
                    loader: false
                })
            })
        }

        getData();
    }, []);

    const deleteHandler = (classroomId) => {
        axios.post(`${API_BASE_URL}/${classroomId}/delete`)
            .then((response) => {
                swal({
                    icon: 'success',
                    timer: 1500,
                });
            })
    };

    const deleteAlert = (classroomId) => {
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
                deleteHandler(classroomId);
            }
        });
    };

    return (
        <>
            <div className="d-flex align-items-center mb-4">
                <h4 className="mb-0">Klasat</h4>
                <Link to="/admin/classrooms/create" className="btn btn-primary ml-auto my-btn-primary-color my-shadow">Shto
                    klasë</Link>
            </div>

            <div className="row">
                <div className="col-sm-12 col-md-6">
                    <div className="card my-shadow border-0">
                        <table className="table my-table">
                            <thead>
                            <tr>
                                <th scope="col"/>
                                <th scope="col">Numri</th>
                                <th scope="col">Lloji</th>
                                <th scope="col"/>
                            </tr>
                            </thead>
                            <tbody>
                            {state.classrooms.map((classroom,index) => {
                                return (
                                    <tr key={classroom.classroom_id}>
                                        <th className="text-center" scope="row">{index + 1}</th>
                                        <td>{classroom.number}</td>
                                        <td>{classroom.classroom_type.description}</td>
                                        <td>
                                            <Link className="btn btn-link btn-sm" style={{color: "#5e676f"}}
                                                  to={`/admin/classrooms/${classroom.classroom_id}/edit`}>
                                                <i className="fas fa-pen px-1"/>
                                            </Link>
                                            <button
                                                className="btn btn-link btn-sm"
                                                style={{color: "#5e676f"}}
                                                onClick={() => deleteAlert(classroom.classroom_id)}>
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
                                    <Spinner loading/>
                                </div>
                            </div>
                        </div>}
                    </div>
                </div>
            </div>
        </>
    )
}
