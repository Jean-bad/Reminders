<template>
    <section class="cont">
        <div class="cont__modal">
            <form @submit.prevent="createreminder" method="post" class="cont__form">
                <div class="cont__container">
                    <lebel class="cont__label">Titulo</lebel>
                    <input v-model="title" type="text" placeholder="Titulo de tu recordatorio" class="cont__input">
                </div>
                <div class="cont__container">
                    <lebel class="cont__label">Descripcion</lebel>
                    <textarea v-model="description" name="descripcion" id="descripcion" cols="30" rows="10" placeholder="Escribe tu descripcion"></textarea>
                </div>
                <div class="cont__container">
                    <lebel class="cont__label">Fecha de rocordatorio</lebel>
                    <input v-model="reminder_date" type="datetime-local" placeholder="Escribe tu contraseña" class="cont__input">
                </div>
                <div class="cont__container">
                    <lebel class="cont__label">Frecuencia</lebel>
                    <select v-model="recurrence" name="recurrence" id="recurrence" class="cont__input">
                        <option value="Daily">Daily</option>
                        <option value="Monthly">Monthly</option>
                        <option value="Yearly">Yearly</option>
                    </select>
                </div>
                <div class="cont__container">
                    <button type="submit" class="cont__btn">Crear recordatorio</button>
                    <button @click="closeModal" type="submit" class="cont__btn">Cancelar</button>
                </div>
            </form>
        </div>
    </section>
</template>

<script>
    export default {
        props: {
            showModal: {
                type: Boolean,
            },
            closeModal: {
                type: Function,
            },
        },
        data() {
            return {
                title: '',
                description: '',
                reminder_date: '',
                recurrence: '',
            }
        },
        methods: {
            async createreminder() {
                try{
                const response = await fetch('http://127.0.0.1:8000/api/reminders',{
                method: 'POST',
                headers:{
                    'Content-Type': 'Application/json',
                    'Authorization': `Bearer ${localStorage.getItem('token')}`
                },
                body: JSON.stringify({
                    Title: this.title,
                    Description: this.description,
                    Reminder_date: this.reminder_date,
                    Recurrence: this.recurrence
                })
                });
                if (response.ok) {
                    this.closeModal();
                    location.reload();
                }
            }catch(e){
                console.error('Error al crear los datos', e);
            }
            }
        },
    }
</script>

<style lang="scss" scoped>
    .cont{
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
        &__container{
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