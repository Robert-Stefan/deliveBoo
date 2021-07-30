<template>
  <div class="details">
    <div class="details-box">
      <span class="close" @click="$emit('close')"><i class="fas fa-times"></i></span>
      <h1 class="text-center">{{dishDetails.name}}</h1>
      <div class="dish-info">
        <h3>Ingredienti: </h3>
        <h4>{{dishDetails.ingredients}}</h4>
        <h3>Descrizione: </h3>
        <h4>{{dishDetails.description}}</h4>
      </div>
      <h3>€{{dishDetails.price.toFixed(2)}}</h3>
      <div class="text-center img-box"><img class="" v-if="dishDetails.image" :src="dishDetails.image" :alt="dishDetails.name" width="300"/></div>
    </div>
  </div>
</template>

<script>
export default {
    name: 'Dish',
    props:{
      dishDetails: Object,
    },
}
</script>

<style lang="scss" scoped>
.details{
  z-index: 10;
  position: fixed;
  top: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, .4);

  .details-box{
    width: 500px;
    padding: 10px;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%,-50%);
    background-color: #fff;
    border-radius: 10px;

    .dish-info{
      height: 170px;
      overflow: auto;
    }
    .close{
      cursor: pointer;
    }
  }
}
// .img-box{
//   height: 45%;
// }
img{
  width: 100%;
}
@media screen and (max-width: 550px){
  .details{
    .details-box{
      width: 300px;
      font-size: 0.8em;
    }
  }
}
</style>