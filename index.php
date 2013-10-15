<head>
   
<link rel="stylesheet" href="../css/fork-ribbon.css" />
<link rel="stylesheet" type="text/css" href="../css/stylescrapper.css" />

<script type="text/javascript">
var ray=
{
ajax:function(st)
    {
		this.show('load');
	},
show:function(el)
	{
		this.getID(el).style.display='';
	},
getID:function(el)
	{
		return document.getElementById(el);
	}
}
</script>

</head>

 
 <div class="github-fork-ribbon-wrapper right">
        <div class="github-fork-ribbon">
            <a href="https://github.com/shivam5992/YouScrapper">Fork me on GitHub</a>
        </div>
    </div>
<div id=contentvideo>


<div align=center>
<font size=6 face="Lucida Sans Unicode">YouScrapper</font>
</div>
<div align=center>
<font size=5 face="Lucida Sans Unicode">Search Videos From YouTube</font></div>
<br>
<div id="load" class="demo-5" style="display:none;">
<div class="pre-loader"></div>
</div>

<div align=center>
<form action="index.php" method="get" onsubmit="return ray.ajax()">
<input type=text size=50 name=st1><input type=submit value=Search>
</form></div>





<?php
include("Crawler.php");
include("dbconnection.php");
$mycrawler=new Crawler();

if(isset($_GET["st1"]))
{
$x = $_GET["st1"];

echo "<div align=center><font size=5 face='Lucida Sans Unicode'>Showing search results for <b>",$x,"</b></font></div><br><br><hr>";


$url="http://www.youtube.com/results?search_query='$x'&oq='$x'&gs_l=youtube.3..0l10.6593.9157.0.10528.7.5.0.2.2.0.252.1110.2-5.5.0...0.0...1ac.1.WqSTXTmwUJY";
$link=$mycrawler->crawlLinks($url);

$sql="select * from crawl where result LIKE '%".$x."%' ";
$result=mysql_query($sql);
$n=@mysql_num_rows($result);

if($n<=1)
{


for($i=0;$i<sizeof($link['link']);$i++)
{
$ln=$link['link'][$i];	
$res=$link['text'][$i];
$qry="insert into search(result,link) values('$res','$ln')";
$result=mysql_query($qry);
}  
$sql="select * from search where result LIKE '%".$x."%' ";
$result=mysql_query($sql);
$c=0;
while($row=mysql_fetch_row($result))
{

if (stripos($row[0], "v=") !== false)
 {
$y=explode("v=",$row[0]);
$str1 =$y[1];
$y=explode("&",$str1);
$z =$y[0];
?>
<div style="float:left;width:450px;height:275;padding:2px;margin-left:35px;margin-bottom:25px;margin-top:20px">
<iframe width="420px" height="260" 
src="http://www.youtube.com/embed/<?php echo $z; ?>?feature=player_detailpage" 
frameborder="0" allowfullscreen></iframe><br>
<font color=red size=3 face="Lucida Sans Unicode"><?php echo $row[1]; ?> </font><br>
</div> 
<?php

$r=$row[1];
$l=$row[0];
$d=0;
$qry3="insert into crawl(result,link,dis) values('$r','$l','$d')";
$result3=mysql_query($qry3);
$c++;
if($c==10)
{
break;
}
}
}
$tru="truncate search";
$result=mysql_query($tru);
}
else
{
$sql="select * from crawl where result LIKE '%".$x."%' ";
$result=mysql_query($sql);
$i=0;
$c=0;
while($row=mysql_fetch_row($result))
{

if (stripos($row[1], "v=") !== false)
 {
$y=explode("v=",$row[1]);
$str1 =$y[1];
$y=explode("&",$str1);
$z =$y[0];
?>
<div style="float:left;width:450px;height:275;padding:2px;margin-left:35px;margin-bottom:25px;margin-top:20px">
<iframe width="420px" height="260" 
src="http://www.youtube.com/embed/<?php echo $z; ?>?feature=player_detailpage" 
frameborder="0" allowfullscreen></iframe><br>
<font color=red size=3 face="Lucida Sans Unicode"><?php echo $row[0]; ?> </font><br>
</div> 
<?php
$c++;
if($c==10)
{
break;
}
}
}
}
$tru="truncate search";
$result=mysql_query($tru);
$tru="truncate crawl";
$result=mysql_query($tru);
}
?><br><br><br><br><br>
<h4 align=center>BUG: Works well only for single word Query !!</h4>
<hr>
<h3 align=center> Copyright ShivamBansal.com </h3>
</div><br><br>


