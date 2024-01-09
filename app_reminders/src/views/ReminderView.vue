<template>
    <div class="content">
        <div class="content__nav">
            <h1>Bienvenido, {{ nameUser }}</h1>
            <button @click="logout" type="button">Cerrar sesion</button>
        </div>
        <div class="content__create">
            <button @click="openModal">➕ Crear recordatorio</button>
            <create-reminder v-if="showModal" :closeModal="closeModal"/>
        </div>
        <div class="content__reminders">
            <div v-for="item in reminderStore.reminders" :key="item.id">
                <h3> 📌 {{ item.Title }}</h3>
                <p>{{ item?.Description }}</p>
                <p>{{ item?.Reminder_date }}</p>
                <p>{{ item?.Recurrence }}</p>
                <button @click="openupdateModal(item.id)" type="button">Actualizar</button>
                <update-reminder v-if="update" :closeModal="closeUpdate" :reminderId="seledReminderId"/>
                <button @click="reminderStore.deleteReminder(item.id)" type="button">Eliminar</button>
            </div>
        </div>
    </div>
</template>

<script>
import {useLogoutStore} from '../stores/logoutStore';
import {useReminderStore} from '../stores/getReminderStore';
import CreateReminder from '@/components/CreateReminder.vue';
import UpdateReminder from '@/components/UpdateReminder.vue';
    export default {
        components: {
            CreateReminder,
            UpdateReminder
        },
        setup(){
            return {
                logoutStore:useLogoutStore(),
                reminderStore:useReminderStore()
            }
        },
        data() {
            return {
                nameUser: '',
                showModal: false,
                update: false,
                seledReminderId: null
            }
        },
        async mounted () {
            this.nameUser = localStorage.getItem('name');
            await this.reminderStore.getReminders();
        },
        methods: {
            async logout() {
                try {
                    await this.logoutStore.logoutUser();
                    this.$router.push({ name: 'login' });
                } catch (error) {
                console.error('Error al cerrar sesión:', error);
                }
            },
            openModal(){
                this.showModal = true
            },
            closeModal(){
                this.showModal = false
                this.update = false
            },
            closeUpdate(){
                this.update = false
            },
            openupdateModal(reminderId){
                this.seledReminderId = reminderId;
                this.update = true
            }
        },
    }
</script>

<style lang="scss" scoped>
    .content{
        background-color: #0f183075;
        width: 1000px;
        height: 800px;
        &__nav{
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px 30px;
        h1{
            font-weight: 600;
        }
        button{
            height: 40px;
            border-radius: 8px;
            padding: 0px 12px;
            border: none;
            font-size: small;
            background-color: #100664;
            font-weight: 700;
            color: #fff;
        }
    }
    &__reminders{
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        padding: 25px 30px;
        div{
            background-color: #0f183000;
            box-shadow: 2px 2px 8px;
            width: 280px;
            height: 200px;
            padding: 15px 25px;
            h3{
                font-weight: 700;
                font-size: larger;
            }
            button{
                height: 28px;
                border-radius: 8px;
                padding: 0px 12px;
                border: none;
                font-size: small;
                background-color: #4d41fa;
                font-weight: 700;
                color: #fff;
                margin-right: 10px;
                margin-top: 35px;
            }
        }
    }
    &__create{
        padding: 0px 40px;
        display: flex;
        align-items: center;
        button{
            height: 35px;
            border-radius: 8px;
            padding: 0px 12px;
            border: none;
            font-size: small;
            background-color: #4d41fa;
            font-weight: 700;
            color: #fff;
            margin-top: 35px;
        }
    }
    }
</style>