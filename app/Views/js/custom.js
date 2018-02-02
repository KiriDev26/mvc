


function addToCart(id) {
    console.log(addToCart);
    $.ajax({
        type: "post",
        data: {cart:id},
        url: '/shopCart',
        dataType:'json',
        error: function() {
            alert('Sho ygodno');
        }



    }).done(function(data){
        console.log(data);
        if (data.result.dataProduct.success){

            $('#cartCount').html(data.result.dataProduct.count);
            
            $('#add_to_cart_'+id).hide();
            $('#remove_in_cart_'+id).show();
        }


    })

}


function removeToProduct(id){
    $.ajax({
        type: "post",
        data: {cart:id},
        url: '/deleteProductCart',
        dataType:'json',
        error: function() {
            alert('Sho ygodno');
        }


    }).done(function(data){
        console.log(data);
        if (data.result.dataProduct.success){

            $('#cartCount').html(data.result.dataProduct.count);
            $('#add_to_cart_'+id).show();
            $('#remove_in_cart_'+id).hide();
        }


    })


}


function calculator(id){

    var quantity = $('#quantity_' + id).val();
    var price = $('#price_' + id).attr('value');
    var resultPrice = quantity * price;

    $('#priceOne_' + id).html(resultPrice);
    
    var total = $('.resultOne').attr('value') ;

   // var arr = total.split(', ' * 1);

    //var result = array_sum(arr);
    alert(total);

}

function array_sum( array ) {	// Calculate the sum of values in an array
    //
    // +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)

    var key, sum=0;

    // input sanitation
    if( !array || (array.constructor !== Array && array.constructor !== Object) || !array.length ){
        return null;
    }

    for(var key in array){
        sum += array[key];
    }

    return sum;
}



