import React, {useState, useEffect, useRef} from 'react';
import axios from "axios";
import {Link} from "react-router-dom";
import moment from "moment";

export default function Index(props) {

    const [state, setState] = useState({
        schedules: [],
        subjects: []
    })

    useEffect(() => {
        getData();
    }, [])

    const getData = () => {
        axios.get("/api/student/schedule").then((response) => {
            setState({
                schedules: response.data.schedules,
                subjects: response.data.subjects
            })
        })
    }

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
                    </p>
                )
            }
        })
        return items
    }

    return (
        <>
            <div className="d-flex align-items-center mb-4">
                <h4 className="mb-0">Orari</h4>
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
