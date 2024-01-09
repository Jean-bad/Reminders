<script setup>
defineProps({
  msg: {
    type: String,
    required: true
  }
})
</script>

<template>
  <div class="greetings">
    <h1 class="green">{{ msg }}</h1>
    <nav>
        <RouterLink to="/login">Iniciar Sesion</RouterLink>
        <RouterLink to="/create-account">Registrarse</RouterLink>
    </nav>
  </div>
</template>

<style scoped>
nav{
  max-width: 400px;
  height: 40px;
  margin: 0 auto;
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 35px;
}
nav a{
  background-color: #0e0e0e;
  border-radius: 8px;
  padding: 8px 12px;
}
h1 {
  font-weight: 500;
  font-size: 2.6rem;
  position: relative;
  top: -10px;
}

h3 {
  font-size: 1.2rem;
}

.greetings h1,
.greetings h3 {
  text-align: center;
}

@media (min-width: 1024px) {
  .greetings h1,
  .greetings h3 {
    text-align: left;
  }
}
</style>
