<template>
    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="footer-col-1">
                    <h3>Download Our App</h3>
                    <p>Download App for Android and ios mobile phone</p>
                    <div class="app-logo">
                        <img src="../../assets/img/play-store.png">
                        <img src="../../assets/img/app-store.png">
                    </div>
                </div>
                <div class="footer-col-2">
                    <img src="../../assets/img/twice-logo-big-white.png">
                    <p></p>
                </div>
                <div class="footer-col-3">
                    <h3>Useful Links</h3>
                    <ul>
                        <li>Coupons</li>
                        <li>Blog Post</li>
                        <li>Return Policy</li>
                        <li>Join Affiliate</li>
                    </ul>
                </div>
                <div class="footer-col-4">
                    <h3>Follow Us</h3>
                    <ul>
                        <li>Facebook</li>
                        <li>Twitter</li>
                        <li>Instagram</li>
                        <li>Youtube</li>
                    </ul>
                </div>
            </div>

            <hr>
            <p class="copyright">Copyright 2021</p>
        </div>
    </div>
</template>

<script>
export default {
  name: "Footer"
}
</script>
<style scoped>
.footer{
    background: #000;
    color: #8a8a8a;
    font-size: 14px;
    padding: 60px 0 20px;
}

.footer p{
    color: #8a8a8a;
}

.footer h3{
    color: #fff;
    margin-bottom: 20px;
}

.footer-col-1, .footer-col-2, .footer-col-3, .footer-col-4{
    min-width: 250px;
    margin-bottom: 20px;
}

.footer-col-1{
    flex-basis: 30%;
}

.footer-col-2{
    flex-basis: 1;
    text-align: center;
}

.footer-col-2 img{
    width: 180px;
    margin-bottom: 20px;
}

.footer-col-3, .footer-col-4{
    flex-basis: 12%;
    text-align: center;
}

ul{
    list-style-type: none;
}

.app-logo{
    margin-top: 20px;
}

.app-logo img{
    width: 140px;
}

.footer hr{
    border: none;
    background: #b5b5b5;
    height: 1px;
    margin: 20px 0;
}

.copyright{
    text-align: center;
}

</style>