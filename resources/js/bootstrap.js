/**
 * =================================================================================================
 * bootstrap.js (The "Equipment Setup" or "Translation Headset")
 * =================================================================================================
 *
 * ANALOGY:
 * Before the actors (Vue components) go on stage, we need to make sure their equipment works.
 * Specifically, we are setting up "Axios".
 *
 * Axios is like a "Universal Telephone" that lets our Javascript (Vue) talk to our PHP (Laravel).
 * It automatically handles headers, so we don't have to repeat protocols every time we make a call.
 */

import axios from "axios";
window.axios = axios;

// ACTION: Attach a special "ID Card" (X-Requested-With) to every single call.
// This tells Laravel: "Hey, I'm an AJAX request, not a human typing a URL."
window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
