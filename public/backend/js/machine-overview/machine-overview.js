$(function () {
    $('.chart').easyPieChart({
        // The color of the curcular bar. You can pass either a css valid color string like rgb, rgba hex or string colors. But you can also pass a function that accepts the current percentage as a value to return a dynamically generated color.
        // easing: 'easeOutBounce',
        barColor: '#D90165',
        barColor: '#94C120',
        barColor: '#22448B',
        barColor: '#0DB3CF',
        scaleColor: false,
        // The color of the track for the bar, false to disable rendering.
        trackColor: '#e5e5e5',
        rotate: 180,

        lineWidth: 10,
        // Size of the pie chart in px. It will always be a square.
        size: 200,
        // Time in milliseconds for a eased animation of the bar growing, or false to deactivate.
        animate: 1000,
        // Callback function that is called at the start of any animation (only if animate is not false).
        onStart: $.noop,
        // Callback function that is called at the end of any animation (only if animate is not false).
        onStop: $.noop
    });

    axios.get('./api/product/all')
        .then(function (response) {
             let products = response.data;
             var total_product = 0;
             var good_product = 0;
             var reject_rpoduct = 0;

             setInterval(() => {
                 for (let index = 0; index < products.length; index++) {
                     let random = getRandomInt(50, 100);
                     // QUALITY
                     $('.qty-product-' + products[index].id).data('easyPieChart').update(random);
                     $('span', $('.qty-product-' + products[index].id)).text(random);
                     
                     //  TOTAL PRODUCT
                     total_product += random;
                     good_product += random-36;
                     reject_rpoduct = total_product - good_product;
                    $('#total-product-' + products[index].id).html(total_product);
                    $('#good-product-' + products[index].id).html(good_product);
                    $('#reject-product-' + products[index].id).html(reject_rpoduct);
                 }
                  
             }, 1000);
             
        })
        .catch(function (error) {

            toastr.error("Failed !");
            $('#status').html('<span class="tx-12 align-self-center badge badge-danger">Failed</span>')

            console.log(error);
        });

    

    
    

    function getRandomInt(min,max) {
        // return Math.floor(Math.random() * Math.floor(max + 1));
        return Math.floor(Math.random() * (max - min + 1) + min);

    }
});