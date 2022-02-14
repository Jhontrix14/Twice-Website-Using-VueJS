<template>
    <div class="small-container single-product">
        <div class="row">
            <div class="col-5">
                <img :src="setImage(highlightImage)" width="100%" id="productImg">

                <div class="small-img-row">
                    <div class="small-img-col">
                        <img :src="setImage(product_details.product_img_1)" @click="setHighlightImage(product_details.product_img_1)" width="100%" class="small-img">
                    </div>
                    <div class="small-img-col">
                        <img :src="setImage(product_details.product_img_2)" @click="setHighlightImage(product_details.product_img_2)" width="100%" class="small-img">
                    </div>
                    <div class="small-img-col">
                        <img :src="setImage(product_details.product_img_3)" @click="setHighlightImage(product_details.product_img_3)" width="100%" class="small-img">
                    </div>
                </div>

            </div>
            <div class="col-5">
                <h1>{{product_details.product_name}}</h1>
                <h4>${{product_details.prize}}</h4>
                <!-- <select>
                    <option>Select Size</option>
                    <option>XXL</option>
                    <option>XL</option>
                    <option>Large</option>
                    <option>Medium</option>
                    <option>Small</option>
                </select> -->
                <input v-model="addProductCart.quantity" type="number" value="1" min="1" @keydown="preventKeyInput($event)">
                <a href="" @click.prevent="addToCart" class="btn">Add to Cart</a>
                <h4> Product Details <i class="fa fa-indent"></i></h4>
                <p class="prod-det">ASIAN SIZE, Unisex, Material: Cotton + Nylon, <br> 
                    Style: Casual, Fabric Type: Broadcloth 
                    Sleeve Length(cm): Full <br>
                    Pattern Type: Print <br>
                    Sleeve Style: Regular <br>
                    Collar: Hooded <br>
                    Hooded: Yes</p>
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios';
export default {
  name: 'Product-Container',
  props: ['product_details'],
  data() {
    return {
        initialImage: '',
        addProductCart : {
          account_id: 0,
          product_id: 0,
          quantity: 1
      }
    }
},
mounted(){
    if (this.hasUser === true) {
        this.addProductCart.account_id = this.$session.get('account_details')['account_id'];
        this.addProductCart.product_id = this.product_details.product_id;
    }
},
computed: {
    hasUser(){
          return this.$session.has('account_details');
    },
    highlightImage() {
        return this.initialImage
    }
},
created(){
    this.initialImage = this.product_details.product_img_1;
},
methods:{
    addToCart(){
        if (this.hasUser === false) {
            alert('You need to login first before adding to cart');
            return false;
        }
        this.doAddToCart();
    },
    async doAddToCart(){
      if(this.addProductCart.account_id !== 0 || this.addProductCart.product_id !== 0 || this.addProductCart.quantity !== 0){
        try{
          const request = axios.create({
                headers : {
                    Accept: 'application/json',
                    'Content-Type' : 'application/json'
                },
            });
          const response = await request.post('http://localhost/twice/api/cart/add.php', this.addProductCart);
          alert(response.data.message);
        } catch (error) {
            alert('Failed to add to cart\n'+error.response.data.message);
            return false;
        }
    } else {
        alert('Invalid data');
    }
    },
    setImage(url){
      return require('../assets' + url);
    },
    setHighlightImage(url){
        this.initialImage = url;
    },
    preventKeyInput(evt){
       evt.preventDefault();
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