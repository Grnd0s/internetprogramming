<?php 
include 'config/db.php';
$conn = getDatabaseConnection("finalproject");

function displayCategories()
{
    global $conn;
    $sql= "SELECT catId, catName FROM categories";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($records as $record) 
    {
        echo "<option value='".$record["catId"]."' >" . $record["catName"] . "</option>";
    }
}
include('partials/functions.php');
include('partials/header.php');?>
    <body>
        <?php include('partials/nav.php');?>
        
       <!-- Search Form -->
            <?php include('partials/searchForm.php'); ?>
            
            <!-- Display Search Results -->
            <?php //displaySearchResults(); ?>
            <div id="result"></div>
            
        <script type="text/javascript">
            function search(title, category, author, nameD, nameA, date)
            {
                $.ajax(
                {
                    type: "POST",
                    url: "API/getContentAPI.php",
                    dataType: "json",
                    data: { "contentTitle":$("#contentTitle").val(), "category":$("#category").val(), "author":author, "nameD":nameD,"nameA":nameA,"date":date},
                    success: function(data,status) 
                    {
                        
                        $("#result").empty();
                        var html = "<table class='table'>";
                        html += "<thead> <tr> <th>Title</th> <th>Author</th> <th>Date</th> <th>Link</th></tr> </thead>";
                        for(var i = 0; i < data.length; i++)
                        {
                            html += "<tr>";
                            html += "<td>" + data[i].contentTitle + "</td><td>" + data[i].contentAuthor + "</td><td>" + data[i].contentDate + "</td>";
                            html += "<td><a href=content.php?id=" + parseInt(data[i].contentId) + "><button class='btn btn-success'>Access</button></a></td>";
                            html += "</tr>";
                        }
                        html += "</table>";
                        $("#result").html(html);
                        //console.log("update");
                    },
                    complete: function(data,status) 
                    { //optional, used for debugging purposes
                    
                    }
                });//ajax
            }
            $(document).ready(function()
            {
                search(0,0,0,0,0,0);
                $("#contentTitle").change(function(){search(1,0,0,0,0,0);});
                $("#author").change(function(){search(0,1,0,0,0,0);});
                $("#date").change(function(){search(0,0,1,0,0,0);});
                $("#nameD").change(function(){search(0,0,0,1,0,0);});
                $("#nameA").change(function(){search(0,0,0,0,1,0);});
                $("#category").change(function(){search(0,0,0,0,0,1);});    
            });
                
        </script>
    <?php include('partials/footer.php');?>
 