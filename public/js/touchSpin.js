$(document).ready(function() {
    var spinner = $('#bed-spinner');
    if (spinner && spinner.TouchSpin) {
        $('#bed-spinner').TouchSpin({
            min: 0,
            max: 15,
            stepintervaldelay: 500,
            postfix: "Bedrooms",
            postfix_extraclass: "bed-bath"
        });
    }
  
      var spinner = $('#bath-spinner');
    if (spinner && spinner.TouchSpin) {
        $('#bath-spinner').TouchSpin({
            min: 0,
            max: 15,
            stepintervaldelay: 500,
            postfix: "Bathrooms",
            postfix_extraclass: "bed-bath bath"
        });
    }
});