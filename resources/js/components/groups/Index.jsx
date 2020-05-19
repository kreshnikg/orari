import React, {useState, useEffect, useCallback} from 'react';
import {Link} from "react-router-dom";
import axios from "axios";
import swal from "@sweetalert/with-react";
import Spinner from "../includes/Spinner";

export default function Index(props) {

    const API_BASE_URL = "/api/admin/groups";

    const [state, setState] = useState({
        groups: [],
        loader: true
    })

    useEffect(() => {
        getData();
    }, []);

    const getData = () => {
        axios.get(API_BASE_URL).then((response) => {
            setState({
                ...state,
                groups: response.data.groups,
                loader: false
            })
        })
    }

    const deleteHandler = (groupId) => {
        axios.post(`${API_BASE_URL}/${groupId}/delete`)
            .then((response) => {
                swal({
                    icon: 'success',
                    timer: 1500,
                });
                getData();
            })
    };

    const deleteAlert = (groupId) => {
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
                deleteHandler(groupId);
            }
        });
    };

    return (
        <>
            <div className="d-flex align-items-center mb-4">
                <h4 className="mb-0">Grupet</h4>
                <Link to="/admin/groups/create" className="btn btn-primary ml-auto my-btn-primary-color my-shadow">Krijo
                    grupet</Link>
            </div>
            <div className="row">
                <div className="col-sm-12 col-md-12">
                    <div className="card my-shadow border-0">
                        <table className="table my-table">
                            <thead>
                            <tr>
                                <th scope="col"/>
                                <th scope="col">Emertimi</th>
                                <th scope="col">Semestri</th>
                                <th scope="col">Nr. Studentëve</th>
                                <th scope="col"/>
                            </tr>
                            </thead>
                            <tbody>
                            {state.groups.map((group,index) => {
                                return (
                                    <tr key={group.group_id}>
                                        <th className="text-center" scope="row">{index + 1}</th>
                                        <td>
                                            <Link className="my-link" to={`/admin/groups/${group.group_id}`}>
                                                Grupi {group.number} - {group.group_type.description}
                                            </Link>
                                        </td>
                                        <td>{group.semester.description}</td>
                                        <td>{group.student_group.length}</td>
                                        <td>
                                            <Link className="btn btn-link btn-sm" style={{color: "#5e676f"}}
                                                  to={`/admin/groups/${group.group_id}/edit`}>
                                                <i className="fas fa-pen px-1"/>
                                            </Link>
                                            <button
                                                className="btn btn-link btn-sm"
                                                style={{color: "#5e676f"}}
                                                onClick={() => deleteAlert(group.group_id)}>
                                                <i className="fas fa-trash px-1"/>
                                            </button>
                                        </td>
                                    </tr>
                                )
                            })}
                            </tbody>
                        </table>
                        {state.loader ?
                        <div className="container">
                            <div className="row">
                                <div className="col-12 text-center my-5">
                                    <Spinner loading={state.loader}/>
                                </div>
                            </div>
                        </div> :
                            state.groups.length === 0 &&
                            <div className="container">
                                <div className="row">
                                    <div className="col-12 text-center my-2">
                                        Nuk ka të dhëna
                                    </div>
                                </div>
                            </div>
                        }
                    </div>
                </div>
            </div>
        </>
    )
}
