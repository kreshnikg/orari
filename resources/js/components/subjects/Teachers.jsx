import React, {useState, useEffect, useRef} from 'react';
import axios from "axios";
import {Link} from "react-router-dom";
import swal from "@sweetalert/with-react";

export default function Teachers(props) {

    const API_BASE_URL = '/api/admin/subjects/teachers';
    let semester = useRef(null);
    const [state, setState] = useState({
        semesters: [],
        teachers: [],
        subjects: [],
        studentCount: 0,
        loader: true
    })

    const [select, setSelect] = useState({
        selectedSemester: null,
        selectedSubject: null,
        selectedTeachers: [],
    })

    useEffect(() => {

        getData();

    }, [select.selectedSemester]);

    const getData = () => {
        let options = {
            params: {
                semester: select.selectedSemester
            }
        }
        axios.get(API_BASE_URL, options)
            .then((response) => {
                setState({
                    semesters: response.data.semesters,
                    teachers: response.data.teachers,
                    subjects: response.data.subjects,
                    studentCount: response.data.studentCount,
                    loader: false
                })
            })
            .catch((error) => {

            });
    }

    const selectSubject = (subject) => {
        let teacherIds = [];
        subject.subject_teacher.map((subjectTeacher) => {
            teacherIds.push(subjectTeacher.teacher_id);
        })
        setSelect({
            ...select,
            selectedTeachers: teacherIds,
            selectedSubject: subject
        })
    }

    const selectTeacher = (teacherId) => {
        let teacherData = [...select.selectedTeachers];
        if (teacherData.includes(teacherId)) {
            teacherData.splice(teacherData.indexOf(teacherId), 1);
        } else {
            teacherData.push(teacherId);
        }
        setSelect({
            ...select,
            selectedTeachers: teacherData
        })
    }

    const appendData = () => {
        let data = new FormData();
        data.append("subject", select.selectedSubject.subject_id);
        data.append("teachers", JSON.stringify(select.selectedTeachers));
        return data;
    }

    const registerHandler = () => {
        let data = appendData();
        axios.post(API_BASE_URL, data).then((response) => {
            getData();
            swal({
                icon: 'success',
                timer: 1500,
            });
        }).catch((error) => {

        })
    }

    const selectSemester = (semester) => {
        setSelect({
            selectedSemester: semester.semester_id,
            selectedTeachers: [],
            selectedSubject: null
        })
    }

    return (
        <>
            <div className="d-flex align-items-center mb-4">
                <h4 className="mb-0">Caktimi i ligjëruesve për lëndët</h4>
            </div>
            <div className="card border-0 my-shadow">
                <div className="card-body">
                    <div className="form-group">
                        <label htmlFor="semester">Semestri</label>
                        <select ref={semester} className="form-control" name="semester" id="semester" required>
                            <option value="" disabled selected>Zgjidh një opsion</option>
                            {state.semesters.map((semester) => {
                                return (
                                    <option onClick={() => selectSemester(semester)} value={semester.semester_id}>
                                        {semester.description}
                                    </option>
                                )
                            })}
                        </select>
                    </div>
                    {select.selectedSemester &&
                    <>
                        <div className="d-flex align-items-center mb-4 mt-4">
                            <h5>Nr. studentëve në këtë semestër: <b>{state.studentCount}</b></h5>
                            {select.selectedSubject &&
                            <button onClick={registerHandler}
                                    className="btn btn-primary ml-auto my-btn-primary-color my-shadow">Ruaj
                            </button> }
                        </div>
                        <div className="row">
                            <div className="col-md-6">
                                <table className="table" style={{border: '1px solid #dee2e6'}}>
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Lëndët</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    {
                                        state.subjects.map((subject, index) => {
                                            return (
                                                <tr className={"cursor-pointer " + (select.selectedSubject && select.selectedSubject.subject_id === subject.subject_id ? "selected" : "")}
                                                    onClick={() => selectSubject(subject)}>
                                                    <th scope="row">{index + 1}</th>
                                                    <td>{subject.title}</td>
                                                    <td>
                                                        {subject.subject_teacher.length > 0 ?
                                                            <i className="fas fa-check"
                                                               style={{color: '#2dc1c1'}}/> : null
                                                        }
                                                    </td>
                                                </tr>
                                            )
                                        })
                                    }
                                    </tbody>
                                </table>
                            </div>
                            <div className="col-md-6">
                                {select.selectedSubject &&
                                <table className="table" style={{border: '1px solid #dee2e6'}}>
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Ligjëruesit</th>
                                        <th scope="col"/>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    {
                                        state.teachers.map((teacher, index) => {
                                            let selected = select.selectedTeachers.includes(teacher.teacher_id);
                                            return (
                                                <tr className={"cursor-pointer " + (selected ? "selected" : "")}
                                                    onClick={() => selectTeacher(teacher.teacher_id)}>
                                                    <th scope="row">{index + 1}</th>
                                                    <td>{teacher.user.first_name + ' ' + teacher.user.last_name}</td>
                                                    <td>
                                                        <input className="form-check-input" type="checkbox" checked={selected}/>
                                                    </td>
                                                    {/*<td className={select.selectedTeachers.includes(teacher.teacher_id) ? "" : "invisible"}>*/}
                                                    {/*    <div className="custom-control custom-radio">*/}
                                                    {/*        <input type="radio" id={`role${index}`} name={`role${index}`}*/}
                                                    {/*               className="custom-control-input"/>*/}
                                                    {/*        <label className="custom-control-label"*/}
                                                    {/*               htmlFor={`role${index}`}>Profesor</label>*/}
                                                    {/*    </div>*/}
                                                    {/*    <div className="custom-control custom-radio">*/}
                                                    {/*        <input type="radio" id={`role${index}b`} name={`role${index}`}*/}
                                                    {/*               className="custom-control-input"/>*/}
                                                    {/*        <label className="custom-control-label"*/}
                                                    {/*               htmlFor={`role${index}b`}>Asistent</label>*/}
                                                    {/*    </div>*/}
                                                    {/*</td>*/}
                                                </tr>
                                            )
                                        })
                                    }
                                    </tbody>
                                </table>
                                }
                            </div>
                        </div>
                    </>
                    }
                </div>
            </div>
        </>
    )
}
