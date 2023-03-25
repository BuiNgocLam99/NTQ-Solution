$("#colorSelect, #sizeSelect").select2({
    tags: true,
    placeholder: "Select or add tags",
});

$(document).ready(function () {

    $(".spinner-container").hide();

    $('#btn-create-variations').click(function(e){
        e.preventDefault();

        var colors = $('#colorSelect').val();
        var sizes = $('#sizeSelect').val();

        if(colors && sizes){
            $('#nav-items li').not(':first').remove();
            $('#tab-panes .tab-pane').not(':first').remove();
            $("#variation-colors").empty();
            
            for(var i = 0; i < colors.length; i++){

                // Add new nav link for each color
                var newNavItem = 
                '<li class="nav-item">' +
                    '<a id="' + colors[i] + '_nav-link" class="nav-link" data-bs-toggle="tab" href="#tab-pane_' + colors[i] +'" role="tab">' + colors[i]+ '</a>' +
                '</li>';
                $('#nav-items').append(newNavItem);

                // Add new tab pane for each color
                var newTabPane = $('<div class="tab-pane" id="tab-pane_' + colors[i] +'" role="tabpanel"></div>');
                
                // Add image input for each color
                var newImageInput =
                '<div class="d-flex flex-wrap justify-content-around" id="preview_' + colors[i] + '_image">' +
                '<label>' + colors[i] + '</label>' +
                '<input type="file" id="color_' + colors[i] + '" name="variations_color">' +
                '<img src="" width="200" accept="image/png, image/jpg, image/jpeg">' +
                '</div>';
                newTabPane.append(newImageInput);
                
                for(var j = 0; j < sizes.length; j++){
                    var variations =  
                    '<div class="card-body d-flex flex-wrap justify-content-around" name="product_variation_' + colors[i] + '_' + sizes[j] + '" id="product_variation_' + colors[i] + '_' + sizes[j] + '">' +
                        
                        '<label class="form-label">' + colors[i] + ' - ' + sizes[j] + ':</label>' +
                        '<div class="flex-item">' +
                            '<label class="form-label" for="price_' + colors[i] + '_' + sizes[j] +'">Price</label>' +
                            '<input type="text" class="form-control price-field" required placeholder="Enter Price" name="price" id="price_' + colors[i] + '_' + sizes[j] +'">' +
                        '</div>' +
                        
                        '<div class="flex-item">' +
                            '<label class="form-label" for="quantity_' + colors[i] + '_' + sizes[j] +'">Quantity</label>' +
                            '<input type="text" class="form-control quantity-field" required placeholder="Enter Quantity" name="quantity" id="quantity_' + colors[i] + '_' + sizes[j] +'">' +
                        '</div>' +

                        '<div class="flex-item">' +
                            '<input type="hidden" name="color" value="' + colors[i] + '">' +
                            '<input type="hidden" name="image" class="color_' + colors[i] + '" value="color_' + colors[i] + '"> ' +
                        '</div>' +
                            
                    '</div>';
                    newTabPane.append(variations);
                }
                $('#tab-panes').append(newTabPane);

                // On change image field
                $('div[id*=preview_] input').change(function(){
                    if(this.files && this.files[0]){
                        var parent = $(this).parent();
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            parent.find('img').attr('src', e.target.result);
                        }
                        reader.readAsDataURL(this.files[0]);
                    }
                });
                
                // On change quantity field
                $('#tab-panes input[id*=quantity_]').on('change', function() {
                    var totalQuantity = 0;
                    $('#tab-panes input[id*=quantity_]').each(function() {
                        var quantity = parseInt($(this).val());
                        if (!isNaN(quantity)) {
                            totalQuantity += quantity;
                        }
                    });
                    $('#product-quantity').val(totalQuantity);
                });

                // On change price field
                $('#tab-panes input[id*=price_]').on('change', function() {
                    var maxPrice = null;
                    var minPrice = null;
                    $('#tab-panes input[id*=price_]').each(function() {
                        var price = parseFloat($(this).val()); // Get the numeric value of the price

                        // If the price is valid
                        if (!isNaN(price)) {
                            // If the maximum price is null or the current price is greater than the maximum price
                            if (maxPrice == null || price > maxPrice) {
                                maxPrice = price; // Set the maximum price to the current price
                            }

                            // If the minimum price is null or the current price is less than the minimum price
                            if (minPrice == null || price < minPrice) {
                                minPrice = price; // Set the minimum price to the current price
                            }
                        }
                    });
                    if (maxPrice != null && minPrice != null) {
                        $('#product-price').val('$' + minPrice.toFixed(2) + ' - $' + maxPrice.toFixed(2)); // Format and update the '#price' field
                    }

                    if(!maxPrice && !minPrice){
                        $('#product-price').val('');
                    }
                });
            }
        }
    })
})

