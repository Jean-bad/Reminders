import { defineStore } from 'pinia'

export const useLogoutStore = defineStore('logoutStore',{
    id: 'logout',
    actions: {
        async logoutUser() {
            try{
                const response = await fetch('http://127.0.0.1:8000/api/auth/logout', {
                    method: 'POST',
                    headers:{
                        'Content-Type': 'Application/json',
                        'Authorization': `Bearer ${localStorage.getItem('token')}`
                    }
                });
                if (response.ok) {
                    localStorage.removeItem('token')
                    localStorage.removeItem('name')
                }
            } catch(error){
                console.log(error);
            }
            }
    }
    })