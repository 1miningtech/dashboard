function plusMinus()
{	
	i = i+1;
	
	if(isEven(i))
	{
		ghs1_av = ghs1_av*1;
		ghs2_av = ghs2_av*1;
		ghs3_av = ghs3_av*1;
		ghs4_av = ghs4_av*1;		

		ghs1_5s = ghs1_5s*0.99789;
		ghs2_5s = ghs2_5s*0.99789;
		ghs3_5s = ghs3_5s*0.99789;
		ghs4_5s = ghs4_5s*0.99789;		
	}
	else
	{
		ghs1_av = ghs1_av*1;
		ghs2_av = ghs2_av*1;
		ghs3_av = ghs3_av*1;
		ghs4_av = ghs4_av*1;

		ghs1_5s = ghs1_5s*1.00321;
		ghs2_5s = ghs2_5s*1.00321;
		ghs3_5s = ghs3_5s*1.00321;
		ghs4_5s = ghs4_5s*1.00321;
	}
	
	ghs1_av = parseFloat(ghs1_av);
	ghs2_av = parseFloat(ghs2_av);
	ghs3_av = parseFloat(ghs3_av);
	ghs4_av = parseFloat(ghs4_av);

	ghs1_5s = parseFloat(ghs1_5s);
	ghs2_5s = parseFloat(ghs2_5s);
	ghs3_5s = parseFloat(ghs3_5s);
	ghs4_5s = parseFloat(ghs4_5s);

	gauge1.setValue(ghs1_5s.toFixed(1));
	gauge2.setValue(ghs2_5s.toFixed(1));
	gauge3.setValue(ghs3_5s.toFixed(1));
	gauge4.setValue(ghs4_5s.toFixed(1));
	
	$("#am1_ghs_av").html(ghs1_av.toFixed(2));
	$("#am2_ghs_av").html(ghs2_av.toFixed(2));
	$("#am3_ghs_av").html(ghs3_av.toFixed(2));
	$("#am4_ghs_av").html(ghs4_av.toFixed(2));

	ghs_total_av = ghs1_av + ghs2_av + ghs3_av + ghs4_av;
	ghs_total_5s = (ghs1_5s + ghs2_5s + ghs3_5s + ghs4_5s)*1.02;

	$("#ghs_total").html(ghs_total_av.toFixed(2));
	$("#ghs_total_big").html(ghs_total_5s.toFixed(0) + ' GH/s');
}

function isEven(n) 
{
  return n == parseFloat(n)? !(n%2) : void 0;
}