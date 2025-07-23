<?php
include('connect.php');

?>

<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   
  
  <script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
  <script id="MathJax-script" async
          src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js">
  </script>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
   <title>Small groups by order 61 to 120</title>
   

   
   
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="nav-link" href=""></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      
      <li class="nav-item">
        <a class="nav-link text-white" href="StartPage_(Bootstrap).html">About</a>
      </li>

      <li class="nav-item">
        <a class="nav-link text-white" href="Small_groups_by_order_(Bootstrap).html">Small groups by order</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="Simple_groups_and_related_groups_(Bootstrap).html">Simple groups and related groups</a>
      </li>

      
      
    </ul><!--
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>-->
  </div>
</nav>
<div class="container-fluid">
    <div class="bg-secondary text-white py-5 text-left" style="border-style: double;">
       
        <h1>Small groups by order</h1>
   </div>
   <div class="row">
      <div class="table-responsive col-md-12 order-md-1">
    <table class="table table-condensed table-bordered table-striped table-hover">
      <tr>
            <th>Order</th>
            <th>Id</th>
            <th>Structure decription</th>
            <th>Group Name</th>
            <th>Characteristic</th>
         </tr>


<?php
/*$arr=array("userName"=>"Nirali Mistry","firstName"=>"Nirali");
print_r($arr);
echo $arr['userName'];
echo $arr['firstName'];*/

$sel_all_groups="select * from all_groups_in_one";
$sel_all_groups_exe=$con->query($sel_all_groups) or mysqli_error('Error');
while($fetch_data=$sel_all_groups_exe->fetch_assoc())
{
   
    
    

?>
 <tr>
    <td><?php echo $fetch_data['group_order']?></td>
    <td>[<?php echo $fetch_data['id_whole']?>]</td>
    <td><?php echo $fetch_data['label']?></td>
    <td><?php echo $fetch_data['group_name']?></td>

    <td><?php 

    	$g_order=$fetch_data['group_order'];
		$i = 1;
		$isFirst=1;
		while($i <= $g_order){
			$count = 0;
			if($g_order % $i == 0){
				$j = 1;
        		while($j <= $i){
            		if($i % $j == 0){
                		$count = $count + 1;
            		}
            		$j = $j + 1;
           		}
        		if($count == 2){

        			if($isFirst==1){
        				$isFirst=0;
        				$path1= join('_',array('SmallGroup',$fetch_data['group_order'], $fetch_data['id_only'],'for', 'the', 'prime', $i ));
                  		$path2=join('/', array('TSCT_computer_generated_pdfs', $fetch_data['group_order'], $path1  ));
                  		$path=join('.', array($path2, 'pdf'));?>
                 		 <a <?php echo 'href="'.$path.'"';?> download><?php echo $i ?></a>



        			<?php } else{
        				$path1= join('_',array('SmallGroup',$fetch_data['group_order'], $fetch_data['id_only'],'for', 'the', 'prime', $i ));
                 		 $path2=join('/', array('TSCT_computer_generated_pdfs', $fetch_data['group_order'], $path1  ));
                  		$path=join('.', array($path2, 'pdf'));?>
                  		<a <?php echo 'href="'.$path.'"';?> download><?php echo ','.$i ?></a>
                  		<?php
        			}
        			

        		
                  
                  
                  
        		}
        	}
         

			
        
    		$i = $i + 1;

		
	}
	
	
}
?></td>
    
   
    
 </tr>

</table>

   </div>
  
   </div>
</div>
<!-- Footer -->
<footer class="page-footer font-small bg-secondary text-white" style="border-style: double;">

  <!-- Copyright -->
  <div class="footer-copyright text-left py-3">Version 1: HTML5/CSS/Bootstrap
    
  </div>
  <!-- Copyright -->

</footer>
<!-- Footer -->
</body>
</html>
