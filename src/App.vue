<template>
  <div id="app">
    <Header></Header>
    <router-view/>
    <Footer></Footer>
  </div>
</template>

<script>
import Header from './components/layouts/header';
import Footer from './components/layouts/footer'
export default {
  name:"app",
  components: {
    Header,
    Footer
  },
  data() {
    return {
      wew : 'asd'
    }
  },
  mounted(){
    this.$session.set('wew','wow');
  },
}
</script>
<style>
*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

.navbar {
    display: flex;
    align-items: center;
    padding: 20px;
}

nav {
    flex: 1;
    text-align: right;
}

.nav, ul {
    display: inline-block;
    list-style-type: none;
}

.nav, ul, li {
    display: inline-block;
    margin-right: 20px;
}

a{
    text-decoration: none;
    color: #555;
    font-size: large;
}

p{
    color: #555;
    font-size: 25px;
}

.menu-icon{
    width: 28px;
    margin-left: 20px;
    display: none;
}
.container {
    max-width: 1500px;
    margin: auto;
    padding-left: 25px;
    padding-right:25px;
}

.row{
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    justify-content: space-around;
}

.col-2{
    flex-basis: 50%;
    min-width: 300px;
}

.col-2 img{
    max-width: 100%;
    padding: 50px 0;
    filter: drop-shadow(0px 5px 3px black);
	
}

.col-2, h1{
    font-size: 40px;
    line-height: 60px;
    margin: 25px 0;
}

.btn {
    display: inline-block;
    background: #1f4172;
    color: #fff;
    padding: 8px 30px;
    margin: 30px 0;
    border-radius: 50px;
}

.header{
    background: radial-gradient(#fdf0f0, #febbbb);
}

.categories{
    margin: 70px 0;
}

.col-3{
    flex-basis: 30%;
    min-width: 250px;
    margin-bottom: 30px;
}

.col-3 img{
    width: 100%;
}

.small-container{
    max-width: 1380px;
    margin: auto;
    padding-left: 25px;
    padding-right: 25px;
}


.title{
    text-align: center;
    margin: 0 auto 80px;
    position: relative;
    line-height: 60px;
    color: #555;
}

.title::after{
    content: '';
    background: pink;
    width: 80px;
    height: 5px;
    border-radius: 5px;
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
}

h3{
    color: #555;
    font-weight: normal;
}

h4{
    color: #555;
    font-weight: normal;
}

.rating{
    color: #1f4172;
}

/*pre-order*/

.offer{
    padding: 50px 0;
    background: radial-gradient(#fdf0f0, #febbbb);
}


.col-5{
    flex-basis: 50%;
    min-width: 300px;
}

.col-5 img{
    max-width: 100%;
    padding: 50px 0;
    filter: drop-shadow(0px 5px 3px black);
}


small{
    color: #555;
    font-size: x-large;
    line-height: 40px;
}

/*testimonial*/

.testimonial{
    padding-top: 100px;
}

.testimonial .col-3{
    text-align: center;
    padding: 40px 20px;
    box-shadow: 0 0 20px 0px rgba(0, 0, 0, 0.1);
    cursor: pointer;
    transition: transform 0.5s;
}

.testimonial .col-3 img{
    width: 80px;
    margin-top: 20px;
    border-radius: 50%;
}

.testimonial .col-3:hover{
    transform:  translateY(-10px);
}

.fa.fa-quote-left{
    font-size: 34px;
    color: #1f4172;
}
.fa.fa-quote-right{
    font-size: 34px;
    color: #1f4172;
}

.col-3 p{
    font-size: 12px;
    margin: 12px 0;
    color: #777;
}

.testimonial .col-3 h3{
    font-weight: 600;
    color: #555;
    font-size: 16px;
}

/* brands*/

.brands{
    margin: 100px auto;
}

.col-6{
    width: 160px;
}

.col-6 img{
    width: 100%;
    cursor: pointer;
    filter: grayscale(100%);
}

.col-6 img:hover{
    filter: grayscale(0%);
}

/*footer*/


/*all products*/

.row-2{
    justify-content: space-between;
    margin: 100px auto 50px;
}

select{
    border: 1px solid #1f4172;
    padding: 5px;
}

select:focus{
    outline: none;
}

.page-btn{
    margin: 0 auto 80px;

}

.page-btn span{
    display: inline-block;
    border: 1px solid#1f4172;
    margin-left: 10px;
    width: 40px;
    height: 40px;
    text-align: center;
    line-height: 40px;
    cursor: pointer;
}

.page-btn span:hover{
    background: pink;
    color: #fff;
}

/*product details*/

.single-product{
    margin-top: 80px;

}

.single-product .col-5 img{
    padding:  0;
}

.single-product .col-5{
    padding: 20px;
}

.single-product h4{
    margin: 20px 0;
    font-size: 22px;
    font-weight: bold;
}

.single-product select{
    display: block;
    padding: 10px;
    margin-top: 20px;
}

.single-product input{
    width:  50px;
    height: 40px;
    padding-left: 10px;
    font-size: 20px;
    margin-right: 10px;
    border: 1px solid #1f4172;
}

input:focus{
    outline: none;
}

.single-product .fa{
    color: #1f4172;
    margin-left: 10px;
}

.prod-det{
    font-size: x-large;
}
.small-img-row{
    display: flex;
    justify-content: space-between;
}
.small-img-col{
    flex-basis: 34%;
    cursor: pointer;
}

/*media query menu*/

@media only screen and (max-width: 800px){

    nav ul{
        position: absolute;
        z-index: 1;
        top: 100px;
        left: 0;
        background: #333;
        opacity: 0.5;
        width: 100%;
        overflow: hidden;
        transition: max-height 0.5s;
    }

    nav ul li{
        display: block;
        margin-right: 50px;
        margin-top: 20px;
        margin-bottom: 10px;
    }

    nav ul li a{
        color: #fff;
    }

    .menu-icon{
        display: block;
        cursor: pointer;
   
}


/*media query for less than 600 screen size*/

@media only screen and (max-width: 600px){
    .row{
        text-align: center;
    }

    col-2, col-3, col-4{
        flex-basis: 100%;
    }
    .single-product .row{
        text-align: left;
    }
    .single-product .col-5{
        padding: 20px 0;
    }
    .single-product h1{
        font-size: 26px;
        line-height: 22px;
    } 
}
.accntimg{
    margin-top: -90px;
    margin-bottom: -60px;
    }
}
</style>
