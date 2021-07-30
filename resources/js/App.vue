<template>
  <div class="app">
    <Header />

    <main>
      <router-view></router-view> 
    </main>

    <Footer />
  </div>
</template>

<script>
import Header from './components/Header.vue'
import Footer from './components/Footer.vue'

export default {
    name: 'App',
    components:{
        Header,
        Footer
    }
}
</script>

<style lang="scss">
    @import '../sass/app';

body {
    padding: 0 !important;
    margin: 0 !important;
    padding-top: 85px !important;
    box-sizing: border-box !important;
    background-color: rgb(252, 173, 26, .58) !important;
    font-family: 'Architects Daughter', cursive !important;
}

/* width */
::-webkit-scrollbar {
  width: 10px;
}

/* Track */
::-webkit-scrollbar-track {
  box-shadow: inset 0 0 5px grey; 
  border-radius: 10px;
}
 
/* Handle */
::-webkit-scrollbar-thumb {
  background: #273036bb; 
  border-radius: 10px;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #149756d5; 
}
a:hover{
  color: #0ea459 !important;
}

html {
  scroll-behavior: smooth;
}
</style>