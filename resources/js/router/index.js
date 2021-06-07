import {createWebHistory, createRouter} from "vue-router";

import Movies from '../components/Movies';
import AddMovie from '../components/AddMovie';
import EditMovie from '../components/EditMovie';
import RentMovie from '../components/RentMovie';

export const routes = [
    {
        name: 'homepage',
        path: '/',
        component: Movies
    },
    {
        name: 'movies',
        path: '/movies',
        component: Movies
    },
    {
        name: 'addmovie',
        path: '/movies/add',
        component: AddMovie
    },
    {
        name: 'editmovie',
        path: '/movies/edit/:id',
        component: EditMovie
    },
    {
        name: 'rentmovie',
        path: '/movies/rent/:id',
        component: RentMovie
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});

export default router;

