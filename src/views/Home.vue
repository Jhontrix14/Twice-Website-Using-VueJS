<template>
  <div class="home">
    <div class="categories">
        <div class="small-container">
            <div class="row">
                <div class="col-3">
                    <img src="../assets/img/twice-momo-adlv.jpg">
                </div>
                <div class="col-3">
                    <img src="../assets/img/twice-chae-adlv.jpg">
                </div>
                <div class="col-3">
                    <img src="../assets/img/twice-dahyun-adlv.jpg">
                </div>
            </div>
        </div>
    </div>


    <div class="small-container" v-if="isFetching === false">
        <h2 class="title"> Featured Products</h2>
        <div class="row">
          <ProductContainer  v-for="product in getFeatureProducts" :key="product.product_id" :product="product" @click.native="viewProduct(product.product_id)"></ProductContainer>
        </div>

        <h2 class="title">Latest Products</h2>
        <div class="row">
            <ProductContainer  v-for="product in getLatestProducts.slice(0,4)" :key="product.product_id" :product="product" @click.native="viewProduct(product.product_id)"></ProductContainer>
        </div>
        <div class="row">
             <ProductContainer  v-for="product in getLatestProducts.slice(4,8)" :key="product.product_id" :product="product" @click.native="viewProduct(product.product_id)"></ProductContainer>
        </div>
    </div>

    <div class="offer">
        <div class="small-container">
            <div class="row">
                <div class="col-5">
                    <img src="../assets/img/i-am-sana.jpg" class="sana-img">
                </div>

                <div class="col-5">
                    <p>Exclusively Available on Twice | Once</p>
                    <h1>YES, I AM SANA</h1>
                    <small> Expected Date of stock: 2021-04-08 <br>Inclusions: <br>
                        Photobook + accordion postcard set (8 sheets 1 set / portrait 7ea + message 1ea) + photo card (2 sheets 1 set / reservation privilege).<br>
                        Photobook: White ver. & Black ver. 2 types per cover / 224x290mm / 254p / the same 
                        -Accordion postcard set: 100x150mm / 1 set of 8 sheets / by version -Photo card: 58x88mm / 2 sheets 1 set / By version / Reservation privilege.<br> 
                        Special photo card: Insert only 50 of the initial quantity. 
                    </small>
                    <a href="" class="btn" @click.prevent="shopNow">Pre-Order Now &#8594;</a>           
                </div>
            </div>
        </div>
    </div>

    <div class="testimonial">
        <div class="small-container">
            <div class="row">
                <div class="col-3">
                    <i class="fa fa-quote-left"></i>
                    <p>
                        If I work hard, I can eat delicious foods
                    </p>
                    <i class="fa fa-quote-right"></i>
                    <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </div>
                    <img src="../assets/img/momo-better.jpg">
                    <h3>Hirai Momo</h3>
                </div>
                <div class="col-3">
                    <i class="fa fa-quote-left"></i>
                    <p>
                    Don’t mistakes silence for Weakness, smart people, don’t Plan big moves out loud    
                    </p>
                    <i class="fa fa-quote-right"></i>
                    <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </div>
                    <img src="../assets/img/mina-better.jpg">
                    <h3>MYOU MINA</h3>
                </div>
                <div class="col-3">
                    <i class="fa fa-quote-left"></i>
                    <p>
                        Work hard in silence Let success be your noise
                    </p>
                    <i class="fa fa-quote-right"></i>
                    <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </div>
                    <img src="../assets/img/sana-better.jpg">
                    <h3>Minatozaki Sana</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="brands">
        <div class="small-container">
            <div class="row">
                <div class="col-6">
                    <img src="../assets/img/Nexon-Logo.wine.png">
                </div>
                <div class="col-6">
                    <img src="../assets/img/Kyungnam Pharmacy.png">
                </div>
                <div class="col-6">
                    <img src="../assets/img/A'pieu Cosmetics logo.png">
                </div>
                <div class="col-6">
                    <img src="../assets/img/Nintendo logo.png">
                </div>
                <div class="col-6">
                    <img src="../assets/img/BENCH-LOGO-HR.png">
                </div>
            </div>
        </div>
    </div>

  </div>
</template>

<script>
import axios from 'axios';
import ProductContainer from '@/components/product-container'
export default {
  name: 'Home',
  components: {
    ProductContainer
  },
  data() {
    return {
      products:[],
      isFetching: true
    }
  },
  computed:{
    getFeatureProducts(){
      let featureProducts = [];
      for (let i = 0; i < 4; i++) {
        //convert number 1,0 to boolean
        let isFeature= Boolean(Number(this.products[i].is_feature));
        if (isFeature === true) {
          featureProducts.push(this.products[i]);
          }
        }
      return featureProducts;
    },
    getLatestProducts(){
      let latestProducts = [];
      for (let i = 0; i < this.products.length; i++) {
        //convert number 1,0 to boolean
        let isLatest = Boolean(Number(this.products[i].is_latest));
        if (isLatest === true) {
          latestProducts.push(this.products[i]);
          }
      }
      return latestProducts;
    }
  },
  async mounted(){
    this.isFetching = true;
    await this.getAllProduct();
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
    viewProduct(productId){
      this.$router.push({ name: 'product-details', params: { product_no: productId } })
    },
    shopNow(){
      this.$router.push({ name: 'products' })
    }
  }
}
</script>