<template>
    <section class="modify">
        <div class="modify__modal">
            <h3 style="margin-bottom: 12px; font-weight: 700; color: #2715c4;">Actualizar usuario</h3>
            <form @submit.prevent="updateUser" method="post" class="modify__form">
                <div class="modify__modifyainer">
                    <lebel class="modify__label">Nombre</lebel>
                    <input v-model="userName" type="text"  class="modify__input">
                </div>
                <div class="modify__modifyainer">
                    <lebel class="modify__label">Email</lebel>
                    <input v-model="email" type="email" class="modify__input">
                </div>
                <div class="modify__modifyainer">
                    <button type="submit" class="modify__btn">Actualizar</button>
                    <button @click="closeModal" type="submit" class="modify__btn">Cancelar</button>
                </div>
            </form>
        </div>
    </section>
</template>

<script>
    export default {
        props: {
            closeModal: {
                type: Function
            },
        },
        data() {
            return {
                userName: '',
                email: ''
            }
        },
        methods: {
            async updateUser(){
            try{
                const response = await fetch('http://127.0.0.1:8000/api/auth/update-account',{
                    method: 'PATCH',
                    headers:{
                        'Content-Type': 'Application/json',
                        'Authorization': `Bearer ${localStorage.getItem('token')}`
                    },
                    body: JSON.stringify({
                        email: this.email,
                        name: this.userName,
                    })
                });
                if (response.ok) {
                    localStorage.removeItem('name')
                    localStorage.setItem('name', this.userName)
                    location.reload()
                }
            }catch(e){
                console.error('Error al eliminar el recordatorio', e);
            }
        }
        },
    }
</script>

<style lang="scss" scoped>
    .modify{
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
            height: 400px;
            width: 500px;
            border-radius: 8px;
            margin:auto;
        }
        &__title{
            font-weight:700;
            margin-bottom: 15px;
        }
        &__modifyainer{
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