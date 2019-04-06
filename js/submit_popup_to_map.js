$(document).ready(function() 
{
	document.querySelector("#node_submission_form2").addEventListener("submit", function(e){
	    if(!doValidation()){
	        e.preventDefault();    //stop form from submitting
	        alert(selectedValue);
	        //add database submissions here
	        


	        
	    }
	});

	function doValidation() //Make sure they selected a Harvesting type, and return the one theey selected
	{
	 var ddl = document.getElementById("node_resource");
	 var selectedValue = ddl.options[ddl.selectedIndex].value;
	    if (selectedValue == "disabled")
	    {
	    	alert("Please Select Harvesting Type!");
	    	exit();
	    }
	    else if(selectedValue == "mining_pick") // maybe change to arr.indexOf(selectedValue) (will check my array called ARR for a
	    {

	    	alert(selectedValue);
	        var dd2 = document.getElementById("mining_pick");
	        var selectedValue2 = dd2.options[dd2.selectedIndex].value
	        alert(selectedValue2);

	    }
	   	else if(selectedValue == "lumberjacking_axe")
	    {

	    	alert(selectedValue);
	        var dd2 = document.getElementById("lumberjacking_axe");
	        var selectedValue2 = dd2.options[dd2.selectedIndex].value
	        alert(selectedValue2);

	    }
	    else if(selectedValue == "sickle_")
	    {

	    	alert(selectedValue);
	        var dd2 = document.getElementById("sickle_");
	        var selectedValue2 = dd2.options[dd2.selectedIndex].value
	        alert(selectedValue2);

	    }
	    else if(selectedValue == "skinning_knife")
	    {

	    	alert(selectedValue);
	        var dd2 = document.getElementById("skinning_knife");
	        var selectedValue2 = dd2.options[dd2.selectedIndex].value
	        alert(selectedValue2);

	    }
	    else if(selectedValue == "hands_")
	    {

	    	alert(selectedValue);
	        var dd2 = document.getElementById("hands_");
	        var selectedValue2 = dd2.options[dd2.selectedIndex].value
	        alert(selectedValue2);

	    }



	};
	
	function doCheck()
	{
	 var ddl = document.getElementById("node_resource");
	 var selectedValue = ddl.options[ddl.selectedIndex].value;
	    if (selectedValue == "disabled")
	    {
	    	alert("Please Select Harvesting Type!");
	    }
	};
});