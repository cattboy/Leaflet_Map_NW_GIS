$(document).ready(function() 
{
    $('#node_resource').bind('change', 
    	function() 
    	{
	        var elements = $('div.container_node_resource').children().hide(); // hide all the elements
	        var value = $(this).val();

	        if (value.length) 
	        	{ // if somethings' selected
	        
	            elements.filter('.' + value).show(); // show the ones we want

        		}
    	}).trigger('change');

});



// $(document).ready(function() 
// {
// 	$('#node_resource').bind('change', 
// 	function() 
// 	{
// 		var elements = $('div.container_node_resource').children().hide(); // hide all the elements
// 		var value = $(this).val();
// 		alert(value);
// 		var dropdownType = document.getElementById('node_resource');
//     	if(dropdownType.selectedIndex == "mining_pick")
//     	{
//     	    alert(dropdownType.selectedIndex );
//     	} 
//     	else if(dropdownType.selectedIndex == "lumberjacking_axe") 
//     	{
//     		alert(dropdownType.selectedIndex );
// 		}
// 	}).trigger('change');
// });