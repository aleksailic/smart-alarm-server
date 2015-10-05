$(document).ready(function() {
	var preloader={
		id:$('.preloader-wrapper'),
		start:function(){
			preloader.id.addClass('active');
		},
		stop:function(){
			preloader.id.removeClass('active');
		}
	};
	(function(){
		preloader.start();
		//AJAX call
		$.ajax({
		    method: "POST",
		    url: "user_control.php",
		    data: {
		       action: 'getBoards'
		    }
		}).done(function(msg) {
			var html="";
		    if (msg.status) {
		    	if(msg.boards.length==0)
		    		Materialize.toast("Klikom na plus dodajte vas prvi SmartAlarm",3000);
		    	for(var i=0;i<msg.boards.length;i++){
		    		var board = msg.boards[i];
		    		console.log(board);
		    		html+=getHTML(board);
		    	}
		    	$('#pane .collection').hide(function(){
		    		$(this).html(html).slideDown(function(){
		    			preloader.stop();
		    			$('#pane .item').click(function() {
		    			    $(this).next().slideToggle();
		    			});
		    			$(".status_btn").click(toggleStatus);
		    			$(".delete_btn").click(deleteBoard);
		    			$(".log_btn").click(updateLog);

		    		});
		    	});
		    } else {
		       Materialize.toastArray(msg.errors);
		    }
		});
	})();
	
    $('.modal-trigger').leanModal();
    $('.dropdown-button').dropdown({
        inDuration: 300,
        outDuration: 225,
        constrain_width: true, // Changes width of dropdown to that of the activator
        hover: false, // Activate on hover
        gutter: 0, // Spacing from edge
        belowOrigin: false // Displays dropdown below the button
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
            if (msg.status) {
                Materialize.toast("Board successfully added.", 3000);
                Materialize.toast("Please refresh the page.", 3000);
            } else {
                Materialize.toastArray(msg.errors);
            }

            $('.preloader-wrapper').removeClass('active');
        });
    });
});
function deleteBoard(){
	var serial = $(this).data('serial');
	var that = this;
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
	       Materialize.toastArray(msg.errors);
	    }
	});
}
function toggleStatus(){
	var serial = $(this).data('serial');
	var $that = $(this);
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
	        (function($that){
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
	        })($that);
	    } else {
	       Materialize.toastArray(msg.errors);
	    }
	});
}
function updateLog(serial){
	var serial = $(this).data('serial');
	var $that = $(this);
	$.ajax({
	    method: "GET",
	    url: "board_control.php",
	    data: {
	       serial: serial,
	       action: 'getLog'
	    }
	}).done(function(msg) {
	    if (msg.status) {
	        Materialize.toast("Successfully refreshed", 3000);
	        console.log(msg.logs);
	        var html="";
	        for(var i=0;i<msg.logs.length;i++){
	        	html +='<p><span class="timestamp">';
	        	html += msg.logs[i].timestamp;
	        	html += '</span><span class="message">';
	        	html += msg.logs[i].message;
	        	html += '</span></p>';
	        }
	        console.log(html);
	        $that.next().next().html(html);

	    } else {
	        Materialize.toastArray(msg.errors);
	    }
	});
}
function getHTML(board){
	var html="";
	html += '<li class="item waves-effect collection-item avatar">';
	html += '<img src="img/avatar.png" alt="" class="circle">';
	html += '<span class="title">' + board.name + '</span>';
	html += '<p>' + board.location + '<br>' + board.serial + '</p>';
	html += '<a href="#!" class="secondary-content">';
	if(board.status){
		html += '<div class="status green"></div>'; 
	}else{
		html += '<div class="status red"></div>';
	}
	html += '</a></li>';
	html += '<li class="collection-item settings">';
	if(board.status){
	   html += '<button data-serial="' + board.serial + '" class="status_btn waves-effect waves-light btn red">Stop</button> '; 
	}else{
	   html += '<button data-serial="' + board.serial + '" class="status_btn waves-effect waves-light btn green">Start</button> ';
	}
	html += '<button data-serial="' + board.serial + '" class="waves-effect waves-light btn indigo">Calibrate</button> ';
	html += '<button data-serial="' + board.serial + '" class="log_btn waves-effect waves-light btn indigo">Refresh Log</button> ';
	html += '<button data-serial="' + board.serial + '" class="delete_btn waves-effect waves-light btn red">Delete</button>';
	html += '<div class="log">';
		//html += '<p><span class="timestamp">2015-09-30 20:31:25</span><span class="message">Successfully started</span></p>';
	html += '</div></li>';
	return html;
}

Materialize.toastArray=function(arr){
	for(var i=0;i<arr.length;i++){
		Materialize.toast(arr[i].code+": "+arr[i].message,5000);
	}
}