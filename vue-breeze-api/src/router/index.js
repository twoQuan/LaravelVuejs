import {createWebHistory,createRouter} from "vue-router";
import Home from '../components/Home.vue'
import Login from '../components/Login.vue'
import Register from '../components/Register.vue'
import Profile from '../components/Profile.vue'
import ProfileChange from '../components/ProfileChange.vue'
import ProfilePass from '../components/ProfilePass.vue'
import ForgotPassword from '../components/ForgotPassword.vue'
import ResetPassword from '../components/ResetPassword.vue'

const routes = [
    {
        path:'/',
        name:'Home',
        component:Home
    },
    {
        path:'/login',
        name:'Login',
        component:Login
    },
    {
        path:'/register',
        name:'Register',
        component:Register
    },
    {
        path:'/profile',
        name:'Profile',
        component:Profile
    },
    {
        path: '/forgot-password',
        name: 'ForgotPassword',
        component: ForgotPassword
    },
    {
        path: "/password-reset/:token",
        name: "ResetPassword",
        component: () => import("../components/ResetPassword.vue"),
    },
    {
        path: '/:username',
        name: 'twitch',
        component: () => import('../components/twitchchannel.vue'),
        props: true,
    },
    {
        path:'/profile/change',
        name:'ChangeProfile',
        component:ProfileChange,
        props: true,
    },
    {
        path:'/profile/passwordreset',
        name:'ChangePass',
        component:ProfilePass
    },
    
]
const router = createRouter({

    history: createWebHistory(),
    routes,
})
export default router
