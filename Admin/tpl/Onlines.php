<?php
$active = $admin->getUserActive(); 
?>
<div align="center">
	<ul class="tabs"><center>
		<li>(<?php echo count($active);?>)Player(s) online</li>
        </center>
	</ul>
</div>
<table id="member" border="1" cellpadding="3" align="center"> 
    <tr style="height:30px;">
        <td><center>Name</center></td>
        <td><b>Time / Date</b></td>
        <td><b>Rank</b></td> 
        <td><b>Population</b></td> 
        <td><b>Village</b></td> 
        <td><b>Gold</b></td>  
        <td><b>Silver</b></td>
        <td></td>
    </tr>
<?php
	$time = time() - (60*5);
	$sql = mysql_query("SELECT * FROM ".TB_PREFIX."users where timestamp > $time and id > 3 ORDER BY username ASC $limit");
	$query = mysql_num_rows($sql);
	if (isset($_GET['page'])) { // Get page number
		$page = preg_replace('#[^0-9]#i', '', $_GET['page']); // Filter out everything, except numbers
	} else {
		$page = 1;
	}
	
	$itemsPerPage = 10; //The number of displayed items per page
	$lastPage = ceil($query / $itemsPerPage); // Get the last page
	if ($page < 1) {
		$page = 1;
	} else if ($page > $lastPage) {
		$page = $lastPage;
	}
	$centerPages = "";
	$sub1 = $page - 1;
	$sub2 = $page - 2;
	$sub3 = $page - 3;
	$add1 = $page + 1;
	$add2 = $page + 2;
	$add3 = $page + 3;
	if ($page <= 1 && $lastPage <= 1) {
		$centerPages .= '<span class="number currentPage">1</span>';
		
	}elseif ($page == 1 && $lastPage == 2) {
		$centerPages .= '<span class="number currentPage">' . $page . '</span> ';
		$centerPages .= '<a class="number" href="page=2">2</a>';
		
	}elseif ($page == 1 && $lastPage == 3) {
		$centerPages .= '<span class="number currentPage">' . $page . '</span> ';
		$centerPages .= '<a class="number" href="page=2">2</a> ';
		$centerPages .= '<a class="number" href="page=3">3</a>';
		
	}elseif ($page == 1) {
		$centerPages .= '<span class="number currentPage">' . $page . '</span> ';
		$centerPages .= '<a class="number" href="page=' . $add1 . '">' . $add1 . '</a> ';
		$centerPages .= '<a class="number" href="page=' . $add2 . '">' . $add2 . '</a> ... ';
		$centerPages .= '<a class="number" href="page=' . $lastPage . '">' . $lastPage . '</a>';
		
	} else if ($page == $lastPage && $lastPage == 2) {
		$centerPages .= '<a class="number" href="page=1">1</a> ';
		$centerPages .= '<span class="number currentPage">' . $page . '</span>';
		
	} else if ($page == $lastPage && $lastPage == 3) {
		$centerPages .= '<a class="number" href="page=1">1</a> ';
		$centerPages .= '<a class="number" href="page=2">2</a> ';
		$centerPages .= '<span class="number currentPage">' . $page . '</span>';
		
	} else if ($page == $lastPage) {
		$centerPages .= '<a class="number" href="page=1">1</a> ... ';
		$centerPages .= '<a class="number" href="page=' . $sub2 . '">' . $sub2 . '</a> ';
		$centerPages .= '<a class="number" href="page=' . $sub1 . '">' . $sub1 . '</a> ';
		$centerPages .= '<span class="number currentPage">' . $page . '</span>';
		
	} else if ($page == ($lastPage - 1) && $lastPage == 3) {
		$centerPages .= '<a class="number" href="page=1">1</a> ';
		$centerPages .= '<span class="number currentPage">' . $page . '</span> ';
		$centerPages .= '<a class="number" href="page=' . $lastPage . '">' . $lastPage . '</a>';
	
	} else if ($page > 2 && $page < ($lastPage - 1)) {
		$centerPages .= '<a class="number" href="page=1">1</a> ... ';
		$centerPages .= '<a class="number" href="page=' . $sub1 . '">' . $sub1 . '</a> ';
		$centerPages .= '<span class="number currentPage">' . $page . '</span> ';
		$centerPages .= '<a class="number" href="page=' . $add1 . '">' . $add1 . '</a> ... ';
		$centerPages .= '<a class="number" href="page=' . $lastPage . '">' . $lastPage . '</a>';
		
	}else if ($page == ($lastPage - 1)) {
		$centerPages .= '<a class="number" href="page=1">1</a> ... ';
		$centerPages .= '<a class="number" href="page=' . $sub1 . '">' . $sub1 . '</a> ';
		$centerPages .= '<span class="number currentPage">' . $page . '</span> ';
		$centerPages .= '<a class="number" href="page=' . $lastPage . '">' . $lastPage . '</a>';
	
	} else if ($page > 1 && $page < $lastPage && $lastPage == 3) {
		$centerPages .= '<a class="number" href="page=' . $sub1 . '">' . $sub1 . '</a> ';
		$centerPages .= '<span class="number currentPage">' . $page . '</span> ';
		$centerPages .= '<a class="number" href="page=' . $add1 . '">' . $add1 . '</a>';
		
	} else if ($page > 1 && $page < $lastPage) {
		$centerPages .= '<a class="number" href="page=' . $sub1 . '">' . $sub1 . '</a> ';
		$centerPages .= '<span class="number currentPage">' . $page . '</span> ';
		$centerPages .= '<a class="number" href="page=' . $add1 . '">' . $add1 . '</a> ... ';
		$centerPages .= '<a class="number" href="page=' . $lastPage . '">' . $lastPage . '</a>';
	}
	$paginationDisplay = "";
	$nextPage = $_GET['page'] + 1;
	$previous = $_GET['page'] - 1;
	if ($page == "1" && $lastPage == "1"){
		$paginationDisplay .=  '<img alt="First" src="../img/x.gif" class="first disabled"> ';
		$paginationDisplay .=  '<img alt="previous" src="../img/x.gif" class="previous disabled">';
		$paginationDisplay .= $centerPages;
		$paginationDisplay .=  '<img alt="next" src="../img/x.gif" class="next disabled"> ';
		$paginationDisplay .=  '<img alt="last" src="../img/x.gif" class="last disabled">';
		
	}elseif ($lastPage == 0){
		$paginationDisplay .=  '<img alt="first" src="../img/x.gif" class="first disabled"> ';
		$paginationDisplay .=  '<img alt="previous" src="../img/x.gif" class="previous disabled">';
		$paginationDisplay .= $centerPages;
		$paginationDisplay .=  '<img alt="next" src="../img/x.gif" class="next disabled"> ';
		$paginationDisplay .=  '<img alt="last" src="../img/x.gif" class="last disabled">';
		
	}elseif ($page == "1" && $lastPage != "1"){
		$paginationDisplay .=  '<img alt="first" src="../img/x.gif" class="first disabled"> ';
		$paginationDisplay .=  '<img alt="previous" src="../img/x.gif" class="previous disabled">';
		$paginationDisplay .= $centerPages;
		$paginationDisplay .=  '<a class="next" href="page=' . $nextPage . '"><img alt="next page" src="../img/x.gif"></a> ';
		$paginationDisplay .=  '<a class="last" href="page=' . $lastPage . '"><img alt="last page" src="../img/x.gif"></a>';
	
	}elseif ($page != "1" && $page != $lastPage){
		$paginationDisplay .=  '<a class="first" href="page=1"><img alt="first" src="../img/x.gif"></a> ';
		$paginationDisplay .=  '<a class="previous" href="page=' . $previous . '"><img alt="previous" src="../img/x.gif"></a>';
		$paginationDisplay .= $centerPages;
		$paginationDisplay .=  '<a class="next" href="page=' . $nextPage . '"><img alt="next" src="../img/x.gif"></a> ';
		$paginationDisplay .=  '<a class="last" href="page=' . $lastPage . '"><img alt="last" src="../img/x.gif"></a>';
	
	}elseif ($page == $lastPage){
		$paginationDisplay .=  '<a class="first" href="page=1"><img alt="first" src="../img/x.gif"></a> ';
		$paginationDisplay .=  '<a class="previous" href="page=' . $previous . '"><img alt="previous" src="../img/x.gif"></a>';
		$paginationDisplay .= $centerPages;
		$paginationDisplay .=  '<img alt="next" src="../img/x.gif" class="next disabled"> ';
		$paginationDisplay .=  '<img alt="last" src="../img/x.gif" class="last disabled">';
	}
	
	$limit = 'LIMIT ' .($page - 1) * $itemsPerPage .',' .$itemsPerPage; 
	$time = time() - (60*5);
	$sql2 = mysql_query("SELECT * FROM ".TB_PREFIX."users where timestamp > $time and id > 3 ORDER BY username ASC $limit");

if($query>0){
	while($row = mysql_fetch_array($sql2)){
		$uid = $row['id'];
		$sql3 = mysql_query("SELECT * FROM ".TB_PREFIX."vdata where owner = $uid");
		$vil = $database->mysql_fetch_all($sql3);
		$totalpop = 0;

		foreach($vil as $varray) {
			$totalpop += $varray['pop'];
		}
		if($row['tribe'] == 1){
			$tribe = "roman";
		} else if($row['tribe'] == 2){
			$tribe = "teuton";
		} else if($row['tribe'] == 3){
			$tribe = "gaul";
		}
		if($row['access'] == 9){
			$access = "[<b>Admin</b>]";
        } elseif($row['access'] == 8){
			$access = "[<b>Multihunter</b>]";
        } elseif($row['access'] == 0){
			$access = "[<b>Ban</b>]";
        }else{ $access = ""; }
		
		echo '
				<tr>
					<td dir="ltr"><a href="?p=Users&uid='.$uid.'">'.$row['username'].'</a> '.$access.'</td>
					<td>'.date("d/m/Y H:i",$row['timestamp']).'</td>
					<td>'.$tribe.'</td>
					<td>'.$totalpop.'</td>
					<td>'.count($vil).'</td>
					<td><img src="../img/admin/gold.gif" class="gold" alt="Gold" title="players '.$row['gold'].' gold"/> '.$row['gold'].'</td>
					<td><img src="../img/admin/silver.gif" class="gold" alt="Silver" title="players '.$row['silver'].' silver"/> '.$row['silver'].'</td>
					<td><a href="?p=Users&uid='.$uid.'"><img title="edit player" border="0" src="../img/admin/edit.gif"></a></td>
				</tr>  
			';
	}
}else{
	echo '<tr><td colspan="8" align="center">No player is online</td></tr>';
} 

?>    

</table>
<div class="footer">
	<div class="paginator">
    <?php echo $paginationDisplay; ?>
    </div>
    <div class="clear"></div>
</div>