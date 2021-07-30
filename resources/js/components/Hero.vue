<template>
  <div>
    <section class="hero">
        <div class="container d-flex justify-content-around align-items-center">
            <img class="hamburger-gif" src="../../../public/image/cute_food.gif" alt="">
            <h1 class="title">Consegniamo il tuo cibo preferito a casa tua!</h1>
            <img class="rider d-none d-lg-block" src="../../../public/image/rider_deliveboo.png" alt="">
        </div>
    </section>
    <svg class="wave" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
        <path fill="#13d977" fill-opacity="1" d="M0,288L60,272C120,256,240,224,360,218.7C480,213,600,235,720,245.3C840,256,960,256,1080,224C1200,192,1320,128,1380,96L1440,64L1440,0L1380,0C1320,0,1200,0,1080,0C960,0,840,0,720,0C600,0,480,0,360,0C240,0,120,0,60,0L0,0Z">
        </path>
    </svg>
    
  </div>
</template>

<script>
export default {
    name: "Hero"
}
</script>

<style lang="scss">
@import '../../sass/app';
    .hero {
        background: $brand-col;
        height: 300px;
        padding-top: 40px;
    }
    .container{
        position: relative;
    }
    .hamburger-gif {
        width: 500px;
    }    
    .rider{
        position: absolute;
        bottom: -160px;
        right: 50px;
        width: 250px;
        animation: move 3s infinite;
    }
    @keyframes move{
        from{
            right: 50px;
        }
        50%{
            transform: rotateY(0);
            right: 440px;
        }
        51%{
            transform: rotateY(180deg);
        }
        99%{
            transform: rotateY(180deg);
        }
        to{
            transform: rotateY(0);
            right: 50px;
        }
    }
    .title {
        font-size: 4rem;
        font-weight: bold;
        max-width: 500px;
        text-align: center;
        align-self: flex-start;
        color: #fff;
    }
    @media screen and (max-width:910px){
        .hamburger-gif{
            display: none;
        }
    }
    @media screen and (max-width:400px){
        .title{
            font-size: 3.5rem;
        }
    }

</style>