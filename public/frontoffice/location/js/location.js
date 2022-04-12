$(document).ready(function() { 
    $(function() {
        $('#datetimepicker6').datetimepicker({
                    
                    format: 'DD/MM/YYYY'
                });
        $('#datetimepicker7').datetimepicker({
          useCurrent: false, //Important! See issue #1075
           format: 'DD/MM/YYYY'
        });
        $("#datetimepicker6").on("dp.change", function(e) {
          $('#datetimepicker7').data("DateTimePicker").minDate(e.date);
        });
        $("#datetimepicker7").on("dp.change", function(e) {
          $('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
        });
      });
      
      $('.input-number-increment').click(function() {
          var $input = $(this).parents('.input-number-group').find('.input-number');
          var val = parseInt($input.val(), 10);
          $input.val(val + 1);
           $input.attr( 'value', $input.val() );
         
        });
    
        $('.input-number-decrement').click(function() {
          var $input = $(this).parents('.input-number-group').find('.input-number');
          var val = parseInt($input.val(), 10);
          $input.val(val - 1);
          $input.attr( 'value', $input.val() );
          
        });
        
        /*	var people = $( "#people" ).val();
             $( ".show-rooms span.people" ).html( people ); */
        
        $( "input[type=number]" ).keyup(function() {
            var value = $( "input[type=number]#people" ).val();
            $( ".show-rooms span.people" ).text( value );
          })
          .keyup();
        $("#opinion :checkbox").click(() => {
          // Define constants for length of checked checkboxes array
          const selectedColorLength = $('#filtersop :checkbox').filter(':checked').length;
          const selectedTypeLength = $('#filter-options-type :checkbox').filter(':checked').length;
          // Hide all items in the list
          $(".wrap section").hide();
          // If NO checkboxes are selected in color-filter AND type-filter
          if (selectedColorLength < 1 && selectedTypeLength < 1) {
            // Show entire product list
            $(".wrap section").fadeIn();
            
          // If checkboxes are selected in the color-filter ONLY
          } else if (selectedColorLength >= 1 && selectedTypeLength < 1) {
            // For each of the checked checkboxes in the color-filter
            $("#filtersop :checkbox:checked").each((index, element) => {
              // Show items with the class of the value of the checkbox
              $("." + $(element).val()).fadeIn();
              });
          
          // If checkboxes are selected in the type-filter ONLY
          } else {
            // For each of the checked checkboxes in the color-filter
            $("#filtersop :checkbox:checked").each((index, element) => {
              // Define matched color-filter class
              let colorClass = $(element).val();
              // For each of the checked checkboxes in the type-filter
              $("#filter-options-type :checkbox:checked").each((index, element) => {
                // Show items with the class of the value of the checkbox
                $("." + $(element).val() + "." + colorClass).fadeIn();
                });
              });
          }     
        });
    
        
        
    $(".sortin").click(function(){	
        var options = {
      valueNames: [ 'name', 'title', 'cena' ]
    };
    
    var userList = new List('contenthotels', options);
    });
    });