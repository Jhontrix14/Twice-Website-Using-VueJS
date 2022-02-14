<template>
    <div :class="{ header: getCurrentRoute === 'home' }">
      <div class = "container">
        <div class = "navbar">
            <div class = "logo">
                <router-link to="/"><img src = "../../assets/img/twice-logo.png" width="100px"></router-link>
            </div>
            <nav>  
                <ul :style="{ maxHeight: maxHeight + 'px' }">
                    <li><router-link to="/">Home</router-link></li>
                    <li><router-link to="/products">Products</router-link></li>
                    <li><router-link to="/about">About</router-link></li>
                    <li><router-link to="/account">Account</router-link></li>
                </ul>
            </nav>
            <router-link to="/cart"><img src="../../assets/img/cart.png" width="30px" height="30px"></router-link>
            <img src="../../assets/img/menu.png" class="menu-icon" @click="menutoggle">         
        </div>
        <div v-if="getCurrentRoute === 'home'" class="row">
            <div class="col-5">
                <h1>TWICE IN <br>WONDERLAND!!!</h1>   
                <p>Eyes Wide Open: PRE-ORDER STARTS</p>
                <a href="" @click.prevent="goToProducts" class="btn"> Shop Now! </a>
            </div>
            <div class="col-2">
                <img src="../../assets/img/EWO.jpg">
            </div>
        </div>
    </div>
    </div>
</template>

<script>
export default {
  name: "Header",
  data() {
    return {
      maxHeight: '0'
    }
  },
  computed:{
    getCurrentRoute() {
        return this.$route.name;
    }
  },
  watch: {
    getCurrentRoute() {
      this.maxHeight = '0';
    }
  },
  methods: {
    menutoggle() {
        if (this.maxHeight == '0') {
            this.maxHeight = '215';
        }
        else {
            this.maxHeight = '0';
        }    
    },
    goToProducts(){
       this.$router.push({ name: 'products' });
    }
  }
}
</script>