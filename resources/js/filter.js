

let min_price_catalog = parseFloat($('#min').val());
let max_price_catalog = parseFloat($('#max').val());
$( "#slider" ).slider({
    range: false,
    min: min_price_catalog,
    max: max_price_catalog,
    
    values: [ min_price_catalog, max_price_catalog ],
    slide: function( event, ui ) {
      $( "#min" ).show();
      $( "#max" ).show();
      $( "#min_defult" ).hide();
      $( "#max_defult" ).hide();

      $( "#min" ).val( ui.values[ 0 ] );
      $( "#max" ).val( ui.values[ 1 ] );
      
    }
  });