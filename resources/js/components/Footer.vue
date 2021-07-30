<template>
    <footer>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path
                fill="#273036"
                fill-opacity="1"
                d="M0,288L60,288C120,288,240,288,360,266.7C480,245,600,203,720,208C840,213,960,267,1080,266.7C1200,267,1320,213,1380,186.7L1440,160L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z"
            ></path>
        </svg>

        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <h2>Scopri DeliveBoo</h2>
                        <ul>
                            <li><a href="#">Investitori</a></li>
                            <li>
                                <router-link :to="{ name: 'aboutus' }">
                                    Chi Siamo
                                </router-link>
                            </li>
                            <li><a href="#">Ristoranti</a></li>
                            <li><a href="#">Altro</a></li>
                            <li><a href="#">Pressroom</a></li>
                            <li><a href="#">Il nostro blog</a></li>
                            <li><a href="#">Programmazione</a></li>
                            <li><a href="#">Design</a></li>
                            <li><a href="#">Lavora con noi</a></li>
                            <li><a href="#">Diventa nostro partner</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h2>Aiuto</h2>
                        <ul>
                            <li><a href="#">Termini e Condizioni</a></li>
                            <li><a href="#">Informativa sulla privacy</a></li>
                            <li><a href="#">Cookies</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h2>Porta DeliveBoo con te</h2>
                        <ul>
                            <li><a href="#"></a></li>
                            <li>
                                <a href="#">
                                    <img
                                        class="link-img"
                                        src="../../../public/image/apple.png"
                                        alt="App Store"
                                    />
                                </a>
                            </li>
                            <li>
                                <a href="#"
                                    ><img
                                        class="link-img"
                                        src="../../../public/image/android.png"
                                        alt="Google Play"
                                /></a>
                            </li>
                            <li class="socials-li mt-3">
                             
                                    <a class="socials" href="#"><i class="fab fa-facebook-square"></i></a>
                                    <a class="socials" href="#"><i class="fab fa-twitter" aria-hidden="true"></i></a>
                                    <a class="socials" href="#"><i class="fab fa-google-plus-g" aria-hidden="true"></i></a>
                                    <a class="socials" href="#"><i class="fab fa-instagram" aria-hidden="true"></i></a>
                                
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        <h4 class="text-center">DeliveBoo <i class="fas fa-ghost"></i></h4>
        </div>
    </footer>
</template>

<script>
export default {
    name: "Footer"
};
</script>

<style lang="scss" scoped>
@import "../../sass/app";
footer {
    .footer-bottom {
        width: 100%;
        padding: 20px;
        background-color: #273036;
        color: white;
        ul {
            padding: 0;
            list-style: none;
            a {
                color: white;
            }
            .link-img {
                margin-top: 20px;
                width: 150px;
            }
        }
    }
}

.socials-li {
    display: flex;
}

.socials i {
    font-size: 30px;
    padding: 10px;
    transition: color 0.4s;
}

.socials:nth-child(1) i:hover {
  color: #3b5998;
  text-shadow: 0 0 8px #3b5998;
}

.socials:nth-child(2) i:hover {
  color: #00aced;
  text-shadow: 0 0 8px #00aced;
}

.socials:nth-child(3) i:hover {
  color: #dd4b39;
  text-shadow: 0 0 8px #dd4b39;
}

.socials:nth-child(4) i:hover {
  color: #e4405f;
  text-shadow: 0 0 8px #e4405f;
}

</style>
