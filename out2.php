<?php
	$startingid = $_GET["id"];
	$i = $_GET["i"];
	
	$db = mysql_connect('mysql.visualspark.com', 'britinva', 'xxxxxxxx');
	mysql_select_db('britinva_wopr', $db);

	$select = "SELECT * FROM tweets";
	if ($startingid) 
		$select .= " WHERE tweets.id > ".$startingid;
	if ($i)
		$select .= " LIMIT 0, ".$i;
	$export = mysql_query ( $select ) or die ( "Sql error : " . mysql_error( ) );
	$fields = mysql_num_fields ( $export );
	$count = 0;
	$maxid = 0;
	
	for ( $i = 0; $i < $fields; $i++ )
	{
		$header .= mysql_field_name( $export , $i ) . "\t";
	}
	
	while( $row = mysql_fetch_row( $export ) )
	{
		$count++;
		$line = '';
		foreach( $row as $value )
		{                                            
			if ( ( !isset( $value ) ) || ( $value == "" ) )
			{
				$value = "\t";
			}
			else
			{
				$value = str_replace( '"' , '""' , $value );
	  			$value =  (string)str_replace(array("\r", "\r\n", "\n"), '', $value);
				$value = $value . "\t";
				
					if (intval($value) > $maxid) $maxid = $value;
			}
			$line .= $value;
		}
		$data .= trim( $line ) . "\n";
	}
	$data = str_replace( "\r" , "" , $data );
	
	if ( $data == "" )
	{
		$maxid = $startingid;
	}
	
	print "# ".($count+1)."\t-0.36725575\t0.35223946\t0.41603112\t0.8704487\t" . $maxid . "\n";
	print $data;
