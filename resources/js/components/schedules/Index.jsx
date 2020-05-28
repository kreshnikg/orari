import React, {useState, useEffect, useRef} from 'react';
import axios from "axios";
import {Link} from "react-router-dom";
import moment from "moment";
import swal from "@sweetalert/with-react";

export default function Index(props) {

    const [state, setState] = useState({
        schedules: [],
        semesters: [],
        subjects: []
    })

    const [semesterState, setSemesterState] = useState(1);

    useEffect(() => {
        getData();
    }, [semesterState])

    const getData = () => {
        let options = {
            params: {
                semester: semesterState || null
            }
        }
        axios.get("/api/admin/schedules", options).then((response) => {
            setState({
                schedules: response.data.schedules,
                subjects: response.data.subjects,
                semesters: response.data.semesters
            })
        })
    }

    const deleteHandler = (scheduleId) => {
        axios.post(`/api/admin/schedules/${scheduleId}/delete`).then((response) => {
            getData();
        })
    }

    const deleteAlert = (scheduleId) => {
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
                deleteHandler(scheduleId);
            }
        });
    };

    const getSchedule = (subjectTeacherId, day) => {
        let items = [];
        state.schedules.map((schedule) => {
            if (schedule.subject_teacher_id === subjectTeacherId && schedule.day_of_week === day) {
                items.push(
                    <p className="badge badge-secondary my-badge p-2 mb-2">
                        <span className="mr-1">Gr {schedule.group.number}</span>,
                        <span
                            className="mr-1">{moment.unix(schedule.start_time).format("HH:mm")} - {moment.unix(schedule.end_time).format("HH:mm")}</span>,
                        {schedule.classroom.number}{schedule.schedule_type.title}
                        <span style={{fontSize: "10px"}} onClick={() => deleteAlert(schedule.schedule_id)}
                              className="badge badge-danger ml-2 cursor-pointer">
                            <i className="fas fa-times"/>
                        </span>
                    </p>
                )
            }
        })
        return items
    }

    return (
        <>
            <div className="d-flex align-items-center mb-4">
                <h4 className="mb-0">Terminet</h4>
                <Link to="/admin/schedules/create" className="btn btn-primary ml-auto my-btn-primary-color my-shadow">Shto
                    termin</Link>
            </div>
            <div className="form-group">
                <label htmlFor="semester">Semestri</label>
                <select className="form-control" name="semester" id="semester" required>
                    <option value="" disabled selected>Zgjidh një opsion</option>
                    {state.semesters.map((semester) => {
                        return (
                            <option value={semester.semester_id} selected={semester.semester_id === semesterState}
                                    onClick={() => setSemesterState(semester.semester_id)}>{semester.description}</option>
                        )
                    })}
                </select>
            </div>
            <div className="row">
                <div className="col-md-12">
                    <div className="card my-shadow border-0">
                        <table className="table my-table table-bordered">
                            <tr>
                                <th></th>
                                <th scope="col">E Hënë</th>
                                <th scope="col">E Martë</th>
                                <th scope="col">E Mërkurë</th>
                                <th scope="col">E Enjte</th>
                                <th scope="col">E Premte</th>
                                <th scope="col">E Shtunë</th>
                            </tr>
                            {state.subjects.map((subject) => {
                                return (
                                    <>
                                        <tr style={{backgroundColor: "#f2f2f2"}}>
                                            <th>{subject.title}</th>
                                            <td colSpan={6}/>
                                        </tr>
                                        {subject.subject_teacher.map((subjectTeacher) => {
                                            return (
                                                <tr>
                                                    <td scope="row">
                                                        {subjectTeacher.teacher.user.first_name} {subjectTeacher.teacher.user.last_name}
                                                    </td>
                                                    {[1, 2, 3, 4, 5, 6].map((day) => {
                                                        return (
                                                            <td style={{fontSize: "14px"}}>{getSchedule(subjectTeacher.subject_teacher_id, day)}</td>
                                                        )
                                                    })}
                                                </tr>
                                            )
                                        })}
                                    </>
                                )
                            })}
                        </table>
                    </div>
                </div>
            </div>
        </>
    )
}
