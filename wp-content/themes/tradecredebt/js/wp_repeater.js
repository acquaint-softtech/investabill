( function( $ ) {
  var regulated_savings_template = wp.template( "regulated_savings-group" );
  var unregulated_savings_template = wp.template( "unregulated_savings-group" );
  var high_yield_savings_template = wp.template( "high_yield_savings-group" );

  var regulated_return_template = wp.template( "regulated_return-group" );
  var credebt_guarantee_template = wp.template( "credebt_guarantee-group" );
  var high_yield_return_template = wp.template( "high_yield_return-group" );
  
  // Add
  $( document ).on( "click", ".regulated_savings-add", function() {
      $( ".regulated_savings-fields" ).append( regulated_savings_template() );
  } );
  
  // Remove
  $( document ).on( "click", ".regulated_savings-remove", function() {
      $( this ).closest( ".field-group" ).remove();
  } );

  // Add
  $( document ).on( "click", ".unregulated_savings-add", function() {
    $( ".unregulated_savings-fields" ).append( unregulated_savings_template() );
} );

// Remove
$( document ).on( "click", ".unregulated_savings-remove", function() {
    $( this ).closest( ".field-group" ).remove();
} );

// Add
$( document ).on( "click", ".high_yield_savings-add", function() {
  $( ".high_yield_savings-fields" ).append( high_yield_savings_template() );
} );

// Remove
$( document ).on( "click", ".high_yield_savings-remove", function() {
  $( this ).closest( ".field-group" ).remove();
} );

// Add
$( document ).on( "click", ".regulated_return-add", function() {
  $( ".regulated_return-fields" ).append( regulated_return_template() );
} );

// Remove
$( document ).on( "click", ".regulated_return-remove", function() {
  $( this ).closest( ".field-group" ).remove();
} );

// Add
$( document ).on( "click", ".credebt_guarantee-add", function() {
$( ".credebt_guarantee-fields" ).append( credebt_guarantee_template() );
} );

// Remove
$( document ).on( "click", ".credebt_guarantee-remove", function() {
$( this ).closest( ".field-group" ).remove();
} );

// Add
$( document ).on( "click", ".high_yield_return-add", function() {
$( ".high_yield_return-fields" ).append( high_yield_return_template() );
} );

// Remove
$( document ).on( "click", ".high_yield_return-remove", function() {
$( this ).closest( ".field-group" ).remove();
} );
} ) ( jQuery );