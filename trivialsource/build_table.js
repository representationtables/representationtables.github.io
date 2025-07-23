function prime_factors(n) {
			factors= new Array()
  			if(n==1){
  				factors.push(1)

  			}

  			else{
  				x = 2
   			

    			while(x <= n ** 0.5){
    				x=parseInt(x)
        			if(n % x == 0){
            			n /= x
            	
            			if(factors.includes(x)==false){
                			factors.push((x))
                		}
               	 }
            	
        			else{
            			x += 1
        			}
            	}
    			if(factors.includes(parseInt(n))==false){
        			factors.push(parseInt(n))
    			}
    		}
    		return factors

		}

var groups_table=new Array()
for(let i=1;i<=60;i++){
	groups_table.push([i, prime_factors(i)])
}

function add_table_rows() {
  var table = document.getElementById("myTable");

  for(let i=1;i<=60;i++){
	var row = table.insertRow(i);
	var cell1 = row.insertCell(0);
  	var cell2 = row.insertCell(1);
  	var cell3 = row.insertCell(2);
  	var cell4 = row.insertCell(3);
  	cell1.innerHTML = i;
  	cell2.innerHTML = "C"+i.toString(10).sub();
  	cell3.innerHTML = "Acyclic group";
  	cell4.innerHTML = groups_table[i-1][1];

}
 
  
}

add_table_rows()
