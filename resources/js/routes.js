import List from "./components/Properties/List";
import Welcome from "./components/Welcome";
import Add from "./components/Properties/Add";
import Edit from "./components/Properties/Edit";

// const Welcome = () => import('./components/Welcome.vue' /* webpackChunkName: "resource/js/components/welcome" */)
// const PropertiesList = () => import('./components/Properties/List.vue' /* webpackChunkName: "resource/js/components/category/list" */)
// const PropertiesCreate = () => import('./components/Properties/Add.vue' /* webpackChunkName: "resource/js/components/category/add" */)
// const PropertiesEdit = () => import('./components/Properties/Edit.vue' /* webpackChunkName: "resource/js/components/category/edit" */)

export const routes = [
    {
        name: 'home',
        path: '/',
        component: Welcome
    },
    {
        name: 'propertyList',
        path: '/property/:page?',
        component: List,
        props: true
    },
    {
        name: 'propertyEdit',
        path: '/property/:id/edit',
        component: Edit
    },
    {
        name: 'propertyAdd',
        path: '/property/add',
        component: Add
    }
]
