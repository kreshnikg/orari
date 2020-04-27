import React, {useState, useEffect} from 'react';
import {
    BrowserRouter as Router,
    Route,
    Switch
} from "react-router-dom";

import Layout from "./layouts/Main";
import ScrollToTop from "./utils/ScrollToTop";
import StudentsIndex from "./students/Index";
import SubjectsIndex from "./subjects/Index";

export default function App(props) {
    return (
        <Router>
            <Layout>
                <ScrollToTop/>
                <Switch>
                    <Route exact path='/admin/students' component={StudentsIndex}/>
                    <Route exact path='/admin/subjects' component={SubjectsIndex}/>
                </Switch>
            </Layout>
        </Router>
    )
}
