import React, {useState, useEffect} from 'react';
import {
    BrowserRouter as Router,
    Route,
    Switch
} from "react-router-dom";

import ScrollToTop from "./utils/ScrollToTop";

import Login from "./auth/Login";
import Register from "./auth/Register";

export default function Guest(props) {
    return (
        <Router>
            <ScrollToTop/>
            <Switch>
                <Route exact path='/login' component={Login}/>
                <Route exact path='/register' component={Register}/>
            </Switch>
        </Router>
    )
}
