<template>

    <section class="container">
        <!-- ROW -->
        <section class="row mt-5">
            <!-- CART -->
            <div class="cart col-md-6 col-sm-12 text-center mb-3">
                    <h1>Il tuo Carrello</h1>
                    <h2 v-if="Object.keys(cart).length">
                        <router-link :to="{path: `/restaurant/${cart[Object.keys(this.cart)[0]].restaurant_slug}`}">
                            Ristorante: {{cart[Object.keys(this.cart)[0]].restaurant_name}}
                        </router-link>    
                    </h2>
                    <!-- SELECT COUNTER -->
                    <div v-if="Object.keys(cart).length" >
                        <div class="product" v-for="(item, index) in cart" :key="index">                
                            <div>
                                <button class="custom-btn btn-9 quantity minus" @click="remove(item.name, item.unit)"><i class="fas fa-minus"></i></button>
                                <input class="inputNum" type="number" min="1" v-model="item.quantità" @change="updateQuantity($event, item.name, item.unit)">
                                <button class="custom-btn btn-9 quantity plus" @click="add(item.name, item.unit)"><i class="fas fa-plus"></i></button>
                            </div>
                            <div>
                                <span class="name">{{item.name}}</span>
                                <span>€ {{item.prezzo.toFixed(2)}}</span>
                                <span class="remove" @click="removeAll(item.name, item.prezzo)"><i class="fas fa-times"></i></span>
                            </div>
                        </div>
                    </div>
                    <div v-else>Il carrello è vuoto</div>
                    <h3>Tot: €{{tot.toFixed(2)}}</h3>
                    <div class="text-right"><button class="custom-btn btn-9 delete" v-if="Object.keys(cart).length" @click="deleteCart()">Elimina</button></div>
            </div>
            <!-- PAYMENT FORM -->
            <div class="col-md-5 offset-md-1 col-sm-12" v-if="Object.keys(cart).length">
                <div class="form">
                    <div class="success-message" v-show="success">Il tuo ordine è stato inviato</div>
                    <!-- FORM -->
                    <form @submit.prevent="payWithCreditCard">

                        <div class="mb-3">
                            <label for="customer_name" class="control-label">Nome*</label>
                            <input type="text" class="form-control" id="customer_name" v-model="customer_name" required maxlength="50">
                            <div class="error-message" v-for="(error,index) in errors.customer_name" :key="`err-name-${index}`">{{error}}</div>
                        </div>
                        <div class="mb-3">
                            <label for="customer_lastname" class="control-label">Cognome*</label>
                            <input type="text" class="form-control" id="customer_lastname" v-model="customer_lastname" required maxlength="50">
                            <div class="error-message" v-for="(error,index) in errors.customer_lastname" :key="`err-lastname-${index}`">{{error}}</div>
                        </div>
                        <div class="mb-3">
                            <label for="customer_address" class="control-label">Indirizzo*</label>
                            <input id="customer_address" type="text" class="form-control" v-model="customer_address" required autocomplete="address" maxlength="50" autofocus>
                            <div class="error-message" v-for="(error,index) in errors.customer_address" :key="`err-address-${index}`">{{error}}</div>
                        </div>
                        <div class="mb-3">
                            <label for="phone_number" class="control-label">Numero di telefono*</label>
                            <input id="phone_number" type="text" class="form-control" v-model="phone_number" required autocomplete="phone_number"  minlength="10" maxlength="10" autofocus>
                            <div class="error-message" v-for="(error,index) in errors.phone_number" :key="`err-phone-${index}`">{{error}}</div>
                        </div>
                        <div class="card bg-light">
                            <div class="card-header">Informazioni di Pagamneto</div>
                            <div class="card-body">
                                <div class="alert alert-success" v-if="nonce">
                                    Successfully generated nonce.
                                </div>
                                <form>
                                    <div class="form-group">
                                        <label>Numero Carta</label>
                                        <div
                                            id="creditCardNumber"
                                            class="form-control"
                                        ></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-6">
                                                <label>Data Scadenza</label>
                                                <div
                                                    id="expireDate"
                                                    class="form-control"
                                                ></div>
                                            </div>
                                            <div class="col-6">
                                                <label>CVV</label>
                                                <div id="cvv" class="form-control"></div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <button type="submit" class="execute btn btn-block">Procedi all'ordine</button>
                        <div class="alert alert-danger" v-if="error">{{ error }}</div>
                    </form>
                </div>
            </div>

        </section>
        <!-- FINAL MESSAGE -->
        <div class="thanks-container" v-if="send" @click="closeModal">
                <div class="thanks">
                    <h1>Ordine Effettuato!
                         <img class="hamburger-gif" src="../../../public/image/hamburger.gif" alt="">
                    </h1>
                    <h2>Grazie per aver scelto DeliveBoo!!!</h2>
                </div>
        </div>

    </section>
</template>

<script>
import braintree from "braintree-web";

export default {
    name: 'CheckOut',
    data() {
        return {
            customer_name: '',
            customer_lastname: '',
            customer_address: '',
            phone_number: null,
            errors:{},
            success: false,
            sending: false,
            tot: 0,
            cart: {},
            hostedFieldInstance: false,
            nonce: "",
            error: "",
            send: false,
        }
    },
    created(){
        this.getBill();
    },
     mounted() {
        braintree.client
            .create({
                authorization: "sandbox_w3mbmmkd_mgtff9zhgfck2nfm"
            })
            .then(clientInstance => {
                let options = {
                    client: clientInstance,
                    styles: {
                        input: {
                            "font-size": "14px",
                            "font-family": "sans-serif",
                        }
                    },
                    fields: {
                        number: {
                            selector: "#creditCardNumber",
                            placeholder: "Inserisci numero carta"
                        },
                        cvv: {
                            selector: "#cvv",
                            placeholder: "CVV"
                        },
                        expirationDate: {
                            selector: "#expireDate",
                            placeholder: "00 / 0000"
                        }
                    }
                };
                return braintree.hostedFields.create(options);
            })
            .then(hostedFieldInstance => {
                // Use hostedFieldInstance to send data to Braintree
                this.hostedFieldInstance = hostedFieldInstance;
            })
            .catch(err => {
                console.error(err);
                this.error = err.message;
            });
    },
    methods: {
        sendOrder(){
            this.sendig = true;
            axios.post("http://127.0.0.1:8000/api/orders", {
                customer_name: this.customer_name,
                customer_lastname: this.customer_lastname,
                customer_address: this.customer_address,
                phone_number: this.phone_number,
                tot_paid: this.tot,
                restaurant_id: this.cart[Object.keys(this.cart)[0]].restaurant_id,
            })
            .then(res => {
                this.sendig = false;
                if(res.data.error){
                    console.log(res.data.error);
                    this.errors = res.data.error;
                    this.success = false;
                } else {
                    this.send = true;

                    this.customer_name = '';
                    this.customer_lastname = '';
                    this.customer_address = '';
                    this.phone_number = null;

                    this.errors = {};
                    this.success = true;

                    this.cart = {};
                    this.tot = 0; 
                    window.localStorage.clear();
                }
            })
            .catch(err => {
                console.log(err);
            })
        },
        getBill(){
            if(window.localStorage.getItem('cart')){
                this.cart = JSON.parse(window.localStorage.getItem('cart'));

                for(let item in this.cart){
                    this.tot+=this.cart[item].prezzo;

                };
            }
        },
        add(name, unit){
            this.cart[name].quantità ++;
            this.cart[name].prezzo += unit;
            this.tot += unit;
            this.store();
        },
        remove(name, unit){
            if(this.cart[name].quantità == 1){
                delete this.cart[name];
            } else {
                this.cart[name].quantità --;
                this.cart[name].prezzo -= unit;
            }
            this.tot -= unit;
            this.store();
        },
        removeAll(item, price){
            delete this.cart[item];
            this.tot -= price;
            this.store();
        },
        updateQuantity(e,name, unit){
            const value = parseFloat(e.target.value);
            if(value>0){
                console.log(value);
                this.cart[name].quantità = value;
                this.cart[name].prezzo = (value * unit);
                this.tot = 0;
                this.setTotal();
                this.store();
            } else {
                this.cart[name].quantità = 1;
                this.cart[name].prezzo = unit;
                this.tot = 0;
                this.setTotal();
                this.store();
            }
        },
        setTotal(){
            for(let item in this.cart){
                this.tot+=this.cart[item].prezzo;
            }; 
        },
        store(){
            window.localStorage.setItem('cart', JSON.stringify(this.cart));
        },
        deleteCart(){
            const resp = confirm('Vuoi cancellare il tuo ordine?');
            if(resp){
                this.cart = {};
                this.tot = 0; 
                window.localStorage.clear();
            } 
        },
         payWithCreditCard() {
            if (this.hostedFieldInstance) {
                this.error = "";
                this.nonce = "";
                this.hostedFieldInstance
                    .tokenize()
                    .then(payload => {
                        console.log(payload);
                        this.nonce = payload.nonce;
                        this.sendOrder();
                    })
                    .catch(err => {
                        console.error(err);
                        this.error = err.message;
                    });
            }
        },
        closeModal(){
            this.send = false;
        }
    }    
}
</script>

<style lang="scss" scoped>
@import '../../sass/app';
.cart {
    align-self: flex-start;
}

.form {
    background-color: $brand-col;
    padding: 1rem;
    border-radius: 10px;
}
.custom-btn{
    margin: 10px;
}

.delete{
    border-radius: 50px;
    overflow: hidden;
}
.error-message {
    color: red;
}
.success-message {
    color: green;
}
.thanks-container {
    z-index: 10;
    position: fixed;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    background-color: rgba(0, 0, 0, .6);

    .thanks {
        position: absolute;
        padding: 20px;
        border-radius: 10px;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: white;
    }
}

    .inputNum {
        width: 35px;
        -moz-appearance: textfield;

        &::-webkit-outer-spin-button,
        &::-webkit-inner-spin-button{
            -webkit-appearance: none;
        }
    }

.execute {
    margin: 20px 0 0;
    background-color:#273036;
    color: #fff;
    outline: none;
    &:hover{
        background-color:#fdcf7a;
    }
}

::placeholder {
    font-family: sans-serif;
}
.hamburger-gif{
    width: 80px;
    margin-left: 30px;
}
a{
    color: $brand-col;
    
    &:hover{
        text-decoration: none;
    }
}
</style>