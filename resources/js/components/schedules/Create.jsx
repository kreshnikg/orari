import React, {useState, useEffect, useRef} from 'react';
import axios from "axios";
import DatePicker from "react-datepicker";
import {Link} from "react-router-dom";
import swal from "@sweetalert/with-react";

export default function Create(props) {

    const [state, setState] = useState({
        subjects: [],
        semesters: [],
        classrooms: [],
        scheduleTypes: [],
        groups: [],
        days: [
            {number: 1, title: "E Hënë"},
            {number: 2, title: "E Martë"},
            {number: 3, title: "E Mërkurë"},
            {number: 4, title: "E Enjte"},
            {number: 5, title: "E Premte"},
            {number: 6, title: "E Shtunë"},
        ]
    });
    const [startDate, setStartDate] = useState(new Date());
    const [endDate, setEndDate] = useState(new Date());

    const [select, setSelect] = useState({
        semester: null,
        subject: null,
        classroom: null,
        teacher: null,
        scheduleType: null,
        group: null,
        dayOfWeek: null
    })

    useEffect(() => {
        getData();
    }, []);

    const getData = () => {
        axios.get('/api/admin/schedules/create')
            .then((response) => {
                setState({
                    ...state,
                    subjects: response.data.subjects,
                    semesters: response.data.semesters,
                    classrooms: response.data.classrooms,
                    scheduleTypes: response.data.scheduleTypes,
                    groups: response.data.groups
                })
            })
            .catch((error) => {

            });
    }

    const setSemester = (semester) => {
        setSelect({
            ...select,
            semester: semester.semester_id
        })
    }

    const setSubject = (subject) => {
        setSelect({
            ...select,
            subject: subject
        })
    }

    const setSubjectTeacher = (subjectTeacherId) => {
        setSelect({
            ...select,
            subjectTeacher: subjectTeacherId
        })
    }

    const setClassroom = (classroom) => {
        setSelect({
            ...select,
            classroom: classroom
        })
    }

    const setScheduleType = (scheduleType) => {
        setSelect({
            ...select,
            scheduleType: scheduleType
        })
    }

    const appendData = () => {
        let data = new FormData();
        data.append("semester", select.semester);
        data.append("subjectTeacher", select.subjectTeacher);
        data.append("classroom", select.classroom.classroom_id);
        data.append("scheduleType", select.scheduleType.schedule_type_id);
        data.append("dayOfWeek", select.dayOfWeek.number);
        data.append("group", select.group.group_id);
        data.append("startTime", parseInt(startDate.getTime() / 1000).toFixed(0));
        data.append("endTime", parseInt(endDate.getTime() / 1000).toFixed(0));
        return data;
    }

    const sendData = () => {
        let data = appendData();
        axios.post("/api/admin/schedules", data).then((response) => {
            swal({
                icon: 'success',
                timer: 1500,
            });
            props.history.push('/admin/schedules')
        })
    }

    return (
        <>
            <div className="d-flex align-items-center mb-4">
                <h4 className="mb-0">Shto termin</h4>
            </div>
            <div className="card my-shadow border-0">
                <div className="card-body">
                    <div className="row">
                        <div className="col-md-6">
                            <div className="form-group">
                                <label htmlFor="semester">Semestri</label>
                                <select className="form-control" name="semester" id="semester" required>
                                    <option value="" disabled selected>Zgjidh një opsion</option>
                                    {state.semesters.map((semester) => {
                                        return (
                                            <option value={semester.semester_id}
                                                    onClick={() => setSemester(semester)}>{semester.description}</option>
                                        )
                                    })}
                                </select>
                            </div>
                            <div className="form-group">
                                <label htmlFor="subject">Lënda</label>
                                <select className="form-control" name="subject" id="subject" required>
                                    <option value="" disabled selected>Zgjidh një opsion</option>
                                    {state.subjects.map((subject) => {
                                        return (
                                            <option value={subject.subject_id}
                                                    onClick={() => setSubject(subject)}>{subject.title}</option>
                                        )
                                    })}
                                </select>
                            </div>
                            {
                                select.subject &&
                                <div className="form-group">
                                    <label htmlFor="teacher">Ligjëruesi</label>
                                    <select className="form-control" name="teacher" id="teacher" required>
                                        <option value="" disabled selected>Zgjidh një opsion</option>
                                        {select.subject.subject_teacher.map((subjectTeacher) => {
                                            return (
                                                <option value={subjectTeacher.teacher_id}
                                                        onClick={() => setSubjectTeacher(subjectTeacher.subject_teacher_id)}>
                                                    {subjectTeacher.teacher.user.first_name} {subjectTeacher.teacher.user.last_name}
                                                </option>
                                            )
                                        })}
                                    </select>
                                </div>
                            }
                            <div className="form-group">
                                <label htmlFor="classroom">Klasa</label>
                                <select className="form-control" name="classroom" id="classroom" required>
                                    <option value="" disabled selected>Zgjidh një opsion</option>
                                    {state.classrooms.map((classroom) => {
                                        return (
                                            <option value={classroom.classroom_id}
                                                    onClick={() => setClassroom(classroom)}>
                                                {classroom.number} {classroom.classroom_type.description}
                                            </option>
                                        )
                                    })}
                                </select>
                            </div>
                            <div className="form-group">
                                <label htmlFor="schedule_type">Lloji terminit</label>
                                <select className="form-control" name="schedule_type" id="schedule_type" required>
                                    <option value="" disabled selected>Zgjidh një opsion</option>
                                    {state.scheduleTypes.map((scheduleType) => {
                                        return (
                                            <option value={scheduleType.schedule_type_id}
                                                    onClick={() => setScheduleType(scheduleType)}>
                                                {scheduleType.description}
                                            </option>
                                        )
                                    })}
                                </select>
                            </div>
                            <div className="form-group">
                                <label htmlFor="group">Grupi</label>
                                <select className="form-control" name="group" id="group" required>
                                    <option value="" disabled selected>Zgjidh një opsion</option>
                                    {state.groups.map((group) => {
                                        return (
                                            <option value={group.group_id}
                                                    onClick={() => setSelect({...select, group: group})}>
                                                Grupi {group.number} - {group.group_type.description}
                                            </option>
                                        )
                                    })}
                                </select>
                            </div>
                            <div className="form-group">
                                <label htmlFor="day_of_week">Dita e javës</label>
                                <select className="form-control" name="day_of_week" id="day_of_week" required>
                                    <option value="" disabled selected>Zgjidh një opsion</option>
                                    {state.days.map((day) => {
                                        return (
                                            <option value={day.number}
                                                    onClick={() => setSelect({...select, dayOfWeek: day})}>
                                                {day.title}
                                            </option>
                                        )
                                    })}
                                </select>
                            </div>
                        </div>
                        <div className="col-md-6">
                            <div className="form-group">
                                <p className="mb-2">Fillimi</p>
                                <DatePicker
                                    selected={startDate}
                                    onChange={date => setStartDate(date)}
                                    showTimeSelect
                                    className="form-control"
                                    showTimeSelectOnly
                                    timeIntervals={15}
                                    timeCaption="Time"
                                    dateFormat="HH:mm"
                                    timeFormat="HH:mm"
                                />
                            </div>
                            <div className="form-group">
                                <p className="mb-2">Mbarimi</p>
                                <DatePicker
                                    selected={endDate}
                                    onChange={date => setEndDate(date)}
                                    className="form-control"
                                    showTimeSelect
                                    showTimeSelectOnly
                                    timeIntervals={15}
                                    timeCaption="Time"
                                    dateFormat="HH:mm"
                                    timeFormat="HH:mm"
                                />
                            </div>
                            <button onClick={sendData} className="btn btn-primary my-btn-primary-color">Ruaj</button>
                        </div>
                    </div>
                </div>
            </div>
        </>
    )
}

