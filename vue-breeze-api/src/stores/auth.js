import {defineStore} from "pinia";
import axios from "axios";

export const useAuthStore = defineStore("auth",{
    state:()=>({
        authUser:null,
        authErrors:[],
        authStatus:null,
        authUsers:[]
    }),
    getters:{
        user:(state)=>state.authUser,
        errors:(state)=> state.authErrors,
        status:(state)=>state.authStatus,
        users:(state)=>state.authUsers,
    },
    actions:{
        async getToken(){
            await axios.get("/sanctum/csrf-cookie");
        },
        async getUsers(){
            await this.getToken()
            const data  = await axios.get('/users');
            this.authUsers = data.data
        },
        async getUser(){
            await this.getToken()
            const data  = await axios.get('/api/user');
            this.authUser = data.data
        },
        async handleLogin(data){
            // this.authErrors = []
            await this.getToken();
            try {
                await axios.post("/login",{
                    email:data.email,
                    password:data.password
                });
                this.router.push("/")
            }catch (error){
                if(error.response.status ===422){
                    this.authErrors = error.response.data.errors
                }
            }


        },
        async handleProfile(data){
            await this.getToken();
            try {
                await axios.put("/profile",{
                    name:data.name,
                    email:data.email,
                    phone:data.phone,
                    address:data.address,
                });
                this.router.push("/profile")
            }catch (error){
                if(error.response.status ===422){
                    this.authErrors = error.response.data.errors
                }
            }
        },
        async handleRegister(data){
            await this.getToken();
            try {
                await axios.post("/register",{
                    name:data.name,
                    email:data.email,
                    password: data.password,
                    password_confirmation:data.password_confirmation
                });
                this.router.push("/")
            }catch (error){
                if(error.response.status ===422){
                    this.authErrors = error.response.data.errors
                }
            }
        },
        async handleLogout(){
            await this.getToken();
            await axios.post('/logout')
            this.authUser = null
            this.router.push("/")
        },
        async handleForgotPassword(email){
            try {
               const response = await axios.post("/forgot-password",{
                    email:email
                })
                this.authStatus = response.data.status
            }catch (error){
                if(error.response.status ===422){
                    this.authErrors = error.response.data.errors
                }
            }
        },
        async handleResetPassword(data){
            await this.getToken();
            try {
                await axios.put("/changepass",{
                    email:data.email,
                    password: data.password,
                    password_confirmation:data.password_confirmation
                });
                this.router.push("/profile")
            }catch (error){
                if(error.response.status ===422){
                    this.authErrors = error.response.data.errors
                }
            }
        },
    }
})
