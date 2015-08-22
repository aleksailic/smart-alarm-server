$(document).ready(function(){
  $('.modal-trigger').leanModal();
  $('.dropdown-button').dropdown({
    inDuration: 300,
    outDuration: 225,
    constrain_width: true, // Changes width of dropdown to that of the activator
    hover: false, // Activate on hover
    gutter: 0, // Spacing from edge
    belowOrigin: false // Displays dropdown below the button
  });
  $('#pane .item').click(function(){
    $(this).next().slideToggle();
  });
});