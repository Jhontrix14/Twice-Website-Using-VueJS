<template>
    <div class="col-4">
        <img :src="setImage(product.product_img_1)">
        <h4>{{product.product_name}}</h4>
        <div class="rating">
            <i class="fa fa-star" v-for="star  in getStars(product.rating).full" :key="star.full"></i>
            <i class="fa fa-star-half-o" v-for="star in getStars(product.rating).half" :key="star.half"></i>
            <i class="fa fa-star-o" v-for="star  in getStars(product.rating).empty" :key="star.empty"></i>
        </div>
        <p>${{product.prize}}</p>
    </div>
</template>
<script>
export default {
  name: 'Product-Container',
  props: ['product'],
  data() {
    return {
        
    }
},
computed: {
    
},
methods:{
    setImage(url){
      return require('../assets' + url);
    },
    getStars(rating){
        let ratingDifference = 5 - rating;
        let stars =  {
            half: (rating % 1 != 0) ? 1:0,
            full: Math.floor( rating ),
            empty:  Math.floor( ratingDifference )
        }
        return stars;
    }
  }
}
</script>

<style>
.col-4{
    flex-basis: 25px;
    padding: 10px;
    min-width: 200px;
    margin-bottom: 50px;
    transition: transform 0.5;
    cursor: pointer;
}
.col-4 img{
    width: 125%;
}
.col-4 p{
    font-size: 14px;
}
.col-4:hover{
    transform: translateY(-5px);
}
</style>