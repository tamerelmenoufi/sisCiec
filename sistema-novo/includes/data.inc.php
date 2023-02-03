
<?

function data(){

$english_day = date("l");

switch($english_day)
{
	case "Monday":
		$portuguese_day = "Manaus";
		break;
	case "Tuesday":
		$portuguese_day = "Manaus";
		break;
	case "Wednesday":
		$portuguese_day = "Manaus";
		break;
	case "Thursday":
		$portuguese_day = "Manaus";
		break;	
	case "Friday":
		$portuguese_day = "Manaus";
		break;
	case "Saturday":
		$portuguese_day = "Manaus";
		break;
	case "Sunday":
		$portuguese_day = "Manaus";
		break;
}


$english_month = date("m");
switch($english_month)
{
	case "1":
		$portuguese_month = "janeiro";
		break;
	case "2":
		$portuguese_month = "fevereiro";
		break;
	case "3":
		$portuguese_month = "março";
		break;
	case "4":
		$portuguese_month = "abril";
		break;
	case "5":
		$portuguese_month = "maio";
		break;
	case "6":
		$portuguese_month = "junho";
		break;
	case "7":
		$portuguese_month = "julho";
		break;
	case "8":
		$portuguese_month = "agosto";
		break;
	case "9":
		$portuguese_month = "setembro";
		break;
	case "10":
		$portuguese_month = "outubro";
		break;
	case "11":
		$portuguese_month = "novembro";
		break;
	case "12":
		$portuguese_month = "dezembro";
		break;
}


print($portuguese_day);
print(", ");
print(date("d"));
print(" de ");
print($portuguese_month);
print(" de ");
print(date("Y")); 

}

?>