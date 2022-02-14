<template>
<div class="feature-products">
    <div class="small-container">
        <div class="row row-2">
            <h2>Related Products</h2>
            <p><router-link to="/products">View More</router-link></p>
        </div>
    </div>
        <div class="small-container">
            <div class="row">
                <ProductContainer  v-for="(product, index) in feature_products" :key="index" :product="product" @click.native="viewProduct(product.product_id)"></ProductContainer>
            </div>
        </div>
</div>
</template>
<script>
import ProductContainer from '@/components/product-container'
export default {
  name: 'Feature-Products',
  components: {
    ProductContainer,
  },
  props: ['feature_products'],
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
    viewProduct(productId){
      this.$router.push({ name: 'product-details', params: { product_no: productId } })
      location.reload();
    }
  }
}
</script>

<style>
</style>