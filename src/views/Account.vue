<template>
  <div class="account">
    <div class="account-page">
    <div class="container">
        <div class="row">
            <div class="col-5">
                <img src="../assets/img/An4.png" width="100%" height="100%" class="accntimg">
            </div>
            <div class="col-5">
                <div class="form-container" v-show="isUserlogin===false">
                    <div class="form-btn">
                        <span @click="showLoginForm">Login</span>
                        <span  @click="showRegisterForm">Register</span>
                        <hr id="Indicator" :class="{'indicatorRegister':showRegister===true , 'indicatorLogin':showLogin===true}">
                    </div>
                    <form id="LoginForm" :class="{'showLoginForm':showLogin===true , 'hideLoginForm':showRegister===true}">
                        <input v-model="loginData.username" type="text" placeholder="Username">
                        <input v-model="loginData.password" type="password" placeholder="Password">
                        <button @click.prevent="doLogin" class="btn">Login</button>
                        <a href="">Forgot Password?</a>
                    </form>
                    <form id="RegForm" :class="{'showRegForm':showRegister===true , 'hideRegForm':showLogin===true}">
                        <input v-model="registerData.username" type="text" placeholder="Username">
                        <input v-model="registerData.email" type="email" placeholder="Email">
                        <input v-model="registerData.password" type="password" placeholder="Password">
                        <button @click.prevent="doRegister" class="btn">Register</button>
                    </form>
                </div>
                 <div class="form-container" v-show="isUserlogin===true">
                    <div class="form-btn">
                        <span>Logout</span>
                        <hr class="hr-line">
                        <button @click.prevent="doLogout" class="btn">Logout</button>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
  </div>
</template>
<script>
import axios from 'axios';
export default {
  name: 'Account',
  data(){
    return {
      showLogin: true,
      showRegister: false,
      loginData :{
        username : '',
        password: ''
      },
      registerData :{
        username : '',
        email: '',
        password: ''
      },
      account : {}
    }
  },
  computed:{
    isUserlogin(){
      return this.$session.has('account_details');
    }
  },
  mounted(){
    if(this.$session.has('account_details') === true){
      this.account = this.$session.get('account_details');
    }
  },
  methods:{
    showLoginForm(){
      this.showLogin = true;
      this.showRegister = false;
    },
    showRegisterForm(){
      this.showRegister = true;
      this.showLogin = false;
    },
    async doRegister(){
      if(this.checkFields() === true){
        try{
          const request = axios.create({
                headers : {
                    Accept: 'application/json',
                    'Content-Type' : 'application/json'
                },
            });
          const response = await request.post('http://localhost/twice/api/account/create.php', this.registerData);
          alert('Register complete\n'+response.data.message+ '\nLogging in.');
          this.loginData.username = this.registerData.username;
          this.loginData.password = this.registerData.password;
          this.doLogin();
      }catch (error) {
        alert('Failed to Login\n'+error.response.data.message);
        return false;
        }
      }
    },
    async doLogin(){
      if (this.loginData.username === '' || this.loginData.password === ''){
        alert('Please input username and password');
        return false;
      }
      try {
        const response = await axios.get('http://localhost/twice/api/account/get.php', {params: this.loginData});
        this.account = response.data;
      } catch (error) {
        alert('Failed to Login\n'+error.response.data.message);
        return false;
      }

      this.setAccountSession(this.account);
    },
    doLogout(){
      this.$session.remove('account_details');
      alert('Successful Logout');
      this.$router.go();
    },
    setAccountSession(account){
    this.$session.set('account_details', account);
    alert('Successful Login');
    this.$router.go();
    },
    checkFields(){
      if (this.registerData.username === '') {
          alert('Please input username');
          return false;
      }
      if (this.registerData.email === '') {
          alert('Please input email');
          return false;
      }
      if (this.registerData.password === '') {
          alert('Please input password');
          return false;
      }
      const regexEmail = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      let isValidEmail = regexEmail.test(this.registerData.email);
      if (isValidEmail === false) {
          alert('Invalid Email');
          return false;
      }
      return true;
    }
  },
}
</script>
<style scoped>
.account-page{
    padding: 50px 0;
    background: radial-gradient(#fdf0f0, #febbbb);
}
.form-container{
    background: #fff;
    width: 300px;
    height: 400px;
    position: relative;
    text-align: center;
    padding: 20px 0;
    margin: auto;
    box-shadow: 0 0 20px 0px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}
.form-container span{
    font-weight: bold;
    padding: 0 10px;
    color: #555;
    cursor: pointer;
    width: 100px;
    display: inline-block;
}
.form-btn{
    display: inline-block;
}
.form-container form{
    max-width: 300px;
    padding: 0 20px;
    position: absolute;
    top: 130px;
    transition: transform 1s;
}
form input{
    width: 100%;
    height: 30px;
    margin: 10px 0;
    padding: 0 10px;
    border: 1px solid #ccc;
}
form .btn{
    width: 100%;
    border: none;
    cursor: pointer;
    margin: 10px 0;
}
form .btn:focus{
    outline: none;
}
#LoginForm{
    left: -300px;
}
#RegFrom{
    left: 0%;
}
form a{
    font-size: 12px;
}
#Indicator{
    width: 100px;
    border: none;
    background: #1f4172;
    height: 3px;
    margin-top: 8px;
    transition: transform 1s;
}
.hr-line {
   width: 100px;
    border: none;
    background: #1f4172;
    height: 3px;
    margin-top: 8px;
}
.btn{
    width: 100%;
    border: none;
    cursor: pointer;
    margin: 10px 0;
}
.btn:focus{
    outline: none;
}
.showLoginForm{
  transform: translateX(300px);
}
.hideLoginForm{
  transform: translateX(0px);
}
.showRegForm{
  transform: translateX(0px);
}
.hideRegForm{
  transform: translateX(300px);
}
.indicatorLogin{
  transform: translateX(0px);
}
.indicatorRegister{
  transform: translateX(100px);
}
.accntimg{
    margin-top: -60px;
    margin-bottom: -90px;
}
</style>

