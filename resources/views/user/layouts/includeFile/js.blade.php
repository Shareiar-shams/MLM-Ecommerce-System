<button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fa fa-arrow-up" aria-hidden="true"></i></button>
<!-- all script -->

<script type="text/javascript" src="{{asset('viewport/js/plugins/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('viewport/js/plugins/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('viewport/js/plugins/plugins-all.js')}}"></script>
<script type="text/javascript" src="{{asset('viewport/js/plugins/jquery-ui.js')}}"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/lity/2.4.0/lity.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js'></script>
<script src='{{asset('viewport/js/slick.min.js')}}'></script>
<script src='{{asset('viewport/js/filter.js')}}'></script>
<script src='{{asset('viewport/js/isotope.pkgd.js')}}'></script>
<script src="{{asset('viewport/js/main.js')}}"></script>
<!-- Page specific script -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>

@section('user_js_content')
@show
<script>

	var loader;

	function loadNow(opacity) {
	    if (opacity <= 0) {
	        displayContent();
	    } else {
	        loader.style.opacity = opacity;
	        window.setTimeout(function() {
	            loadNow(opacity - 0.05);
	        }, 50);
	    }
	}

	function displayContent() {
	    loader.style.display = 'none';
	    document.getElementById('preloader').style.display = 'block';
	}

	document.addEventListener("DOMContentLoaded", function() {
	    loader = document.getElementById('loader');
	    loadNow(1);
	});

	var delay_var = $('#newsletter-popup').data('delay'); // Assuming the response contains the delay value
    var delay = delay_var * 1000; //in milleseconds


	jQuery(document).ready(function($){

	  	setTimeout(function(){ showNewsletterPopup(); }, delay);
	  
	  	$('.popup-close').click(function(){
	      	$('.newsletter-overlay').hide();
	      
	      	//when closed create a cookie to prevent popup to show again on refresh
	      	setCookie('newsletter-popup', 'popped', 30);
	  	});
	});

	function showNewsletterPopup(){
	  	if( getCookie('newsletter-popup') == ""){
		    $('.newsletter-overlay').show();
		    setCookie('newsletter-popup', 'popped',30);
		}
		else{
		    // console.log("Newsletter popup blocked.");
		}
	}


	function setCookie(cname,cvalue,exminutes)
	{
	    var d = new Date();
	    d.setTime(d.getTime()+(exminutes * 60 * 1000));
	    var expires = "expires="+d.toGMTString();
	    document.cookie = cname+"="+cvalue+"; "+expires+"; path=/";
	}

	function getCookie(cname)
	{
	    var name = cname + "=";
	    var ca = document.cookie.split(';');
	    for(var i=0; i<ca.length; i++) 
	    {
	        var c = jQuery.trim(ca[i]);
	        if (c.indexOf(name)==0) return c.substring(name.length,c.length);
	    }
	    return "";
	}
	
    $(document).ready(function() {
	    $('.searchT').keyup(function() {
	        var query = $(this).val();

	        if (query.trim() === '') {
	            $('.serch-result').hide();
	            return;
	        }

	        $.ajax({
	            url: '/search/products', // Assuming this is the route to fetch products
	            method: 'GET',
	            data: { query: query },
	            success: function(response) {
	            	

	                var resultBox = $('.serch-result .s-r-inner');
	                resultBox.empty();

	                if (response.length > 0) {
	                	document.getElementById('seachResult').style.display = 'block';
	                    // $('.serch-result').show();
	                } else {
	                    $('.serch-result').hide();
	                    return;
	                }

	                $.each(response, function(index, product) {
	                	// Define the JavaScript variable with the route URL
					    var productDetailsRoute = "{{ route('productDetails', ['slug' => ':slug']) }}";

					    // Replace ":slug" placeholder with the actual product slug
					    productDetailsRoute = productDetailsRoute.replace(':slug', product.slug);

	                	var imageSrc = product.featured_image.startsWith('http') ? product.featured_image : '/storage/' + product.featured_image.replace('public/', '');

	                    var productRow = '<div class="product-card p-col">' +
	                        '<div class="entry">' +
	                        '<table class="table">' +
	                        '<tbody>' +
	                        '<tr>' +
	                        '<th>' +
	                        '<div class="entry-thumb">' +
	                        '<a href="'+ productDetailsRoute +'">' +
			                '<img height="60" width="50" src="' + imageSrc + '" alt="' + product.name + '">' +
			                '</a>' +
	                        '</div>' +
	                        '</th>' +
	                        '<th>' +
	                        '<div class="entry-content">' +
	                        '<h4 class="entry-title">' +
	                        '<a href="#" style="font-size: 12px;">' + product.name + '</a>' +
	                        '</h4>' +
	                        '<span class="entry-meta" style="font-size: 10px;">$' + product.price + '</span>' +
	                        '</div>' +
	                        '</th>' +
	                        '</tr>' +
	                        '</tbody>' +
	                        '</table>' +
	                        '</div>' +
	                        '</div>';

	                    resultBox.append(productRow);
	                });
	            }
	        });
	    });
	});

	@if(Session::has('message'))
        var type = "{{ Session::get('alert-type', 'info') }}";
        switch(type){
            case 'info':
                toastr.info("{{ Session::get('message') }}");
                break;
            
            case 'warning':
                toastr.warning("{{ Session::get('message') }}");
                break;

            case 'success':
                toastr.success("{{ Session::get('message') }}");
                break;

            case 'error':
                toastr.error("{{ Session::get('message') }}");
                break;
        }
    @endif
	// function openCity(evt, cityName) {
	//   	var i, tabcontent, tablinks;
	//   	tabcontent = document.getElementsByClassName("tabcontent");
	// 	for (i = 0; i < tabcontent.length; i++) {
	// 	    tabcontent[i].style.display = "none";
	// 	}
	//   	tablinks = document.getElementsByClassName("tablinks");
	// 	for (i = 0; i < tablinks.length; i++) {
	// 	    tablinks[i].className = tablinks[i].className.replace(" active", "");
	// 	}
	//   	document.getElementById(cityName).style.display = "block";
	//   	evt.currentTarget.className += " active";
	// }
	// // Get the element with id="defaultOpen" and click on it
	// document.getElementById("defaultOpen").click();


	function addToCart(productId) {
        var form = document.getElementById('cart-add-form-' + productId);
        var formData = new FormData(form);
        // Perform AJAX request
        $.ajax({
            url: form.action,
            method: form.method,
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                // Handle the success response
                toastr.success('Product added to cart successfully!');
                
                updateCartContents();
                

            },
            error: function (error) {
                // Handle the error response
                toastr.error('Error adding product to cart');
            }
        });
    }

    function updateCartContents() {
        // Send AJAX request to fetch updated cart contents
        $.ajax({
            url: '{{ route("getCartSessionDisplay") }}',
            method: 'GET',
            success: function (response) {
                // Update cart session display field with updated cart information
                $('#cart-session-display').html(response);
            },
            error: function (error) {
                console.log('Error fetching cart information');
            }
        });
    }

    

</script>