<?php
$sql="select mem_id from  tbl_classified";
$rs=db_query($sql);
while($res=mysql_fetch_array($rs)){
$name= get_member_name($res[mem_id]);
	if($name!=""){
	 db_query("update tbl_classified SET classified_poster_name='$name' where mem_id=$res[mem_id]");
	}
}
?>
