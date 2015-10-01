$(document).ready(function() {
    $('.modal-trigger').leanModal();
    $('.dropdown-button').dropdown({
        inDuration: 300,
        outDuration: 225,
        constrain_width: true, // Changes width of dropdown to that of the activator
        hover: false, // Activate on hover
        gutter: 0, // Spacing from edge
        belowOrigin: false // Displays dropdown below the button
    });
    $('#pane .item').click(function() {
        $(this).next().slideToggle();
    });
    $('#addform_btn').click(function() {
        //Check if any field is empty
        var errors = 0;
        $("#addform :input").map(function() {
            if (!$(this).val()) {
                $(this).parents('td').addClass('warning');
                errors++;
            } else if ($(this).val()) {
                $(this).parents('td').removeClass('warning');
            }
        });
        if (errors > 0) {
            Materialize.toast("All fields are required",3000);
            return false;
        }

        $('.preloader-wrapper').addClass('active');
        $('#add_modal').closeModal();

        //AJAX call
        $.ajax({
            method: "POST",
            url: "user_control.php",
            data: {
            	action:'addBoard',
               name: $("#name").val(),
               serial: $("#serial").val(),
               location: $("#location").val(),
               sensitivity: $("#sensitivity").val(),
               status: $("#status").is(':checked')
            }
        }).done(function(msg) {
        	console.log(msg);
            if (msg.status) {
                Materialize.toast("Board successfully added.", 3000);
                Materialize.toast("Please refresh the page.", 3000);
            } else {
                toastArray(msg.errors);
            }

            $('.preloader-wrapper').removeClass('active');
        });
    });
    $(".status_btn").click(function() {
        var serial = $(this).data('serial');
        var $that = $(this);
        //AJAX call
        $.ajax({
            method: "GET",
            url: "board_control.php",
            data: {
               serial: serial,
               action: 'toggleStatus'
            }
        }).done(function(msg) {
            if (msg.status) {
                Materialize.toast("Status changed", 3000);
                //Change btn and status color and text
                toggleStatus($that);
            } else {
               toastArray(msg.errors);
            }
        });
    });
    $(".delete_btn").click(function() {
        var serial = $(this).data('serial');
        var that = this;
        //AJAX call
        $.ajax({
            method: "POST",
            url: "user_control.php",
            data: {
                serial: serial,
                action: 'deleteBoard'
            }
        }).done(function(msg) {
            if (msg.status) {
                Materialize.toast("Successfully deleted the board", 3000);

                $(that).parent().prev().slideUp(function() {
                    $(this).remove();
                });
                $(that).parent().slideUp(function() {
                    $(this).remove();
                });

            } else {
               toastArray(msg.errors);
            }
        });
    });
});

function toastArray(arr){
	for(var i=0;i<arr.length;i++){
		Materialize.toast(arr[i].code+": "+arr[i].message,5000);
	}
}
function toggleStatus($that) {
    var $status = $that.parent().prev().find('.status');
    if ($that.hasClass('red')) {
        $that.removeClass('red').addClass('green');
        $that.html('Start');
        $status.removeClass('green').addClass('red');
    } else {
        $that.removeClass('green').addClass('red');
        $that.html('Stop');
        $status.removeClass('red').addClass('green');
    }
}