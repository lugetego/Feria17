
var $sport = $("#registro_instituciones");

$(document).ready(function(){



    $sport.change(function(){

        var $form = $(this).closest('form');
        // Simulate form data, but only include the selected sport value.
        var data = {};
        data[$sport.attr("name")] = $sport.val();
        // Submit data via AJAX to the form's action path.

        $('#registro_institucion').attr('readonly', true);

        if ($sport.val()=='Otro') {
            $.ajax({
                url: $form.attr('action'),
                type: $form.attr('method'),
                data: data,
                success: function (html) {


                    $("#registro_institucion").replaceWith(
                        // ... with the returned one from the AJAX response.
                       $(html).find("#registro_institucion")

                                           //$("select:first").replaceWith("Hello world!"
                    );

                    $('#registro_institucion').attr('readonly', false);

                    // Position field now displays the appropriate positions.

                }
            });
        }

    });

});