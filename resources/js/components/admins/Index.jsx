import React, {useState, useEffect} from 'react';
import {Link} from "react-router-dom";
import axios from "axios";
import swal from "@sweetalert/with-react";
import Spinner from "../includes/Spinner";

export default function Index(props) {

    const API_BASE_URL = "/api/admin/admins";

    const [state, setState] = useState({
        users: [],
        loader: true
    })

    useEffect(() => {
        getData();
    }, []);

    const getData = () => {
        axios.get(API_BASE_URL).then((response) => {
            setState({
                users: response.data.users,
                loader: false
            })
        })
    }

    const deleteHandler = (adminId) => {
        axios.post(`${API_BASE_URL}/${adminId}/delete`)
            .then((response) => {
                swal({
                    icon: 'success',
                    timer: 1500,
                });
                getData();
            })
    };

    const deleteAlert = (adminId) => {
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
                deleteHandler(adminId);
            }
        });
    };

    return (
        <>
            <div className="d-flex align-items-center mb-4">
                <h4 className="mb-0">Administratorët</h4>
                <Link to="/admin/admins/create" className="btn btn-primary ml-auto my-btn-primary-color my-shadow">Shto
                    administrator</Link>
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
                                <th scope="col">Krijuar më</th>
                                <th scope="col"/>
                            </tr>
                            </thead>
                            <tbody>
                            {state.users.map((user,index) => {
                                return (
                                    <tr key={user.user_id}>
                                        <th className="text-center" scope="row">{index + 1}</th>
                                        <td>{user.first_name} {user.last_name}</td>
                                        <td>{user.email}</td>
                                        <td>{user.created_at}</td>
                                        <td>
                                            <Link className="btn btn-link btn-sm" style={{color: "#5e676f"}}
                                                  to={`/user/users/${user.user_id}/edit`}>
                                                <i className="fas fa-pen px-1"/>
                                            </Link>
                                            <button
                                                className="btn btn-link btn-sm"
                                                style={{color: "#5e676f"}}
                                                onClick={() => deleteAlert(user.user_id)}>
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
