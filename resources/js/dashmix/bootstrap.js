window._ = require('lodash');
window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// Import all vital core JS files..
import jQuery from 'jquery';
import SimpleBar from 'simplebar';
import Cookies from 'js-cookie';
import 'bootstrap';
import 'popper.js';
import 'jquery.appear';
import 'jquery-scroll-lock';
const Swal = window.Swal = require('sweetalert2');


// ..and assign to window the ones that need it
window.$ = window.jQuery  = jQuery;
window.SimpleBar          = SimpleBar;
window.Cookies            = Cookies;
