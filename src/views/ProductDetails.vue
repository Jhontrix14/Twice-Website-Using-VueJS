<template>
  <div class="product-details" v-if="isFetching === false">
    <ProductDetailsContainer :product_details="productDetail"></ProductDetailsContainer>
    <FeatureProducts :feature_products="featureProducts"></FeatureProducts>
  </div>
  
</template>

<script>
import axios from 'axios';
import ProductDetailsContainer from '@/components/product-details-container'
import FeatureProducts from '@/components/feature-products'
export default {
  name: 'ProductDetails',
  components: {
    ProductDetailsContainer,
    FeatureProducts
  },
  data() {
    return {
      products:[],
      productDetail: [],
      featureProducts:[],
      isFetching : true,
    }
  },
  computed:{
  },
  async created(){
    this.isFetching = true;
    await this.getAllProduct();
    await this.getProductDetails();
    this.getFeatureProducts();
    this.isFetching = false;
  },
  methods:{
    async getAllProduct(){
      try {
        const response = await axios.get('http://localhost/twice/api/product/get-all.php');
        this.products = response.data;
      } catch (error) {
        alert(error.response.data.message);
        return [];
          }
    },
    async getProductDetails(){
      try {
        const response = await axios.get('http://localhost/twice/api/product/get.php', {params: {id: this.$route.params.product_no}});
        this.productDetail = response.data;
      } catch (error) {
        alert(error.response.data.message);
        return false;
          }
    },
    getFeatureProducts(){
        for (let index = 0; index < 4; index++) {
          let randomId = Math.floor(Math.random() * this.products.length);
          this.featureProducts.push(this.products[randomId])
        }
    }
  }
}
</script>