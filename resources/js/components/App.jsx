import React, {useState, useEffect} from 'react';
import {
    BrowserRouter as Router,
    Route,
    Switch,
    Redirect
} from "react-router-dom";

import Layout from "./layouts/Main";
import ScrollToTop from "./utils/ScrollToTop";

// Students
import StudentsIndex from "./students/Index";
import StudentsCreate from "./students/Create";
import StudentsEdit from "./students/Edit";

// Subjects
import SubjectsIndex from "./subjects/Index";
import SubjectsCreate from "./subjects/Create";
import SubjectsTeachers from "./subjects/Teachers";
import SubjectsEdit from "./subjects/Edit";
import SubjectsStudentIndex from "./subjects/student/Index";

// Teachers
import TeachersIndex from "./teachers/Index";
import TeachersCreate from "./teachers/Create";
import TeachersEdit from "./teachers/Edit";

// Admins
import AdminsIndex from "./admins/Index";
import AdminsCreate from "./admins/Create";

// Groups
import GroupsIndex from "./groups/Index";
import GroupsCreate from "./groups/Create";
import GroupsShow from "./groups/Show";

// Classrooms
import ClassroomsIndex from "./classrooms/Index";
import ClassroomsCreate from "./classrooms/Create";

// Schedules
import SchedulesIndex from "./schedules/Index";
import SchedulesIndexStudent from "./schedules/student/Index";
import SchedulesIndexTeacher from "./schedules/teacher/Index";
import SchedulesCreate from "./schedules/Create";
import Cookies from "js-cookie";

export default function App(props) {

    const userCookie = Cookies.get("user");
    const user = userCookie ? JSON.parse(userCookie) : {};

    const redirect = () => {
        console.log(user)
        if(user.role == "student"){
            return <Route exact path='/' render={() => <Redirect to="/student/schedule"/>} />
        } else if (user.role == "teacher") {
            return <Route exact path='/' render={() => <Redirect to="/teacher/schedule"/>} />
        }else if (user.role == "admin") {
            return <Route exact path='/' render={() => <Redirect to="/admin/schedules"/>} />
        }
    }

    return (
        <Router>
            <Layout>
                <ScrollToTop/>
                <Switch>
                    {redirect()}
                    {/* Admin */}
                    <Route exact path='/admin/schedules' component={SchedulesIndex}/>
                    <Route exact path='/admin/schedules/create' component={SchedulesCreate}/>

                    <Route exact path='/admin/students' component={StudentsIndex}/>
                    <Route exact path='/admin/students/create' component={StudentsCreate}/>
                    <Route exact path='/admin/students/:student_id/edit' component={StudentsEdit}/>

                    <Route exact path='/admin/subjects' component={SubjectsIndex}/>
                    <Route exact path='/admin/subjects/create' component={SubjectsCreate}/>
                    <Route exact path='/admin/subjects/teachers' component={SubjectsTeachers}/>
                    <Route exact path='/admin/subjects/:subject_id/edit' component={SubjectsEdit}/>

                    <Route exact path='/admin/teachers' component={TeachersIndex}/>
                    <Route exact path='/admin/teachers/create' component={TeachersCreate}/>
                    <Route exact path='/admin/teachers/:teacher_id/edit' component={TeachersEdit}/>

                    <Route exact path='/admin/admins' component={AdminsIndex}/>
                    <Route exact path='/admin/admins/create' component={AdminsCreate}/>

                    <Route exact path='/admin/groups' component={GroupsIndex}/>
                    <Route exact path='/admin/groups/create' component={GroupsCreate}/>
                    <Route exact path='/admin/groups/:group_id' component={GroupsShow}/>

                    <Route exact path='/admin/classrooms' component={ClassroomsIndex}/>
                    <Route exact path='/admin/classrooms/create' component={ClassroomsCreate}/>

                    {/* Student */}
                    <Route exact path='/student/subjects' component={SubjectsStudentIndex}/>
                    <Route exact path='/student/schedule' component={SchedulesIndexStudent}/>

                    {/*Teacher*/}
                    <Route exact path='/teacher/schedule' component={SchedulesIndexTeacher}/>

                </Switch>
            </Layout>
        </Router>
    )
}
