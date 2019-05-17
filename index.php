<html>
   <TITLE>Mission China Rolodex</TITLE>
   <link rel="stylesheet" type="text/css" href="include/style.css">
   <script src="include/3.3.1/jquery.min.js"></script>
   <script src="include/jquery.min.js"></script>
   <script src="include/jquery.modal.min.js"></script>
   <link rel="stylesheet" href="include/jquery.modal.min.css" />
   <?php require("config.php"); ?>
   <img src="Seal_of_the_United_States_Department_of_State.svg" class="logo" alt="logo" width="150" height="150" align="right">
   <h1> Mission China Digital Rolodex </h1>
   <body>
      <div align="right">
         <div class="navbar">
            <select name="post" id="post">
               <option value="" selected="selected">Post</option>
	       <option value="">---------</option>
               <?php
                  $post = odbc_exec($connection, "SELECT [postName]
                        FROM [BDR].[dbo].[postID]");
                  while ($row = odbc_fetch_row($post)) {
                  $name = odbc_result($post, "postName");
                  echo '<option value="' . trim($name) . '">' . trim($name) . "</option>";                 
                  }
                  ?>
            </select>
            <select name="lastname" id="lastname">
               <option value="" selected="selected">Last Name Starts With</option>
	       <option value="">---------</option>
               <?php
                  foreach (range('A', 'Z') as $char){
                  echo '<option value="' . $char . '">' . $char . "</option>";
                  }
                  ?>
            </select>
            <select name="department" id="department">
               <option value="" selected="selected">Agency</option>
	       <option value="">---------</option>
               <?php
                  $department = odbc_exec($connection, "SELECT DISTINCT 
                  (LEFT(OL.[Organization], 
                  CASE 
                  WHEN CHARINDEX('-', OL.[Organization]) = 0 THEN LEN(OL.[Organization]) 
                  ELSE CHARINDEX('-', OL.[Organization]) - 1 END
                  )) as Organization
                  FROM [BDR].[dbo].[vw_OrgList] OL
                  JOIN [BDR].[dbo].[tblEmployees] E on E.organization = OL.ID
                  WHERE OL.[Organization] IS NOT NULL
                  AND E.active = 1
                  ");
                  while ($row = odbc_fetch_row($department)) {
                  $dep = odbc_result($department, "Organization");
                  echo '<option value="' . trim($dep) . '">' . trim($dep) . "</option>";                 
                  }
                  ?>
            </select>
            <select name="office" id="office">
               <option value="" selected="selected">Section/Office</option>
	       <option value="">---------</option>
               <?php
                  $office = odbc_exec($connection, "SELECT DISTINCT 
                  (LEFT([Section/Office], 
                  CASE 
                  WHEN CHARINDEX('- ', [Section/Office]) = 0 THEN LEN([Section/Office]) 
                  ELSE CHARINDEX('- ', [Section/Office]) - 1 END
                  )) as Office
                  FROM [BDR].[dbo].[vw_OrgList] OL
                  JOIN [BDR].[dbo].[tblEmployees] E on E.organization = Ol.ID
                  WHERE OL.[Section/Office] is not null
                  AND E.active = 1
                  ");
                  while ($row = odbc_fetch_row($office)) {
                  $sec = odbc_result($office, "Office");
                  echo '<option value="' . trim($sec) . '">' . trim($sec) . "</option>";                  
                  }
                  ?>
            </select>
            <div align="left">
                 <input class="searchtext" type="text" id="search-box" placeholder="Search here..." />
             </div>
         </div>
      </div>
      <script>
         $(document).ready(function(){
             	$("#search-box").keyup(function(){
             		$.ajax({
             		type: "POST",
             		url: "readNames.php",
             		data:'keyword='+document.getElementById("search-box").value+'&office=' + document.getElementById("office").options[document.getElementById("office").selectedIndex].value+'&department=' + document.getElementById("department").options[document.getElementById("department").selectedIndex].value+'&lastname=' + document.getElementById("lastname").options[document.getElementById("lastname").selectedIndex].value+'&post=' + document.getElementById("post").options[document.getElementById("post").selectedIndex].value,
             
             		success: function(data){
             			$("#display").show();
             			$("#display").html(data);
             			$("#search-box").css("background","#FFF");
             		}
             		});
             	});
             	$("#department").change(function(){
             		$.ajax({
             		type: "POST",
             		url: "readNames.php",
             		data:'keyword='+document.getElementById("search-box").value+'&office=' + document.getElementById("office").options[document.getElementById("office").selectedIndex].value+'&department=' + document.getElementById("department").options[document.getElementById("department").selectedIndex].value+'&lastname=' + document.getElementById("lastname").options[document.getElementById("lastname").selectedIndex].value+'&post=' + document.getElementById("post").options[document.getElementById("post").selectedIndex].value,
             
             		success: function(data){
             			$("#display").show();
             			$("#display").html(data);
             			$("#search-box").css("background","#FFF");
             		}
             		});
             	});
             	$("#office").change(function(){
             		$.ajax({
             		type: "POST",
             		url: "readNames.php",
             		data:'keyword='+document.getElementById("search-box").value+'&office=' + document.getElementById("office").options[document.getElementById("office").selectedIndex].value+'&department=' + document.getElementById("department").options[document.getElementById("department").selectedIndex].value+'&lastname=' + document.getElementById("lastname").options[document.getElementById("lastname").selectedIndex].value+'&post=' + document.getElementById("post").options[document.getElementById("post").selectedIndex].value,
             
             		success: function(data){
             			$("#display").show();
             			$("#display").html(data);
             			$("#search-box").css("background","#FFF");
             		}
             		});
             	});
             	$("#lastname").change(function(){
             		$.ajax({
             		type: "POST",
             		url: "readNames.php",
             		data:'keyword='+document.getElementById("search-box").value+'&office=' + document.getElementById("office").options[document.getElementById("office").selectedIndex].value+'&department=' + document.getElementById("department").options[document.getElementById("department").selectedIndex].value+'&lastname=' + document.getElementById("lastname").options[document.getElementById("lastname").selectedIndex].value+'&post=' + document.getElementById("post").options[document.getElementById("post").selectedIndex].value,
             
             		success: function(data){
             			$("#display").show();
             			$("#display").html(data);
             			$("#search-box").css("background","#FFF");
             		}
             		});
             	});
	         $("#post").change(function(){
             		$.ajax({
             		type: "POST",
             		url: "readNames.php",
             		data:'keyword='+document.getElementById("search-box").value+'&office=' + document.getElementById("office").options[document.getElementById("office").selectedIndex].value+'&department=' + document.getElementById("department").options[document.getElementById("department").selectedIndex].value+'&lastname=' + document.getElementById("lastname").options[document.getElementById("lastname").selectedIndex].value+'&post=' + document.getElementById("post").options[document.getElementById("post").selectedIndex].value,
             
             		success: function(data){
             			$("#display").show();
             			$("#display").html(data);
             			$("#search-box").css("background","#FFF");
             		}
             		});

             	});
		if ($(window).width() > 1024) {
	
             		$.ajax({
             		type: "POST",
             		url: "readNames.php",
             		data:'keyword='+document.getElementById("search-box").value+'&office=' + document.getElementById("office").options[document.getElementById("office").selectedIndex].value+'&department=' + document.getElementById("department").options[document.getElementById("department").selectedIndex].value+'&lastname=' + document.getElementById("lastname").options[document.getElementById("lastname").selectedIndex].value+'&post=' + document.getElementById("post").options[document.getElementById("post").selectedIndex].value,
             
             		success: function(data){
             			$("#display").show();
             			$("#display").html(data);
             			$("#search-box").css("background","#FFF");
             		}
             		});

		}
             });
      </script>
      <div id="display"></div>
      <div id="content"></div>
      <p id="demo"></p>
   </body>
</html>