$(document).ready(function() 
{
	document.querySelector("#node_submission_form2").addEventListener("submit", function(e){
	    if(!doValidation()){
	        e.preventDefault();    //stop form from submitting
	        //alert(selectedValue);
	        //add database submissions here
	        


	        
	    }
	});

 	



	function doValidation() //Make sure they selected a Harvesting type, and return the one theey selected
	{
		//Need to make global
		var myStringArray_node_resource = 
		[
		"resource_mining",
		"resource_lumberjacking",
		"resource_sickle",
		"resource_monster",
		"resource_hands",
		"resource_poi"
		];

		var myStringArray_resource_mining = 
		[
		"resource_iron_ore",
		"resource_gold_ore",
		"resource_silver_ore"
		];
		var myStringArray_resource_lumberjacking = 
		[
		"resource_wyrdwood",
		"resource_ironwood"
		];
		//Need one for sickle
		//One for poi, for each type
		//^^^^^^^^^^^

		var selectDocID = document.getElementById("node_resource");
		var selectedValueinDropdown = selectDocID.options[selectDocID.selectedIndex].value;
	
	    var arrayLength = myStringArray_node_resource.length;
		if (selectedValueinDropdown == "disabled")
		{
			alert("Please Select Harvesting Type!");
			exit();
		}
		else
		{

		    for (var i = 0; i < arrayLength; i++) 
		    {	

		    	if (selectedValueinDropdown == myStringArray_node_resource[i])
		    	{	

		    		var selectDocID2 = document.getElementById(myStringArray_node_resource[i]);
			        var selectedValueinSubDropdown = selectDocID2.options[selectDocID2.selectedIndex].value;

			 
			        var subarr = eval("myStringArray_" + myStringArray_node_resource[i]);
			        var arrayLength2 = subarr.length;

			        

					for (var ii = 0; ii < arrayLength2; ii++) 
					{
						
					if (selectedValueinSubDropdown == subarr[ii])
						{
							alert("subarr[ii] = " + subarr[ii] + "  & myStringArray_node_resource = " + myStringArray_node_resource[i] );
							ii = arrayLength2;
							i = arrayLength;
						}
					}
			       
		        }

		   	}

		}
	}
});
