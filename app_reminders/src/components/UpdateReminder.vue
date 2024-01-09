<template>
    <section class="update">
        <div class="update__modal">
            <h3 style="margin-bottom: 12px; font-weight: 700; color: #2715c4;">Actualizar recordatorio</h3>
            <form @submit.prevent="reminderStore.updateReminder(reminderId)" method="post" class="update__form">
                <div class="update__updateainer">
                    <lebel class="update__label">Titulo</lebel>
                    <input v-model="reminderStore.Title" type="text"  class="update__input">
                </div>
                <div class="update__updateainer">
                    <lebel class="update__label">Descripcion</lebel>
                    <textarea v-model="reminderStore.Description" name="descripcion" id="descripcion" cols="30" rows="10" placeholder="Escribe tu descripcion"></textarea>
                </div>
                <div class="update__updateainer">
                    <lebel class="update__label">Fecha de rocordatorio</lebel>
                    <input v-model="reminderStore.Reminder_date" type="datetime-local" placeholder="Escribe tu updateraseña" class="update__input">
                </div>
                <div class="update__updateainer">
                    <lebel class="update__label">Frecuencia</lebel>
                    <select v-model="reminderStore.Recurrence" name="recurrence" id="recurrence" class="update__input">
                        <option value="Daily">Daily</option>
                        <option value="Monthly">Monthly</option>
                        <option value="Yearly">Yearly</option>
                    </select>
                </div>
                <div class="update__updateainer">
                    <button type="submit" class="update__btn">Actualizar recordatorio</button>
                    <button @click="closeModal" type="submit" class="update__btn">Cancelar</button>
                </div>
            </form>
        </div>
    </section>
</template>

<script>
import {useReminderStore} from '../stores/getReminderStore';
    export default {
        props: {
            showModal: {
                type: Boolean,
            },
            closeModal: {
                type: Function,
            },
            reminderId: {
                type: Number,
                required: true
            },
        },
        setup(){
            return {
                reminderStore:useReminderStore()
            }
        },
        data() {
            return {
                reminder: null
            }
        },
        mounted () {
            this.loadReminder();
        },
        methods: {
            async loadReminder() {
                try{
                const response = await fetch(`http://127.0.0.1:8000/api/reminders/${this.reminderId}`,{
                    method: 'GET',
                    headers:{
                        'Content-Type': 'Application/json',
                        'Authorization': `Bearer ${localStorage.getItem('token')}`
                    }
                });
                const dataReminders = await response.json();
                this.reminder = dataReminders.data
                }catch(e){
                console.error('Error al obtener los datos', e);
            }
            }
        },
    }
</script>

<style lang="scss" scoped>
    .update{
        position: fixed;
        display: flex;
        left: 0;
        top: 0;
        right: 0;
        bottom: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.685);
        &__modal{
            background-color: #0d152b;
            padding: 20px 45px;
            height: 700px;
            width: 500px;
            border-radius: 8px;
            margin:auto;
        }
        &__title{
            font-weight:700;
            margin-bottom: 15px;
        }
        &__updateainer{
            display: flex;
            flex-direction: column;
            margin-bottom: 10px;
            a{
                color: #1d7fff;
            }
        }
        &__input{
            height: 40px;
            padding: 5px 10px;
        }
        &__btn{
            height: 40px;
            border-radius: 10px;
            border: none;
            font-size: medium;
            background-color: #100664;
            font-weight: 700;
            color: #fff;
            margin-top: 20px;
            margin-bottom: 15px;
        }
    }
</style>