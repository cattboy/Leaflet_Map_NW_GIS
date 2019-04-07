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
		"resource_crystal",
		"resource_lodestone",
		"resource_iron_ore_vein",
		"resource_seeping_stone",
		"resource_silver_ore_vein",
		"resource_gold_ore_vein",
		"resource_starmetal_ore_vein",
		"resource_orichalcum_ore_vein",
		"resource_platinum_vein",
		"resource_earthcrag",
		"resource_scorchstone",
		"resource_shockspire",
		"resource_springstone",
		"resource_lifejewel",
		"resource_blightcrag",
		"resource_soulspire"
		];


		var myStringArray_resource_lumberjacking = 
		[
		"resource_wyrdwood",
		"resource_ironwood"
		];


		var myStringArray_resource_sickle = 
		[
		"resource_vegetables",
		"resource_fruits",
		"resource_grains",
		"resource_hemp",
		"resource_air_spirit",
		"resource_death_spirit",
		"resource_earth_spirit",
		"resource_fire_spirit",
		"resource_life_spirit",
		"resource_soul_spirit",
		"resource_water_spirit",
		"resource_flame_azalea",
		"resource_morning_glory",
		"resource_aster",
		"resource_mushroom",
		"resource_toadstool",
		"resource_mandrake",
		"resource_lotus",
		"resource_herbs",
		"resource_earthspine",
		"resource_dragonglory",
		"resource_shockbulb",
		"resource_rivercress",
		"resource_lifebloom",
		"resource_blightroot",
		"resource_soulsprout"
		];


		var myStringArray_resource_poi = 
		[
		"poi_abandon_alchemy_house",
		"poi_abandon_fishing_village"
		];

		var myStringArray_resource_monster = 
		[
		"resource_wolf",
		"resource_bear"
		];

		var myStringArray_resource_hands = 
		[
		"resource_berry_bush",
		"resource_saltpeter",
		"resource_honey",
		"resource_nuts",
		"resource_earthshell_turtle",
		"resource_salamander_snail",
		"resource_lightning_beetle",
		"resource_floating_spinefish",
		"resource_lifemoth",
		"resource_blightmoth",
		"resource_soulwyrm",
		"resource_ironchest",
		"resource_lootbasket",
		"resource_container",
		"resource_ancient_chest",
		"resource_farming_supplies",
		"resource_blacksmith_supplies",
		"resource_alchemy_supplies",
		"resource_outfitting_supplies",
		"resource_engineering_supplies",
		"resource_provisioning_supplies",
		"resource_tanning_supplies",
		"resource_weaving_supplies",
		"resource_smelting_supplies",
		"resource_carpentry_supplies",
		"resource_abandoned_supplies",
		"resource_turkey_nest"
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
		    		alert("myStringArray_node_resource[i] = " + myStringArray_node_resource[i]);
		    		var selectDocID2 = document.getElementById(myStringArray_node_resource[i]);
			        var selectedValueinSubDropdown = selectDocID2.options[selectDocID2.selectedIndex].value;
			        alert("selectedValueinSubDropdown = " + selectedValueinSubDropdown);
			 
			        var subarr = eval("myStringArray_" + myStringArray_node_resource[i]);
			        alert("subarr  = " + subarr);

			        var arrayLength2 = subarr.length;
			        alert("arrayLength2 = " + arrayLength2);
			
			        

					for (var ii = 0; ii < arrayLength2; ii++) 
					{
						
					if (selectedValueinSubDropdown == subarr[ii])
						{
							alert("subarr[ii] = " + subarr[ii] + "  & myStringArray_node_resource = " + myStringArray_node_resource[i] );

							//add code here for inserting into database
							ii = arrayLength2;
							i = arrayLength;
						}
					}
			       
		        }

		   	}

		}
	}
});
