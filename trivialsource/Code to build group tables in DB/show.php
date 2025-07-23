<?php
include('connect.php');

?>
<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>MathJax example</title>
  <script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
  <script id="MathJax-script" async
          src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js">
  </script>
   <title></title>
   

   <style type="text/css">
      #header{
         background-color: lightcyan;
         border: double;
         color: black;
      }
      #main{
         padding: auto;
         width: 80%;
      }
      table {
       font-family: "Computer Modern";
    src: url('http://mirrors.ctan.org/fonts/cm-unicode/fonts/otf/cmunss.otf');
      border-collapse: collapse;
      width: 85%;
      }
      a{
        color: black;
      }
      td, th {
      border: 1px solid #dddddd;
      text-align: left;
      padding: 8px;
      width: auto;
      }

      #navigation {
         position:absolute; 
         top:100pt; 
         bottom: 100pt;
         right:5pt;
         width:15%;
         background-color:lightcyan;
         color: black;
         /*border:1px dashed #000000; */
            border: double;
         line-height:17px;
   }
   #footer{
         position: relative;
         background-color: lightcyan;
         border: double;
         color: black;
         bottom: 0;
         width: 100%;
      }
   </style>
   
</head>

<body>
   <div id="header">
      <h1>Small groups by order</h1>
   </div>
   <div id="main">   
      <table id="myTable">
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

$sel_all_groups="select * from all_groups";
$sel_all_groups_exe=$con->query($sel_all_groups) or mysqli_error();
while($fetch_data=$sel_all_groups_exe->fetch_assoc())
{
   //print_r($fetch_data);
   $characteristic_str=$fetch_data['characteristic'];
   $arr = json_decode($characteristic_str);


?>
 <tr>
    <td><?php echo $fetch_data['group_order']?></td>
    <td><?php echo $fetch_data['group_id']?></td>

    <?php 
    $final_struc="";
    $arr_splits=explode(' ', $fetch_data['structure_description']);
      
      foreach ($arr_splits as $key1 => $value1) {
                 switch ($value1) {
                    case '1':
                       $final_struc.= $value1. "&nbsp";
                       break;
                    case 'x':
                       $final_struc.= $value1. "&nbsp";
                       break;
                    case ':':
                        $final_struc.= $value1."&nbsp";
                        # $final_struc.="<p>\(\rtimes)</p>";
                        break;
                    case 'QD16':
                        $letter=substr($value1, 0,2); 
                        $number=substr($value1, 2);
                        $temp_str="$letter<sub>$number</sub>&nbsp" ;
                        $final_struc.= $temp_str;
                        break; 
                        
                    case 'QD32':
                        $letter=substr($value1, 0,2); 
                        $number=substr($value1, 2);
                        $temp_str="$letter<sub>$number</sub>&nbsp" ;
                        $final_struc.= $temp_str;
                        break; 
                    case 'SL(2,3)':
                        $final_struc.= $value1."&nbsp";
                        break;
                    case '.':
                        $final_struc.= $value1."&nbsp";
                        break;    

                    
                    default: 

                     if(str_starts_with($value1, "((")){
                        $final_struc.= "((";
                        $value1 = substr($value1, 2); 
                        $letter=substr($value1, 0,1); 
                        $number=substr($value1, 1);
                        $temp_str="$letter<sub>$number</sub>&nbsp" ;
                        $final_struc.= $temp_str;
                        break; 

                     }
                     elseif(str_starts_with($value1, "(")){
                        $final_struc.= "(";
                        $value1 = substr($value1, 1); 
                        $letter=substr($value1, 0,1); 
                        $number=substr($value1, 1);
                        $temp_str="$letter<sub>$number</sub> &nbsp" ;
                        $final_struc.= $temp_str;
                        break; 

                     }
                     elseif(str_ends_with($value1, ")")){
                        
                        $value1 = substr($value1, 0,2); 
                        $letter=substr($value1, 0,1); 
                        $number=substr($value1, 1);
                        $temp_str="$letter<sub>$number</sub>" ;
                        $final_struc.= $temp_str;
                        $final_struc.= ")";
                        break; 

                     }
                     else{

                        $letter=substr($value1, 0,1); 
                        $number=substr($value1, 1);
                        $temp_str="$letter<sub>$number</sub>&nbsp" ;
                        $final_struc.= $temp_str;
                        break; 
                     }
                    
                  } 
               


       
    }?>

   
    <td><?php echo $final_struc?></td>
    <?php str_replace($final_struc, "", $final_struc)?>
    <td><?php echo $fetch_data['group_name']?></td>
    <td><?php
         $id=$fetch_data['group_id'];
         
         if (intval($fetch_data['group_order'])<10) {
            $id=$id[5];
         }else{
            $id=substr($id, 6, 2);
            $id=intval($id);
         }
        foreach ($arr as $key => $value) {
                  #$key_new=$key+1;
                  #echo $id;
                  $path1= join('_',array('SmallGroup',$fetch_data['group_order'], $id,'for', 'the', 'prime', $value ));
                  $path2=join('/', array('TSCT_computer_generated_pdfs', $fetch_data['group_order'], $path1  ));
                  $path=join('.', array($path2, 'pdf'));
                  #$path= join('TSCT_computer_generated_pdfs/',$fetch_data['group_order'],'/SmallGroup_',$fetch_data['group_order'],'_',$key,'_for_the_prime_',$value,".pdf")



                 #echo "<a href=''>$value</a>";
                  ?>
                  <a <?php echo 'href="'.$path.'"';?> download><?php echo $value ?></a>
                  <?php
                  echo " ";
        }

        ?></td>
 </tr>
<?php
}
?>
</table>
<hr>
   </div>

   <div id="footer">
      <p>Footer</p>
      <p>\(\rtimes\)
</p>
   </div>
   <div id="navigation">
      <h2>Navigation</h2>
   </div>
</body>
</html>