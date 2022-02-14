<template>
  <tr>
    <td>
      <div class="cart-info">
        <img :src="setImage(cartProduct.product_img_1)"  @click="viewProduct(cartProduct.product_id)" style="cursor: pointer;">
        <div>
          <p>{{cartProduct.product_name}}</p>
          <small>Price: ${{cartProduct.prize}}</small><br />
          <a href="" @click.prevent="removeProduct">Remove</a>
        </div>
      </div>
    </td>
    <td><input v-model="cartProduct.quantity" type="number" min="1" @keydown="preventKeyInput($event)" @change="updateQuantity"></td>
    <td>${{cartProduct.total_prize.toFixed(2)}}</td>
  </tr>
</template>
<script>
import axios from 'axios';
export default {
  name: "CartContainer",
  props: ["cartProduct"],
  data() {
    return {
       updateProductData :{
        account_id : '',
        product_id: '',
        quantity: ''
      },
      deleteProductData :{
        account_id : '',
        product_id: '',
      },
    };
  },
  computed: {
    productQuantity() {
        return this.cartProduct.quantity;
    },
  },
  watch: {
    productQuantity(){
        let productTotalPrize = (this.cartProduct.quantity * this.cartProduct.prize).toFixed(2);
          this.cartProduct.total_prize = Number(productTotalPrize);
    }
  },
  methods: {
    setImage(url){
      return require('../assets' + url);
    },
    async updateQuantity() {
      try {
        this.updateProductData.account_id = this.$session.get('account_details')['account_id'];
        this.updateProductData.product_id = this.cartProduct.product_id;
        this.updateProductData.quantity = this.productQuantity;
        const request = axios.create({
                headers : {
                    Accept: 'application/json',
                    'Content-Type' : 'application/json'
                },
            });
        const response = await request.post('http://localhost/twice/api/cart/update.php', this.updateProductData);
        alert(response.data.message);
      } catch (error) {
        alert('Failed to update cart\n'+error.response.data.message);
        return false;
      }
    },

    removeProduct(){
        if (confirm("Are you sure you want to remove product?\nThis action cannot be undone") === true) {
            this.doRemoveProduct();
        } else {
            alert('You cancel removing product');
        }
    },

    async doRemoveProduct() {
      try {
        this.deleteProductData.account_id = this.$session.get('account_details')['account_id'];
        this.deleteProductData.product_id = this.cartProduct.product_id;
        const request = axios.create({
                headers : {
                    Accept: 'application/json',
                    'Content-Type' : 'application/json'
                },
            });
        const response = await request.post('http://localhost/twice/api/cart/delete.php', this.deleteProductData);
        alert(response.data.message);
        this.$router.go();
      } catch (error) {
        alert('Failed to remove product from cart\n'+error.response.data.message);
        return false;
      }
    },
    preventKeyInput(evt) {
       evt.preventDefault();
    },
    
    viewProduct(productId){
      this.$router.push({ name: 'product-details', params: { product_no: productId } })
    }

  },
};
</script>