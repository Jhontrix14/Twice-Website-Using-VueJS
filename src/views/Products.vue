<template>
  <div class="products">
    <div class="small-container">
        <div class="row row-2">
            <h2>ALL PRODUCTS</h2>
            <select>
                <option>Default Sorting</option>
                <option>Sort by Price</option>
                <option>Sort by Popularity</option>
                <option>Sort by Ratings</option>
                <option>Sort by Sale</option>
            </select>
        </div>

        <div class="row" v-for="(productpart, index) in productsByPart" :key="index">
          <ProductContainer  v-for="product in productpart" :key="product.product_id" :product="product" @click.native="viewProduct(product.product_id)"></ProductContainer>
        </div>

        <div class="page-btn">
            <span>1</span>
            <span>2</span>
            <span>3</span>
            <span>4</span>
            <span>&#8594;</span>
        </div>

    </div>

  </div>
</template>

<script>
import axios from 'axios';
import ProductContainer from '@/components/product-container'
export default {
  name: 'Products',
  components: {
    ProductContainer
  },
  data() {
    return {
      products:[],
      productsByPart: []
    }
  },
  computed:{
    getProductsTotal(){
      return this.products.length;
    }
  },
  
  async mounted(){
    await this.getAllProduct();
    this.getProductsByPart();
  },
  methods: {
    async getAllProduct(){
      try {
        const response = await axios.get('http://localhost/twice/api/product/get-all.php');
        this.products = response.data;
      } catch (error) {
        alert(error.response.data.message);
        return [];
          }
    },
    getProductsByPart(){
      let productsSet = Math.ceil(this.getProductsTotal/4);
      for (let index = 0; index < productsSet; index++) {
        this.productsByPart.push([]);
      }
      for (let indexPart = 0; indexPart < this.productsByPart.length; indexPart++) {
        let start = indexPart * 4;
        let end = start + 4;
        for (let indexProduct = start; indexProduct < end; indexProduct++) {
          if (typeof this.products[indexProduct]  !== 'undefined'){
            this.productsByPart[indexPart].push(this.products[indexProduct])
          }
        }
      }
    },
    viewProduct(productId){
      this.$router.push({ name: 'product-details', params: { product_no: productId } })
    }
  }
}
</script>