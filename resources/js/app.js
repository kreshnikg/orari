import React from 'react';
import ReactDOM from 'react-dom';
import App from './components/App';
import Guest from './components/Guest';

require("bootstrap");
require("./custom");
window.axios = require("axios");
window.axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest'
};



if (document.getElementById('app')) {
    ReactDOM.render(<App/>, document.getElementById('app'));
}

if (document.getElementById('guest')) {
    ReactDOM.render(<Guest/>, document.getElementById('guest'));
}
