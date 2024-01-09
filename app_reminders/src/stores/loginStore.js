import { defineStore } from 'pinia'
export const useLoginStore = defineStore('loginStore',{
    id: 'login',
    state: () => ({
        email: '',
        password: '',
        nameUser: ''
    }),
    actions: {
        async login() {
            try{
                const response = await fetch('http://127.0.0.1:8000/api/auth/login', {
                    method: 'POST',
                    headers:{
                        'Content-Type': 'Application/json'
                    },
                    body: JSON.stringify({
                        email: this.email,
                        password: this.password
                    })
                });
                const data = await response.json()
                if (data.success === true) {
                    this.nameUser = data.user.name
                    localStorage.token = data.token
                }
            } catch(error){
                console.log(error);
            }
        }
    }
    })