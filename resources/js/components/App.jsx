import React, {useState, useEffect} from 'react';
import {
    BrowserRouter as Router,
    Route,
    Switch
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

export default function App(props) {
    return (
        <Router>
            <Layout>
                <ScrollToTop/>
                <Switch>
                    {/* Admin */}
                    <Route exact path='/admin/students' component={StudentsIndex}/>
                    <Route exact path='/admin/students/create' component={StudentsCreate}/>
                    <Route exact path='/admin/students/:student_id/edit' component={StudentsEdit}/>

                    <Route exact path='/admin/subjects' component={SubjectsIndex}/>
                    <Route exact path='/admin/subjects/create' component={SubjectsCreate}/>
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
                </Switch>
            </Layout>
        </Router>
    )
}
