import React, {useState, useEffect, useRef, Fragment} from 'react';
import axios from "axios";
import swal from "@sweetalert/with-react";

export default function Create(props) {

    const API_BASE_URL = "/api/admin/groups"

    let semester = useRef(null);

    const [studentCount, setStudentCount] = useState({})

    const [nrGroups, setNrGroups] = useState({
        lecture: 0,
        practice: 0,
        max: 0
    })

    const [state, setState] = useState({
        semesters: [],
        selectedSemester: null,
        studentsCount: null,
        groupsCreated: null
    });

    useEffect(() => {
        const getData = () => {
            axios.get(API_BASE_URL + "/create")
                .then((response) => {
                    setState({
                        ...state,
                        semesters: response.data.semesters
                    })
                })
                .catch((error) => {

                });
        }

        getData();
    }, []);

    const getStudentsCount = (semester) => {
        let semesterId = semester.semester_id;
        if (studentCount[semesterId] === undefined)
            axios.get(`${API_BASE_URL}/create/get-students-count/${semesterId}`)
                .then((response) => {
                    setStudentCount({
                        ...studentCount,
                        [semesterId]: response.data.studentsCount
                    })

                    setState({
                        ...state,
                        selectedSemester: semesterId,
                        groupsCreated: semester.group.length > 0
                    })
                })
                .catch((error) => {

                });
        else {
            setState({
                ...state,
                selectedSemester: semesterId,
                groupsCreated: semester.group.length > 0
            })
        }
    }

    useEffect(() => {
        let selectedSemester = state.selectedSemester;
        if (selectedSemester) {
            let max = 0;
            let stdCount = studentCount[selectedSemester];
            console.log("[stdCount]", stdCount)
            console.log("[selectedSemester]", selectedSemester)
            max = Math.floor(stdCount / 20);
            setNrGroups({
                lecture: 0,
                practice: 0,
                max: max
            })
        }
    }, [state.selectedSemester])

    const setNrGroupsHandler = (e, type) => {
        let value = e.target.value;

        if (value < 0)
            return;

        if (value > nrGroups.max)
            return;

        setNrGroups({
            ...nrGroups,
            [type]: value
        })
    }

    const generateGroupsHandler = () => {
        let data = new FormData();
        data.append("nr_groups_practice", nrGroups.practice);
        data.append("nr_groups_lecture", nrGroups.lecture);
        data.append("semester_id", state.selectedSemester);
        axios.post(API_BASE_URL, data).then((response) => {
            swal({
                icon: 'success',
                timer: 1500,
            });
            props.history.push('/admin/groups')
        })
    }

    const groupsCreatedAlert = <div className="alert alert-info" role="alert">
        <i className="fas fa-info-circle mr-1"/> Grupet për këtë semestër janë regjistruar!
    </div>;

    return (
        <div className="card border-0 my-shadow">
            <div className="card-body">
                <h5 className="card-title mb-4">Gjenerimi i grupeve</h5>
                <div className="form-group">
                    <label htmlFor="semester">Semestri</label>
                    <select ref={semester} className="form-control" name="semester" id="semester" required>
                        <option value="" disabled selected>Zgjidh një opsion</option>
                        {state.semesters.map((semester) => {
                            return (
                                <option onClick={() => getStudentsCount(semester)}
                                        value={semester.semester_id}>{semester.description}</option>
                            )
                        })}
                    </select>
                </div>
                {state.selectedSemester && (
                    state.groupsCreated ? groupsCreatedAlert :
                <>
                    <div className="form-group">
                        <div className="form-group">
                            <label htmlFor="nr_students">Nr. i studenteve</label>
                            <input className="form-control"
                                   type="text"
                                   disabled
                                   readOnly
                                   name="nr_students"
                                   id="nr_students"
                                   value={studentCount[state.selectedSemester]}/>
                        </div>
                    </div>
                    <div className="form-group">
                        <div className="form-group">
                            <label htmlFor="nr_groups_lecture">Nr. grupeve per ligjerata (max: {nrGroups.max})</label>
                            <input className="form-control"
                                   type="number"
                                   onChange={(e) => setNrGroupsHandler(e, "lecture")}
                                   value={nrGroups.lecture}
                                   name="nr_groups_lecture"
                                   id="nr_groups_lecture"/>
                        </div>
                    </div>
                    <div className="form-group">
                        <div className="form-group">
                            <label htmlFor="nr_groups_practice">Nr. grupeve per ushtrime (max: {nrGroups.max})</label>
                            <input className="form-control"
                                   type="number"
                                   onChange={(e) => setNrGroupsHandler(e, "practice")}
                                   value={nrGroups.practice}
                                   name="nr_groups_practice"
                                   id="nr_groups_practice"/>
                        </div>
                    </div>
                    <button className="btn btn-primary my-btn-primary-color"
                            type="button"
                            onClick={generateGroupsHandler}>
                        Gjenero listat
                    </button>
                </>)}
            </div>
        </div>
    )
}
