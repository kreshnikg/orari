import React, {useState, useEffect} from 'react';
import axios from "axios";
import Spinner from "../includes/Spinner";

export default function Show(props) {

    const [state, setState] = useState({
        studentGroup: [],
        group: null,
        loader: true
    });

    useEffect(() => {
        const getData = () => {
            axios.get(`/api/admin/groups/${props.match.params.group_id}`)
                .then((response) => {
                    setState({
                        studentGroup: response.data.studentGroup,
                        group: response.data.group,
                        loader: false
                    })
                })
                .catch((error) => {

                });
        }

        getData();
    }, []);

    return (
        <>
            {state.group &&
            <div className="d-flex align-items-center mb-4">
                <h4 className="mb-0">Lista e studentëve - Grupi {state.group.number}</h4>
            </div> }

            <div className="row">
                <div className="col-sm-12 col-md-12">
                    <div className="card my-shadow border-0">
                        <table className="table my-table">
                            <thead>
                            <tr>
                                <th scope="col"/>
                                <th scope="col">Emri</th>
                                <th scope="col">Email</th>
                            </tr>
                            </thead>
                            <tbody>
                            {state.studentGroup.map((studentGr,index) => {
                                let student = studentGr.student;
                                return (
                                    <tr key={student.student_id}>
                                        <th className="text-center" scope="row">{index + 1}</th>
                                        <td>{student.user.first_name} {student.user.last_name}</td>
                                        <td>{student.user.email}</td>
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
