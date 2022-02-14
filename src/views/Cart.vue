<template>
  <div>
    <div class="small-container cart-page">
      <table >
        <tr>
          <th>Product</th>
          <th>Quantity</th>
          <th>Subtotal</th>
        </tr>
        <template v-if="carts.length !== 0">
          <cart-container v-for="product in carts" :key="product.product_id" :cartProduct="product"></cart-container>
        </template>
        <tr v-if="carts.length === 0 && hasUser === true" class="no-data">
          <td class="td-no-data" colspan="3">
             <h1>No Products added to Cart!</h1>
          </td>
        </tr>
        <tr v-if="hasUser === false" class="no-data">
          <td class="td-no-data" colspan="3">
             <h1>No User Login!</h1>
             <h2>Please login first</h2>
          </td>
        </tr>
      </table>

      <div class="total-price" v-if="carts.length !== 0">
        <table>
          <tr>
            <td>Subtotal</td>
            <td>${{subtotal.toFixed(2)}}</td>
          </tr>
          <tr>
            <td>Tax</td>
            <td>${{tax.toFixed(2)}}</td>
          </tr>
          <tr>
            <td>Total</td>
            <td>${{total.toFixed(2)}}</td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import CartContainer from '@/components/cart-container';

export default {
  name: 'Cart',
  components: {
    CartContainer,
  },
  data() {
    return {
      carts: [],
      account_id: null,
    };
  },
  computed: {
      hasUser(){
          return this.$session.has('account_details');
      },
      subtotal(){
          let ammountSum = 0;
          for (let index = 0; index < this.carts.length; index++) {
              ammountSum = ammountSum + this.carts[index].total_prize;
          }
          return ammountSum;
      },
      tax(){
          return this.subtotal * 0.05;
      },
      total(){
          return this.subtotal + this.tax;
      }
  },
  async mounted() {
    if(this.$session.has('account_details') === true){
      this.account_id = this.$session.get('account_details')['account_id'];
      await this.getAllCart();
    }
  },
  methods: {
    async getAllCart(){
      try {
        const response = await axios.get('http://localhost/twice/api/cart/get-all-cart.php', {params: {account_id: this.account_id}});
        this.carts = response.data;
      } catch (error) {
        alert(error.response.data.message);
        return [];
      }
    }
  }
};
</script>
<style>
.cart-page {
  margin: 80px auto;
}
table {
  width: 100%;
  border-collapse: collapse;
}
.no-data {
    height: 300px;
}
.td-no-data {
  text-align: center !important;
  color: #1f4172;
}
.cart-info {
  display: flex;
  flex-wrap: wrap;
}
th {
  text-align: left;
  padding: 10px;
  color: #fff;
  background: #1f4172;
  font-weight: normal;
}
td {
  padding: 10px 5px;
}
td input {
  width: 50px;
  height: 30px;
  padding: 5px;
}
td small,
p {
  font-size: 18px;
}
td a {
  color: #1f4172;
  font-size: 16px;
}
td img {
  width: 200px;
  height: 200px;
  margin-right: 10px;
}
.total-price {
  display: flex;
  justify-content: flex-end;
}
.total-price table {
  border-top: 3px solid #1f4172;
  width: 100%;
  max-width: 400px;
}
td:last-child {
  text-align: right;
}
th:last-child {
  text-align: right;
}
</style>