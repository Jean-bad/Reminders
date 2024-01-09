<template>
  <div>
    <HelloWorld msg="Bienvenidos a la prueba tecnica realizada por Jean Berrio!" />
  </div>
</template>

<script>
import HelloWorld from '@/components/HelloWorld.vue';
  export default {
    components: {
      HelloWorld,
    },
  }
</script>

<style lang="scss" scoped>
@media (min-width: 1024px) {
  .about {
    min-height: 100vh;
    display: flex;
    align-items: center;
  }
}
</style>