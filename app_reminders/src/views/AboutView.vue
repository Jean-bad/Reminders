<template>
  <div class="profile">
    <div class="profile__nav">
      <h2>Mi perfil</h2>
      <button @click="openModal" type="button">Actualizar perfil</button>
      <update-user v-if="showModal" :closeModal="closeModal" />
    </div>
    <div class="profile__main">
      <router-link to="/reminders" style="font-weight: 500; color: #4d41fa;">Ver mis recordatorios</router-link>
      <div class="profile__content">
        <h4>Nombre: {{ user.name }}</h4>
      </div>
      <div class="profile__content">
        <h4>Email: {{ user.email }}</h4>
      </div>
    </div>
  </div>
</template>

<script>
import UpdateUser from '../components/UpdateUser.vue';
  export default {
  components: { UpdateUser },
    data() {
      return {
        user: [],
        showModal: false
      }
    },
    mounted () {
      this.getUser();
    },
    methods: {
      async getUser() {
        const response = await fetch('http://127.0.0.1:8000/api/auth/me', {
          method: 'GET',
          headers:{
            'Content-Type': 'Application/json',
            'Authorization': `Bearer ${localStorage.getItem('token')}`
          }
        });
        const data = await response.json();
        this.user = data.user
    },
    openModal(){
      this.showModal = true
    },
    closeModal(){
      this.showModal = false
    }
    },
  }
</script>

<style lang="scss" scoped>
  .profile{
    background-color: #0f183075;
    width: 400px;
    height: 240px;
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
    &__main{
      padding: 10px 45px;
    }
    &__content{
      background-color: #031f6b1c;
      margin: 12px 0px;
    }
  }
</style>