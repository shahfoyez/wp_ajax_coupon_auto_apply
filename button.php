<style>
    #btn1{
        text-align: center;
        margin:  0 auto;
        display: block;
        font-family: 'Poppins';
        font-style: normal;
        font-weight: 500;
        font-size: 16px;
        border: 1px solid #FFFFFF;
        background: transparent;
        padding: 10px 20px;
        transition: .3s;
    }
    
    #btn1:hover{
        background-color: #FBB605;
    }
    
    #coupon-alert1{
        color: #fff;
        font-weight: 500;
        text-align: center;
    }
    
</style>
<!--<input id="myInput1" type="hidden" value="SUBSCRIPTION" >-->
<p id="coupon-alert1"></p>
<button id="btn1" onclick="myFunction1()">
    Code: SUBSCRIPTION
</button>


<script>
function myFunction1() {
  
    // Copy the text inside the text field
    navigator.clipboard.writeText("SUBSCRIPTION");
    
    document.getElementById("coupon-alert1").innerHTML = "Coupon Code Copied & applied.Just go to your cart and enjoy discount";
    
    setTimeout(()=>{
      document.getElementById("coupon-alert1").innerHTML = "";
    },3000)
    
    const coupon = "SUBSCRIPTION";
    jQuery(document).ready(function($){
    		$.ajax({
    		url: ajaxurl,
    		type: 'get',
    		data: {
    			'code': coupon,
    			'action': 'save_post_details_form' 
    		},
    		success: function(data) {
    			window.location.replace("https://www.janets.org.uk/cart/?add-to-cart=393651"); 
    		}
    	});
    });
    
}
</script>
