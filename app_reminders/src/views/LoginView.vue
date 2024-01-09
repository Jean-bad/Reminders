<template>
    <div class="content">
        <h1 class="content__title">Bienvenido, digita tus credenciales</h1>
        <form @submit.prevent="login" method="post" class="content__form">
            <div class="content__container">
                <lebel class="content__label">Email</lebel>
                <input v-model="email" type="email" placeholder="Digita tu email" class="content__input">
            </div>
            <div class="content__container">
                <lebel class="content__label">Contraseña</lebel>
                <input v-model="password" type="password" placeholder="Escribe tu contraseña" class="content__input">
            </div>
            <div class="content__container">
                <button type="submit" class="content__btn">Iniciar sesion</button>
            </div>
            <div class="content__container">
                <a href="#">Registrate aqui!!</a>
                <a href="#">¿Olvidaste tu contraseña?</a>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        setup(){
            
        },
        data() {
            return {
                email: '',
                password: '',
            }
        },
        methods: {
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
                    localStorage.setItem('name',data.user.name)
                    localStorage.token = data.token
                    this.$router.push('/reminders')
                }
            } catch(error){
                console.log(error);
            }
        }
        },
    }
</script>

<style lang="scss" scoped>
    .content{
        background-color: #0f183075;
        padding: 20px 45px;
        height: 400px;
        border-radius: 8px;
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