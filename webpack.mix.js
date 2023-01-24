const mix = require("laravel-mix");

mix.js("./resources/js/Test.jsx", "/js").react();
mix.js("./resources/js/ProductDetail.jsx", "/js").react();
mix.js("./resources/js/User/ProfileRouter.jsx", "/js").react();
