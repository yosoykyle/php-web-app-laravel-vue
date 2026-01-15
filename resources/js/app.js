/**
 * =================================================================================================
 *  App.js (The "Director")
 * =================================================================================================
 *
 *  ANALOGY:
 *  This file is the "Director" of the show.
 *  1. It imports the necessary tools (bootstrap, css).
 *  2. It finds the main actor (App.vue).
 *  3. It tells the actor to go on stage (mount to #app).
 */
import "./bootstrap";
import "../css/app.css";

import { createApp } from "vue";
import App from "./App.vue";

// Create the Vue application using 'App.vue' as the root component.
const app = createApp(App);

// "Action!" -> Mount the app to the HTML element with id="app".
app.mount("#app");
