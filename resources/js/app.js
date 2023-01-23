/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import "./bootstrap";
import { createApp } from "vue";
import axios from "axios";
/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

const app = createApp({});

import Form from "./components/Form.vue"
import Input from "./components/Input.vue"
import Select from "./components/Select.vue"
import Table from "./components/Table.vue"

app.component("app-form", Form);
app.component("app-input", Input);
app.component("app-select", Select);
app.component("app-table", Table);

app.mount("#app");


