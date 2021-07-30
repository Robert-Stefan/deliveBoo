<template>
    <header>
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light back justify-content-between">
                <a class="navbar-brand" href="#">
                    <router-link class="text-decoration-none" :to="{ name: 'home' }">
                        <h1 class="title">DeliveBoo <i class="fas fa-ghost"></i></h1>
                    </router-link>
                </a>
                <button @click="showHamburger = !showHamburger" :class="{ 'collapsed' : showHamburger}" class="ham-color navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse flex-grow-0" :class="{ 'show' : showHamburger}" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto ">
                        <li class="nav-item active text-center" @click="showHamburger = false">
                            <router-link class="color icons nav-link" :to="{ name: 'home' }"><i class="fas fa-home icons"></i> <span class="color-span d-inline d-md-inline d-lg-none ml-3" >Home <hr></span> <span class="sr-only">(current)</span></router-link>
            
                        </li>
                        <li class="nav-item active text-center" @click="showHamburger = false">
                            <router-link class="color icons nav-link" :to="{ name: 'checkout' }"><i class="fas fa-cart-plus icons"></i> <span class="color-span d-inline d-md-inline d-lg-none ml-3" >Cassa <hr></span><span class="sr-only">(current)</span></router-link>
            
                        </li>
                        <li class="nav-item active  text-center" @click="showHamburger = false">
                            <router-link class="color icons nav-link" :to="{ name: 'aboutus' }"><i class="fas fa-users icons"></i><span class="color-span d-inline d-md-inline d-lg-none ml-3" >About<hr></span><span class="sr-only">(current)</span></router-link>
            
                        </li>
                        <li class="nav-item active  text-center" @click="showHamburger = false">
                            <a class="admin icons nav-link" href="http://127.0.0.1:8000/admin" target="_blank"><i class="fas fa-user-shield icons"></i> <span class="color-span d-inline d-md-inline d-lg-none ml-3">Area Riservata</span></a>
                        </li>
            
                    </ul>
            
                </div>
            </nav>
        </div>



    </header>
</template>

<script>
export default {
    name: "Header",
    data(){
        return{
            showHamburger:false,
        }
    },
};
</script>

<style lang="scss" scoped>
@import '../../sass/app';
    header {
        position: fixed;
        width: 100%;
        top: 0;
        padding: 10px !important;
        height: auto;
        z-index: 10;
        background-color: rgb(19, 217, 119, .95);
    }

    .title{
        font-size: 2.5rem;
        font-weight: bold;
        text-shadow: 2px 2px 3px black;
        
    }
    .top-menu {
        font-size: 1rem;    
    }

    .color {
        color: #fff;

        &:hover {
            color: #273936;
        }
    }

    .active{
        color: #273936;
    }
    .admin {
        color: #fff;
        &:hover {
            color: #273936;
        }
    }

    .icons{
        font-size: 25px;
        margin: 0 10px;
        color: #fff;
        &:hover {
            color: #273936;
        }
    }
    .ham-color{
        background-color: #fff;
    }
    a.navbar-brand{
        margin: 0;
    }
    .color-span{
        color: #fff;
    }
</style>
