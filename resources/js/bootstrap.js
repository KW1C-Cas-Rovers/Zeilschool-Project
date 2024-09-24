import axios from "axios";
window.axios = axios;

window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

import { Calendar } from "@fullcalendar/core";
import dayGridPlugin from "@fullcalendar/daygrid";
import("@fullcalendar/daygrid/main.css");

window.calendar = Calendar;
window.dayGridPlugin = dayGridPlugin;
