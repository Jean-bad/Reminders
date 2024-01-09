import { defineStore } from 'pinia'

export const useReminderStore = defineStore('getReminderStore',{
    id: 'reminders',
    state: () => ({
        reminders: [],
        Title: '',
        Description: '',
        Reminder_date: '',
        Recurrence: ''
    }),
    actions: {
        async getReminders(){
            try{
                const response = await fetch('http://127.0.0.1:8000/api/reminders',{
                    method: 'GET',
                    headers:{
                        'Content-Type': 'Application/json',
                        'Authorization': `Bearer ${localStorage.getItem('token')}`
                    }
                });
                const dataReminders = await response.json();
                this.reminders = dataReminders.data
            }catch(e){
                console.error('Error al obtener los datos', e);
            }
        },
        async deleteReminder(reminderId){
            try{
                const response = await fetch(`http://127.0.0.1:8000/api/reminders/${reminderId}`,{
                    method: 'DELETE',
                    headers:{
                        'Content-Type': 'Application/json',
                        'Authorization': `Bearer ${localStorage.getItem('token')}`
                    }
                });
                if (response.ok) {
                    location.reload()
                }
            }catch(e){
                console.error('Error al eliminar el recordatorio', e);
            }
        },
        async updateReminder(idReminder){
            try{
                const response = await fetch(`http://127.0.0.1:8000/api/reminders/${idReminder}`,{
                    method: 'PUT',
                    headers:{
                        'Content-Type': 'Application/json',
                        'Authorization': `Bearer ${localStorage.getItem('token')}`
                    },
                    body: JSON.stringify({
                        Title: this.Title,
                        Description: this.Description,
                        Reminder_date: this.Reminder_date,
                        Recurrence: this.Recurrence,
                    })
                });
                if (response.ok) {
                    location.reload()
                }
            }catch(e){
                console.error('Error al eliminar el recordatorio', e);
            }
        }
    }
    })